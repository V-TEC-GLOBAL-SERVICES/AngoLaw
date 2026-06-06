<?php

class JsonAppendLogger
{
    private $filePath;

    /**
     * Construtor: Define o caminho do arquivo de logs.
     */
    public function __construct($filePath = 'logs.jsonl')
    {
        // Usar a extensão .jsonl ou .json é opcional, mas ajuda a identificar que é um log por linha
        $this->filePath = $filePath;
    }

    /**
     * CREATE: Adiciona um novo log usando FILE_APPEND (Altamente performático)
     */
    public function create($level, $message, $context = [])
    {
        $newLog = [
            'id'        => uniqid('log_', true),
            'timestamp' => date('Y-m-d H:i:s'),
            'level'     => strtoupper($level),
            'message'   => $message,
            'context'   => $context
        ];

        // Transforma o log em uma única linha JSON e adiciona a quebra de linha no final
        $jsonLine = json_encode($newLog, JSON_UNESCAPED_UNICODE) . "\n";

        // Salva direto no fim do arquivo de forma segura
        return file_put_contents($this->filePath, $jsonLine, FILE_APPEND | LOCK_EX) ? $newLog['id'] : false;
    }

    /**
     * READ: Lê o arquivo linha por linha (Poupa memória RAM)
     */
    public function read($id = null)
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $logs = [];

        // Abre o arquivo em modo de leitura
        $handle = fopen($this->filePath, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if (empty($line)) continue;

                $log = json_decode($line, true);

                // Se um ID específico foi pedido, retorna assim que encontrar
                if ($id !== null && $log['id'] === $id) {
                    fclose($handle);
                    return $log;
                }

                $logs[] = $log;
            }
            fclose($handle);
        }

        if ($id !== null) {
            return null; // Se pediu ID e não encontrou
        }

        return array_reverse($logs); // Mais recentes primeiro
    }

    /**
     * UPDATE: Como o arquivo é linear, atualizar exige reescrever o arquivo filtrado
     */
    public function update($id, $newData)
    {
        if (!file_exists($this->filePath)) return false;

        $logs = $this->read(); // Lê todos (já invertidos)
        $logs = array_reverse($logs); // Desinverte para manter a ordem cronológica original
        $updated = false;

        $newContent = "";
        foreach ($logs as $log) {
            if ($log['id'] === $id) {
                $log = array_merge($log, $newData);
                $log['id'] = $id; // Garante que o ID não muda
                $updated = true;
            }
            $newContent .= json_encode($log, JSON_UNESCAPED_UNICODE) . "\n";
        }

        if ($updated) {
            file_put_contents($this->filePath, $newContent, LOCK_EX);
        }

        return $updated;
    }

    /**
     * DELETE: Filtra as linhas e reescreve o arquivo sem o ID deletado
     */
    public function delete($id)
    {
        if (!file_exists($this->filePath)) return false;

        $logs = $this->read();
        $logs = array_reverse($logs);
        $deleted = false;

        $newContent = "";
        foreach ($logs as $log) {
            if ($log['id'] === $id) {
                $deleted = true;
                continue; // Pula este log (deleta)
            }
            $newContent .= json_encode($log, JSON_UNESCAPED_UNICODE) . "\n";
        }

        if ($deleted) {
            file_put_contents($this->filePath, $newContent, LOCK_EX);
        }

        return $deleted;
    }
}
