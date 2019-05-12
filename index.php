<?php
ini_set('display_errors', 1);
require_once __DIR__ . '/vendor/autoload.php';

use KDTV\Blog\Application\HomeService;
use KDTV\Blog\Application\PostDetailService;
use KDTV\Blog\Application\PostSaveService;
use KDTV\Blog\Domain\Post;
use KDTV\Blog\Infrastructure\MySqlPostRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader);

$postRepository = new MySqlPostRepository();

$action = $_GET['action'];

switch ($action){
    case 'view':
        $post = intval($_GET['post']);
        $postDetailService = new PostDetailService($postRepository);
        $post = $postDetailService->__invoke($post);

        if(is_null($post)){
            echo $twig->render('error404.html.twig');
        }

        echo $twig->render('blog/post.html.twig',
            ['post' => $post]);
        break;
    case 'new':
        if($_POST){
            try {
                $post = new Post();

                $post->setId(intval($_POST['id']));
                $post->setTitle($_POST['title']);
                $post->setAuthor($_POST['author']);
                $post->setContent($_POST['content']);
                $post->setTags($_POST['tags']);

                $postSaveService = new PostSaveService($postRepository);

                echo $postSaveService->__invoke($post);
                header('Location: index.php');
            } catch (Exception $e){
                echo $twig->render('blog/edit.html.twig',
                ['error'=> $e->getMessage(), 'post' => $post]);
            }

        } else {
            echo $twig->render('blog/edit.html.twig', ['post' => new Post()]);
        }
        break;
    case 'edit':
        $postId = intval($_GET['post']);
        $postDetailService = new PostDetailService($postRepository);
        $post = $postDetailService->__invoke($postId);
        if(is_null($post)){
            echo $twig->render('error404.html.twig');
        } else {
            echo $twig->render('blog/edit.html.twig',
                ['post' => $post]);
        }
        break;
    case 'admin':
        $homeService = new HomeService($twig, $postRepository);
        echo $twig->render('blog/index.html.twig',
            ['blog_entries' => $homeService->__invoke(),
                'admin' => true]);
        break;
    default:
        $homeService = new HomeService($twig, $postRepository);
        echo $twig->render('blog/index.html.twig',
            ['blog_entries' => $homeService->__invoke()]);
}


