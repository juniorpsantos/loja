<?php
/**
 * Gerente de Conexão
 * Desenvolvedor: Junior Santos
 * Criado em: Sexta dia 18-10-2024
 */

class Conexao{

 
    private static $host = ZION_HOST;
    private static $user = ZION_USER;
    private static $password = ZION_SENHA;
    private static $dbName = ZION_BD;
    private static $dbType = ZION_TIPO_BANCO; // Exemplo: 'mysql', 'pgsql', 'sqlite'

    /** @var PDO */
    private static $Canectar = null;

    /**
     * Estabelece uma conexão com o banco de dados usando o padrão singleton.
     * Retorna um objeto PDO.
     */
    private static function Conectar() {
        if (self::$Canectar === null) {
            try {
                $dsn = self::getDsn();

                self::$Canectar = new PDO($dsn, self::$user, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);

                if (self::$dbType === 'mysql') {
                    self::$Canectar->exec("SET NAMES 'UTF8'");
                }

            } catch (PDOException $e) {
                // Em um ambiente real, não exponha os detalhes do erro. Logar o erro seria uma abordagem melhor.
                die('Connection Error: ' . $e->getMessage());
            }
        }

        return self::$Canectar;
    }

    /**
     * Retorna um DSN baseado no tipo de banco de dados configurado.
     */
    private static function getDsn() {
        switch (self::$dbType) {
            case 'mysql':
                return 'mysql:host=' . self::$host . ';dbname=' . self::$dbName;
            case 'pgsql':
                return 'pgsql:host=' . self::$host . ';port=5432;dbname=' . self::$dbName . ';user=' . self::$user . ';password=' . self::$password;
            case 'sqlite':
                return 'sqlite:' . self::$dbName; // Aqui, dbName seria o caminho para o arquivo do SQLite
            default:
                throw new Exception('Tipo de ');
        }
    }

    /**
     * Retorna um objeto PDO usando o padrão singleton.
     */
    public static function getCanectar() {
        return self::Conectar();
    }
}

// As constantes DB_HOST, DB_USER, etc., devem ser definidas em outro lugar no seu código, 
// provavelmente em um arquivo de configuração.
