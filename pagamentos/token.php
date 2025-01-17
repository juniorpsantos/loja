<?php

$tokenPagamentoSite = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if ($_SESSION['token_pagamentos'] != $tokenPagamentoSite):
    header("Location: " . HOME);
    exit();
endif;

if ($tokenPagamentoSite == null):
    header("Location: " . HOME);
    exit();
endif;

if ($_SESSION['token_pagamentos'] === $tokenPagamentoSite):
    null;
else:
    header("Location: " . HOME);
    exit();
endif;
