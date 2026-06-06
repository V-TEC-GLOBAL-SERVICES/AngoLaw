<?php

class JsonLogger {
    private $filePath;

    /**
     * Construtor: Define o caminho do arquivo JSON e o cria se não existir.
     */
    public function __construct($filePath = 'logs.json') {
        $this->filePath = $filePath;
        
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    /**
     * Auxiliar: Lê o arquivo e retorna o array de dados.
     */
    private function getLogs() {
        $jsonContent = file_get_contents($this->filePath);
        return json_decode($jsonContent, true) ?? [];
    }

    /**
     * Auxiliar: Salva o array de dados de volta no arquivo JSON.
     */
    private function saveLogs($logs) {
        return file_put_contents($this->filePath, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * CREATE: Adiciona um novo log.
     */
    public function create($level, $message, $context = []) {
        $logs = $this->getLogs();

        $newLog = [
            'id'        => uniqid('log_', true),
            'timestamp' => date('Y-m-d H:i:s'),
            'level'     => strtoupper($level), // INFO, ERROR, WARNING, etc.
            'message'   => $message,
            'context'   => $context
        ];

        $logs[] = $newLog;
        $this->saveLogs($logs);

        return $newLog['id']; // Retorna o ID para caso queira usar depois
    }

    /**
     * READ: Retorna todos os logs ou um log específico pelo ID.
     */
    public function read($id = null) {
        $logs = $this->getLogs();

        if ($id !== null) {
            foreach ($logs as $log) {
                if ($log['id'] === $id) {
                    return $log;
                }
            }
            return null; // Retorna null se não encontrar o ID
        }

        return array_reverse($logs); // Retorna os mais recentes primeiro
    }

    /**
     * UPDATE: Atualiza um log existente pelo ID (útil para mudar status ou adicionar observações).
     */
    public function update($id, $newData) {
        $logs = $this->getLogs();
        $updated = false;

        foreach ($logs as &$log) {
            if ($log['id'] === $id) {
                // Mescla os dados antigos com os novos, mantendo o ID e timestamp originais
                $log = array_merge($log, $newData);
                $log['id'] = $id; 
                $updated = true;
                break;
            }
        }

        if ($updated) {
            $this->saveLogs($logs);
        }

        return $updated;
    }

    /**
     * DELETE: Remove um log pelo ID.
     */
    public function delete($id) {
        $logs = $this->getLogs();
        $initialCount = count($logs);

        // Filtra o array removendo o item com o ID correspondente
        $logs = array_filter($logs, function($log) use ($id) {
            return $log['id'] !== $id;
        });

        // Reindexa as chaves do array para evitar buracos no JSON
        $logs = array_values($logs);

        if (count($logs) < $initialCount) {
            $this->saveLogs($logs);
            return true;
        }

        return false;
    }
}