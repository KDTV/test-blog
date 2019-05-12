<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use KDTV\Blog\Domain\PostRepository;

final class PostTagService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(string $tag):array
    {
        return $this->postRepository->findByTag($tag);
    }
}