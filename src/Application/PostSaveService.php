<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use KDTV\Blog\Domain\Post;
use KDTV\Blog\Domain\PostRepository;
use Twig\Environment;

final class PostSaveService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(Post $post)
    {
        if(!filter_var($post->getAuthor(), FILTER_VALIDATE_EMAIL)){
            throw new \Exception('Invalid Email');
        }

        $this->postRepository->save($post);
    }

}