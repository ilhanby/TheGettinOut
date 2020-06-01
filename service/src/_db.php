<?php
global $daba;

class Database_
{
    private $connection;
    private $filter;

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

    private function filter($data)
    {
        $this->filter = 'WHERE durum = 1 ';

        if (isset($data['name']) && $data['name'] != '')
            $this->filter .= "AND name = '" . $data['name'] . "' ";

        if (isset($data['categoryId']) && $data['categoryId'] != '')
            $this->filter .= "AND categoryId = " . $data['categoryId'] . " ";

        if (isset($data['userId']) && $data['userId'] != '')
            $this->filter .= "AND userId = " . $data['userId'] . " ";

        if (isset($data['Id']) && $data['Id'] != '')
            $this->filter .= "AND Id = " . $data['Id'] . " ";

        if (isset($data['eventId']) && $data['eventId'] != '')
            $this->filter .= "AND eventId = " . $data['eventId'] . " ";

        if (isset($data['position']) && $data['position'] != '')
            $this->filter .= "AND position = '" . $data['position'] . "' ";

        if (isset($data['_token']) && $data['_token'] != '')
            $this->filter .= "AND _token = '" . $data['_token'] . "' ";

        if (isset($data['searchEvent']) && $data['searchEvent'] != '') {
            $data['searchEvent'] = mb_strtoupper(pre_up($data['searchEvent']), 'UTF-8');
            $this->filter .= "AND name LIKE '%" . $data['searchEvent'] . "%' ";
        }

        if (isset($data['mail']) && $data['mail'] != '') {
            if (isset($data['passw']) && $data['passw'] != '')
                $this->filter .= "AND mail ='" . $data['mail'] . "' AND passw ='" . $data['passw'] . "' ";
            else
                $this->filter = "AND mail ='" . $data['mail'] . "' ";
        }

    }

    public function _User($data)
    {
        $this->filter($data);
        return $this->connection->query("SELECT * FROM _user $this->filter", PDO::FETCH_ASSOC);
    }

    public function _AddUser($data)
    {
        $sql = "INSERT INTO _user (name, mail, passw, position, notification, verified, verifiedCode, durum) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->connection->prepare($sql);
        $verifiedCode = rand(123456, 999999);
        $insert = $query->execute(array(
            $data['namePost'], $data['mail'], $data['passwPost'], $data['positionPost'], $data['notificationPost'], 0, $verifiedCode, 1
        ));
        if ($insert) {
            $last_id = $this->connection->lastInsertId();
            return array(message => 'Kayıt İşlemi Başarılı!', id => $last_id, verifiedCode => $verifiedCode, mail => $data['mail']);
        } else {
            return $insert;
        }
    }

    public function _UpdateUser($data)
    {
        $sql = "UPDATE _user SET name= :newName, mail= :newMail, passw= :newPassw, position= :newPosition, notification= :newNotification WHERE Id= :id";
        $query = $this->connection->prepare($sql);
        $update = $query->execute(array(
            newName => $data['namePost'], newMail => $data['mail'], newPassw => $data['passwPost'], newPosition => $data['positionPost'], newNotification => $data['notificationPost'], id => $data['id']
        ));
        if ($update) {
            return array(message => 'Güncelleme İşlemi Başarılı!');
        } else {
            return $insert;
        }
    }

    public function _UpdateUserVerified($data)
    {
        $sql = "UPDATE _user SET verified = :verified  WHERE Id= :id";
        $query = $this->connection->prepare($sql);
        $update = $query->execute(array(id => $data['Id'], verified => 1));
        if ($update) {
            return array(message => 'Kullanıcı Onayı Başarılı!');
        }
    }

    public function _UpdateToken($id, $token)
    {
        $sql = "UPDATE _user SET _token = :token  WHERE Id= :id";
        $query = $this->connection->prepare($sql);
        $update = $query->execute(array(id => $id, token => $token));
        if ($update) {
            return array(status => true);
        }
    }

    public function _Survey($data)
    {
        $this->filter($data);
        return $this->connection->query("SELECT * FROM _survey $this->filter", PDO::FETCH_ASSOC);
    }

    public function _Settings($data)
    {
        $this->filter($data);
        return $this->connection->query("SELECT * FROM _settings $this->filter", PDO::FETCH_ASSOC);
    }

    public function _Category($data)
    {
        $this->filter($data);
        return $this->connection->query("SELECT * FROM _category $this->filter", PDO::FETCH_ASSOC);
    }

    public function _Comment($data)
    {
        $this->filter($data);
        return $this->connection->query("SELECT * FROM _comment $this->filter", PDO::FETCH_ASSOC);
    }

    public function _Event($data)
    {
        $this->filter($data);
        return $this->connection->query("SELECT * FROM _events $this->filter", PDO::FETCH_ASSOC);
    }
}


$database = new Database_();
$daba = $database;