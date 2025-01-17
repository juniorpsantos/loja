<?php

$favoritos = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$favoritos['id_produto']) {
    header("Location: " . HOME);
} elseif (!$favoritos['id_sessao']) {
    header("Location: " . HOME);
} else {
    null;
}

$addFavoritos = new AddFavoritos();
$addFavoritos->inserirFavorito($favoritos);
if ($addFavoritos->getResultado()) {
    return true;
}
