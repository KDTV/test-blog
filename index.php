<?php

require_once __DIR__ . '/vendor/autoload.php';

use KDTV\Blog\Application\HomeService;
use KDTV\Blog\Infrastructure\MySqlPostRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader);

$postRepository = new MySqlPostRepository();
$homeService = new HomeService($twig, $postRepository);

echo $homeService->__invoke();
