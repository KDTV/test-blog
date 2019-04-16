<?php

require_once __DIR__ . '/vendor/autoload.php';

use KDTV\Blog\Application\HomeService;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader);

$homeService = new HomeService($twig);

echo $homeService->__invoke();
