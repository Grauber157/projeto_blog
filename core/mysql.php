<?php
    //INSERE
    function Insere(string $entidade, array $dados) : bool
    {
        $retorno = false;

        foreach ($dados as $campo => $dado)
        {
            $coringa[$campo] = '?';
            $tipo[] = gettype($dado) [0];
            $$campo = $dado;
        }

        $instrucao = Insert($entidade, $coringa);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        eval('mysqli_stmt_bind_param($stmt, \'' . implode('', $tipo) . '\',$' . implode(', $', array_keys($dados)) . ');');

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        return $retorno;
    }

    //ATUALIZA
    function atualiza(string $entidade, array $dados, array $criterio = []) : bool
    {
        $retorno = false;

        foreach ($dados as $campo => $dado)
        {
            $coringa_dados[$campo] = '?';
            $tipo[] = gettype($dado) [0];
            $$campo = $dado;
        }

        foreach ($criterio as $expressao)
        {
            $dado = $expressao[count($expressao) -1];

            $tipo[] = gettype($dado) [0];
            $expressao[count($expressao) -1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            if(isset($nome_campo))
            {
                $nome_campo = $nome_campo . '_' . rand();
            }

            $campos_criterio[] = $nome_campo;

            $$nome_campo = $dado;
        }

        $instrucao = Update($entidade, $coringa_dados,)
    }

?>