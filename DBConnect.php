<?php
/*
 * Activation du mode strict pour les types spécifiés dans les déclarations qui doivent êtres respectés exactement
 */
declare(strict_types=1);

class DBConnect 
{

    private string $host = 'localhost';

    private string $dbname = 'ocr-p5';

    private string $user = 'root';
    private string $password = '';



    private static $instance = null;


    /**
     * Initializes a new instance of the class.
     *
     * @return void
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);
    }


    /**
     * Retrieves the singleton instance of the DBConnect class.
     *
     * @return DBConnect The singleton instance of the DBConnect class.
     */
    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }


    /**
     * Retrieves the PDO instance.
     *
     * @return PDO The PDO instance.
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
