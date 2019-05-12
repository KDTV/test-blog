<?php

require_once __DIR__ . '/vendor/autoload.php';

use KDTV\Blog\Application\HomeService;
use KDTV\Blog\Application\PostDetailService;
use KDTV\Blog\Infrastructure\MySqlPostRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader);

$postRepository = new MySqlPostRepository();

$action = $_GET['action'];
var_dump($action);

switch ($action){
    case 'view':
        $post = intval($_GET['post']);
        $postDetailService = new PostDetailService($twig, $postRepository);
        echo $postDetailService->__invoke($post);
        break;
    default:
        $homeService = new HomeService($twig, $postRepository);
        echo $homeService->__invoke();
}


