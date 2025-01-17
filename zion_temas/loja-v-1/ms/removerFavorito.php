<?php

$removerFavorito = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (isset($removerFavorito)) {

    $remover = new removerFavorito();
    $remover->excluirFavorito($removerFavorito, $idSessao);
    if ($remover->getResultado()) {
        return true;
    }
}
