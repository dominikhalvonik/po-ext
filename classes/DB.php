<?php

namespace Classes;

class DB
{
    private $connection;

    public function __construct($host, $username, $pass, $dbName, $port)
    {
        try {
            $this->connection = new \PDO("mysql:host=".$host.";dbname=".$dbName.";port=".$port, $username, $pass);
            // set the PDO error mode to exception
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM tasks";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    public function insert($content, $owner)
    {
        $sql = "INSERT INTO tasks(content, owner) VALUES(:content, :owner)";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':content', $content);
        $stm->bindValue(':owner', $owner);
        $result = $stm->execute();

        return $result;
    }

    public function update($id, $content, $owner)
    {
        $sql = "UPDATE tasks SET content = :content, owner = :owner WHERE id = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':content', $content);
        $stm->bindValue(':owner', $owner);
        $stm->bindValue(':id', $id);
        $result = $stm->execute();

        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $result = $stm->execute();

        return $result;
    }
}