<?php

function conectarBancoDados()
{
    try {
        $host = 'localhost';
        $db = 'crexe';
        $user = 'root';
        $pass = 'root';

        // Conexão com o banco de dados

        # Sr. V
        $connect = mysqli_connect('localhost', 'root', 'Aberta123', 'angolaw');
        
        # infinitfree
        //$connect = mysqli_connect($host, "u458376368_Creche", "p458376368_Creche", "u458376368_Creche");

        # retornar os dadosda bd
        return $connect;
    } catch (\Throwable $e) {
        die("Erro na conexão: " . $e);
    }
}

$connect = conectarBancoDados();
