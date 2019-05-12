<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use KDTV\Blog\Domain\Post;
use KDTV\Blog\Domain\PostRepository;
use Twig\Environment;

final class PostDetailService
{
    private $twig;
    private $postRepository;

    public function __construct(Environment $twig, PostRepository $postRepository)
    {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
    }

    public function __invoke(int $postId):string
    {
        $post = $this->postRepository->find($postId);
        return $this->twig->render('blog/post.html.twig',
            ['post' => $post]);
    }
}