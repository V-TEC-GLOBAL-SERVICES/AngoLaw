<?php

function verificarLimiteLogin($caminhoLogs = 'logs.jsonl', $limitePorMinuto = 5)
{
    // 1. Captura o IP do utilizador
    $ip = '0.0.0.0';
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ips[0]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $agora = time();
    $umMinutoAtras = $agora - 60;
    $tentativasNoUltimoMinuto = 0;
    $timestampPrimeiraTentativa = $agora;

    // 2. Lê o arquivo de logs linha por linha para verificar o histórico do IP
    if (file_exists($caminhoLogs)) {
        $handle = fopen($caminhoLogs, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if (empty($line)) continue;

                $log = json_decode($line, true);

                // Só nos interessam logs de 'LOGIN_ATTEMPT' deste IP específico
                if (isset($log['level']) && $log['level'] === 'LOGIN_ATTEMPT' && isset($log['context']['ip']) && $log['context']['ip'] === $ip) {

                    $logTimestamp = strtotime($log['timestamp']);

                    // Conta apenas as tentativas que aconteceram nos últimos 60 segundos
                    if ($logTimestamp >= $umMinutoAtras) {
                        $tentativasNoUltimoMinuto++;

                        // Guarda o momento da tentativa mais antiga dentro deste minuto para calcular a espera
                        if ($logTimestamp < $timestampPrimeiraTentativa) {
                            $timestampPrimeiraTentativa = $logTimestamp;
                        }
                    }
                }
            }
            fclose($handle);
        }
    }

    // 3. Se excedeu o limite, bloqueia e calcula o tempo restante
    if ($tentativasNoUltimoMinuto >= $limitePorMinuto) {
        // O utilizador deve esperar até que a primeira tentativa saia da janela de 60 segundos
        $tempoEsperaRestante = 60 - ($agora - $timestampPrimeiraTentativa);

        // Garante que o tempo não seja negativo por milissegundos de diferença
        if ($tempoEsperaRestante <= 0) $tempoEsperaRestante = 1;

        return [
            'bloqueado' => true,
            'esperar_segundos' => $tempoEsperaRestante,
            'mensagem' => "Limite de tentativas atingido. Por favor, aguarde {$tempoEsperaRestante} segundos antes de tentar novamente."
        ];
    }

    // Se estiver tudo bem, permite avançar
    return [
        'bloqueado' => false,
        'tentativas' => $tentativasNoUltimoMinuto
    ];
}
