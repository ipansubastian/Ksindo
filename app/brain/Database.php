<?php

/*
 * Database Wrapper
 */

class Database
{

    private
        $db_host = DB_CONF['DB_HOST'],
        $db_user = DB_CONF['DB_USER'],
        $db_pass = DB_CONF['DB_PASS'],
        $db_name = DB_CONF['DB_NAME'],
        $dbh,
        $stmt;

    // Memulai koneksi ke database
    public function __construct()
    {
        $dsn = "mysql:host={$this->db_host};dbname={$this->db_name}";
        $additi_param = [
            PDO::ATTR_PERSISTENT => True,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $additi_param);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // SQL Query Handler
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    //Binding query sebelum dieksekusi
    public function bind($param, $value, $data_type = NULL)
    {
        switch (True) {
            case is_null($value):
                $data_type = PDO::PARAM_NULL;
                break;
            case is_bool($value):
                $data_type = PDO::PARAM_BOOL;
                break;
            case is_int($value):
                $data_type = PDO::PARAM_INT;
                break;
            default:
                $data_type = PDO::PARAM_STR;
                break;
        }

        $this->stmt->bindValue($param, $value, $data_type);
    }

    // Eksekusi Query
    public function execute()
    {
        $this->stmt->execute();
    }

    // Ambil semua hasil eksekusi query
    public function fetchAll($result_type = PDO::FETCH_ASSOC)
    {

        $this->execute();

        return $this->stmt->fetchAll($result_type);
    }

    // Ambil satu baris eksekusi query
    public function fetchOne($result_type = PDO::FETCH_ASSOC)
    {
        $this->execute();
        return $this->stmt->fetch($result_type);
    }

    // Jumlah baris terpengaruh
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
