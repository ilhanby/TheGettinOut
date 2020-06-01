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

    public function _Settings()
    {
        return $this->connection->query("SELECT * FROM _settings", PDO::FETCH_ASSOC);
    }

    public function _User()
    {
        return $this->connection->query("SELECT * FROM _user WHERE durum = 1", PDO::FETCH_ASSOC);
    }

    public function _UserSingle($Id)
    {
        return $this->connection->query("SELECT * FROM _user WHERE Id ={$Id} AND durum = 1", PDO::FETCH_ASSOC);
    }

    public function _UserSingleFilter($filter)
    {
        return $this->connection->query("SELECT * FROM _user WHERE {$filter} AND durum = 1", PDO::FETCH_ASSOC);
    }

    public function _Survey()
    {
        return $this->connection->query("SELECT * FROM _survey WHERE durum = 1", PDO::FETCH_ASSOC);
    }

    public function _Category()
    {
        return $this->connection->query("SELECT * FROM _category WHERE durum = 1", PDO::FETCH_ASSOC);
    }

    public function _CategorySingle($Id)
    {
        return $this->connection->query("SELECT * FROM _category WHERE Id ={$Id}", PDO::FETCH_ASSOC);
    }

    public function _Comment()
    {
        return $this->connection->query("SELECT * FROM _comment WHERE durum = 1", PDO::FETCH_ASSOC);
    }

    public function _Customer()
    {
        return $this->connection->query("SELECT * FROM _customerLogo WHERE durum = 1", PDO::FETCH_ASSOC);
    }

    public function _EventsOnlySingle($Id)
    {
        return $this->connection->query("SELECT * FROM _events WHERE Id ={$Id} AND durum = 1", PDO::FETCH_ASSOC);
    }

    public function _EventsSingle($Id)
    {
        return $this->connection->query("SELECT * FROM _events WHERE categoryId ={$Id} AND durum = 1 order by date asc", PDO::FETCH_ASSOC);
    }

    public function _EventsSearch($char)
    {
        $char = mb_strtoupper(pre_up($char), 'UTF-8');
        return $this->connection->query("SELECT * FROM _events WHERE durum = 1 AND name LIKE '%{$char}%'", PDO::FETCH_ASSOC);
    }

    public function _EventsNowBetWeek()
    {
        //return $this->connection->query("SELECT * FROM _events WHERE durum = 1 ORDER BY RAND() LIMIT 8");
        //$oneWeek = date("d-m-Y", strtotime("+2 week"));
        return $this->connection->query("SELECT * FROM _events WHERE durum = 1  ORDER BY date asc LIMIT 8");
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

function pre_up($str){
    $str = str_replace('i', 'İ', $str);
    $str = str_replace('ı', 'I', $str);
    return $str;
}
