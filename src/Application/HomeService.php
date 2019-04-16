<?php
declare(strict_types=1);

namespace KDTV\Blog\Application;

use Twig\Environment;

final class HomeService
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(): string
    {
        return $this->twig->render('blog/index.html.twig');
    }
}
