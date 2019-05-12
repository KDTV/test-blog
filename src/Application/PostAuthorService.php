<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use KDTV\Blog\Domain\Post;
use KDTV\Blog\Domain\PostRepository;

final class PostAuthorService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(string $postAuthor):array
    {
        return $this->postRepository->findByAuthor($postAuthor);
    }
}