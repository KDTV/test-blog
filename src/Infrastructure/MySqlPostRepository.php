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
        $this->dbh = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');
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

            $entry = new Post();

            $entry->setId($row['id']);
            $entry->setTitle($row['title']);
            $entry->setAuthor($row['author']);
            $entry->setContent($row['content']);
            $entry->setTags($row['tags']);
            $entry->setCreatedAt($row['created_at']);

            $entries[] = $entry;
        }
        return $entries;
    }

    public function find(int $id): Post
    {
        // TODO: Implement find() method.
    }
}