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

    public function getMenu()
    {
        $sql = "SELECT * FROM menu ORDER BY id ASC";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllArticles()
    {
        $sql = "SELECT p.id, p.post_name, p.perex, p.created_at, p.image, u.username, c.cat_name 
                FROM `posts` AS p
                INNER JOIN users AS u ON p.users_id = u.id
                INNER JOIN categories_has_posts AS cp ON p.id = cp.posts_id
                INNER JOIN categories AS c ON cp.categories_id = c.id";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        $response = [];
        $i = 0;

        foreach ($result as $item) {
            if(isset($response[$item['id']])) {
                $response[$item['id']]['category'] .= ". " . $item['cat_name'];
            } else {
                $response[$item['id']] = [
                    'name' => $item['post_name'],
                    'perex' => $item['perex'],
                    'created_at' => date("d.m.Y", strtotime($item['created_at'])),
                    'image' => $item['image'],
                    'username' => $item['username'],
                    'category' => $item['cat_name'],
                    'numComments' => $this->getNumberOfComments($item['id'])
                ];
                if($i === 0) {
                    $response[$item['id']]['new'] = true;
                } else {
                    $response[$item['id']]['new'] = false;
                }
            }
            $i++;
        }

        return $response;
    }

    public function getNumberOfComments($postId)
    {
        $sql = "SELECT COUNT(id) FROM comments WHERE posts_id = :post_id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':post_id', $postId);
        $stm->execute();
        $count = $stm->fetchColumn();

        return $count;
    }

    public function getPostDetail($id)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}