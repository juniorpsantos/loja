<?php

$boletim  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (isset($boletim['email'])) {

    $salvar = new Boletim();
    $salvar->criarBoletim($boletim);
    if ($salvar->getResultado()) {

        Formata::EnvioEmailExterno('Novo Cadastro no Boletim Informativo', 'Novo Cadastro no Boletim Informativo', 'index', $boletim['email'], 'Novo Cliente');
    }
}
