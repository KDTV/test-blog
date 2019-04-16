<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use KDTV\Blog\Domain\PostRepository;
use Twig\Environment;

final class HomeService
{
    private $twig;
    private $postRepository;

    public function __construct(Environment $twig, PostRepository $postRepository)
    {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
    }

    public function __invoke(): string
    {
        $entries = $this->postRepository->list();
        return $this->twig->render('blog/index.html.twig',
            ['blog_entries' => $entries]);
    }
}
