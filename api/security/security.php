<?php

function capturarDadosAtacante()
{
    // 1. Captura o IP Real (Mesmo atrás de Proxies ou Cloudflare)
    $ip = '0.0.0.0';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Pode vir uma lista de IPs separados por vírgula; pegamos o primeiro
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ips[0]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // 2. Captura o User-Agent (Contém informações de SO e Navegador)
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconhecido';

    // 3. Identifica o Sistema Operacional básico através do User-Agent
    $so = "Desconhecido";
    $soPlataformas = [
        '/windows nt 10/i'      => 'Windows 10/11',
        '/windows nt 6.3/i'     => 'Windows 8.1',
        '/windows nt 6.2/i'     => 'Windows 8',
        '/windows nt 6.1/i'     => 'Windows 7',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/linux/i'              => 'Linux',
        '/ubuntu/i'             => 'Ubuntu',
        '/iphone/i'             => 'iPhone (iOS)',
        '/android/i'            => 'Android',
        '/blackberry/i'         => 'BlackBerry'
    ];

    foreach ($soPlataformas as $regex => $plataforma) {
        if (preg_match($regex, $userAgent)) {
            $so = $plataforma;
            break;
        }
    }

    // 4. Localização por IP (Via API pública gratuita - ip-api)
    $localizacao = [
        'pais'   => 'Desconhecido',
        'cidade' => 'Desconhecido',
        'isp'    => 'Desconhecido'
    ];

    if ($ip !== '127.0.0.1' && $ip !== '::1' && filter_var($ip, FILTER_VALIDATE_IP)) {
        // Timeout curto para não travar o teu site caso a API demore a responder
        $ctx = stream_context_create(['http' => ['timeout' => 2]]);
        $apiResponse = @file_get_contents("http://ip-api.com/json/{$ip}?fields=status,country,city,isp", false, $ctx);

        if ($apiResponse) {
            $data = json_decode($apiResponse, true);
            if (($data['status'] ?? '') === 'success') {
                $localizacao['pais']   = $data['country'] ?? 'Desconhecido';
                $localizacao['cidade'] = $data['city'] ?? 'Desconhecido';
                $localizacao['isp']    = $data['isp'] ?? 'Desconhecido'; // Provedor de Internet
            }
        }
    }

    // Retorna o pacote de dados pronto para enviar para o teu JSON de logs
    return [
        'ip'          => $ip,
        'so'          => $so,
        'user_agent'  => $userAgent,
        'localizacao' => $localizacao,
        'mac'         => 'Não capturável via HTTP (Apenas na rede local do servidor)',
        'timestamp'   => date('Y-m-d H:i:s')
    ];
}

// --- EXEMPLO DE INTEGRAÇÃO COM O TEU LOGGER ---
// $dadosAtacante = capturarDadosAtacante();
// $logger->create('ALERT', 'Tentativa de SQL Injection detetada', $dadosAtacante);