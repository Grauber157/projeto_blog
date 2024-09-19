<?php

    function insert(string $entidade, array $dados) : string
    {
        $instrucao = "INSERT INTO {$entidade}";

        $campos = implode(', ', array_keys($dados));
        $valores = implode(', ', array_values($dados));

        $instrucao .= " ({$campos})";
        $instrucao .= " VALUES ({$valores})";

        return $instrucao;
    }


    function Update()
    {
        
    }

?>