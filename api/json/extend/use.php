<?php
$logger = new JsonAppendLogger('meus_logs_rapidos.json');

// Escrevendo logs super rápido sem ler o arquivo
$id = $logger->create('WARNING', 'Tentativa de login suspeita.', ['ip' => '192.168.1.1']);

// Lendo todos os logs
$todos = $logger->read();