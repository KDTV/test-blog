<?php


namespace KDTV\Blog\Domain;


interface PostRepository
{
    public function save(Post $post):void;

    public function list(): array;

    public function find(int $id): ?Post;

    public function findByAuthor(string $author):array;

    public function findByTag(string $tag):array;
}