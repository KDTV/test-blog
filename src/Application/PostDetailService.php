<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use KDTV\Blog\Domain\Post;
use KDTV\Blog\Domain\PostRepository;
use Twig\Environment;

final class PostDetailService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(int $postId):?Post
    {
        return $this->postRepository->find($postId);
    }
}