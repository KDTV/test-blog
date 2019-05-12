<?php
declare(strict_types = 1);

namespace KDTV\Blog\Infrastructure;

use KDTV\Blog\Domain\Post;
use KDTV\Blog\Domain\PostRepository;
use PDO;

final class MySqlPostRepository implements PostRepository
{
    private $dbh;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=blog', 'root', 'password');
    }

    public function save(Post $post): void
    {
        // TODO: Implement save() method.
    }

    public function list(): array
    {
        $entries = [];
        $data = $this->dbh->query("SELECT * FROM post")->fetchAll();

        foreach ($data as $row) {
            $entries[] = $this->parseDataToPost($row);
        }

        return $entries;
    }

    public function find(int $id): Post
    {
        $statement = $this->dbh->prepare('SELECT * FROM post WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->parseDataToPost($data);
    }

    private function parseDataToPost(array $data):Post
    {
        $post = new Post();

        $post->setId($data['id']);
        $post->setTitle($data['title']);
        $post->setAuthor($data['author']);
        $post->setContent($data['content']);
        $post->setTags($data['tags']);
        $post->setCreatedAt($data['created_at']);

        return $post;
    }
}