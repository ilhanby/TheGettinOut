<?php

class Database_
{
    private $connection;

    public function __construct()
    {
        $this->Conn();
    }

    public function Conn()
    {
        try {
            $this->connection = new PDO(DB_HOST, DB_HOSTNAME, DB_PASS);
            $this->connection->query("SET NAMES 'latin5' COLLATE 'latin5_turkish_ci'");
            $this->connection->query("SET CHARACTER SET latin5");
            $this->connection->query("SET COLLATION_CONNECTION='latin5_turkish_ci'");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function _User()
    {
        return $this->connection->query("SELECT * FROM _user", PDO::FETCH_ASSOC);
    }

    public function _UserSingleFilter($filter)
    {
        return $this->connection->query("SELECT * FROM _user WHERE {$filter}", PDO::FETCH_ASSOC);
    }

    public function _Survey()
    {
        return $this->connection->query("SELECT * FROM _survey", PDO::FETCH_ASSOC);
    }

    public function _Note()
    {
        return $this->connection->query("SELECT * FROM _note", PDO::FETCH_ASSOC);
    }

    public function _Category()
    {
        return $this->connection->query("SELECT * FROM _category", PDO::FETCH_ASSOC);
    }

    public function _Settings()
    {
        return $this->connection->query("SELECT * FROM _settings", PDO::FETCH_ASSOC);
    }

    public function _CategorySingle($Id)
    {
        return $this->connection->query("SELECT * FROM _category WHERE Id ={$Id}", PDO::FETCH_ASSOC);
    }

    public function _Comment()
    {
        return $this->connection->query("SELECT * FROM _comment", PDO::FETCH_ASSOC);
    }

    public function _Events()
    {
        return $this->connection->query("SELECT * FROM _events", PDO::FETCH_ASSOC);
    }

    public function _Customer()
    {
        return $this->connection->query("SELECT * FROM _customerLogo", PDO::FETCH_ASSOC);
    }

    public function _Insert($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $param = str_repeat("?, ", count($values));
        $params = rtrim($param, ", ");
        try {
            $stmt = $this->connection->prepare("INSERT INTO {$table} (" . implode(",", $keys) . ") VALUES ({$params})");
            $stmt->execute($values);
            return true;
        } catch (PDOException $e) {
            return "Oops... {$e->getMessage()}";
        }
    }

    public function _Update($table, $data)
    {
        try {
            foreach ($data as $key => $dat) {
                if ($key != "Id") {
                    $stmt = $this->connection->prepare("UPDATE {$table} SET " . $key . " = '" . $data[$key] . "' WHERE Id='" . $data['Id'] . "'");
                    $stmt->execute($data);
                }
            }
            return true;
        } catch (PDOException $e) {
            return "Oops... {$e->getMessage()}";
        }
    }

    public function _Delete($table, $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM {$table} WHERE Id =" . $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Oops... {$e->getMessage()}";
        }
    }
}

$database = new Database_();
$db = $database;

function e($txt, $op = 0)
{
    if (is_array($txt)) {
        $txt = "<pre>" . print_r($txt) . "</pre>";
    } else {
        $txt = prepW($txt, $op);
        print($txt);
    }
}

function prepW($word, $op = 0)
{
    if ($op == 1) $word = ucfirst(mb_strtolower($word, "UTF-8"));
    if ($op == 2) $word = ucwords($word);
    if ($op == 3) $word = mb_strtoupper($word, "UTF-8");
    if ($op == 4) $word = mb_strtolower($word, "UTF-8");
    return $word;
}