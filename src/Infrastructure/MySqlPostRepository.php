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
        $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public function save(Post $post): void
    {
        try{
            $statement = $this->insertOrUpdate($post);

            $statement->bindParam(':title', $post->getTitle());
            $statement->bindParam(':author', $post->getAuthor());
            $statement->bindParam(':content', $post->getContent());
            $statement->bindParam(':tags', $post->getTags());

            $result = $statement->execute();

        } catch (\Exception $e){

        }
    }

    private function insertOrUpdate(Post $post){
        if(is_null($post->getId()) || $post->getId() <= 0){
            return $this->dbh->prepare('INSERT INTO post (title, author, content, tags) 
VALUES (:title, :author, :content, :tags)');
        } else {
            $statement = $this->dbh->prepare('UPDATE post SET title = :title, author = :author,
content = :content, tags = :tags where id = :id');
            $statement->bindParam(':id', $post->getId());

            return $statement;
        }
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

    public function find(int $id): ?Post
    {
        $statement = $this->dbh->prepare('SELECT * FROM post WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if(is_null($data) || empty($data)){
            return null;
        }

        return $this->parseDataToPost($data);
    }

    private function parseDataToPost(array $data):Post
    {
        $post = new Post();

        $post->setId(intval($data['id']));
        $post->setTitle($data['title']);
        $post->setAuthor($data['author']);
        $post->setContent($data['content']);
        $post->setTags($data['tags']);
        $post->setCreatedAt($data['created_at']);

        return $post;
    }
}