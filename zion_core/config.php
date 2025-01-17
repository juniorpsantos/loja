<?php
/*
*CONFIGURAÇÕES FRAMEWORK ZION TECH CRIADO POR - JUNIOR***SANTOS e THIAGO LEMER
*ZION TECH DIGITAL
*ATUALIZADO UMA VEZ POR ANO 
*/


// determina o padrão de datas
date_default_timezone_set('America/Sao_Paulo');

/**********************************************************************
 * ********************************************************************
 * POR JUNIOR SANTOS E THIAGO LEMER
 * ZION TECH DIGITAL
 * 
 */

//configurações do banco de dados
define('ZION_URL', 'localhost/site'); //ou dominio exemplo: ziontechdigital.com.br
define('ZION_HOST', 'localhost');
define('ZION_USER', 'root');
define('ZION_SENHA', '');
define('ZION_BD', 'site');
/**
 * para PostgreSQL 'ZION_TIPO_BANCO','pgsql'
 * para SQLite 'ZION_TIPO_BANCO','sqlite'
 * para MySQL 'ZION_TIPO_BANCO','mysql'
 */
define('ZION_TIPO_BANCO', 'mysql'); // MUITO IMPORTANTE

require_once('includes.php');
