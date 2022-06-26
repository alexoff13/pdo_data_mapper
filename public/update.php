<?php
require_once('../vendor/autoload.php');
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
$view = new \Twig\Environment($loader);
if (isset($_GET['id'])) {
    $worker = \workers\WorkerRepository::getByID($_GET['id']);
    if ($worker) {
        echo $view->render('worker_update.html.twig', ['worker' => $worker]);

        if (isset($_POST['name'])) {
            if (\workers\WorkerRepository::store(new \workers\Worker(
                $_GET['id'], $_POST['name'], $_POST['address'], $_POST['salary']))) {
                echo '<h1>The data is successfully changed</h1>';
            } else {
                echo '<h1>Something went wrong</h1>';
            }
        }
    } else {
        echo '<h1>An error has occurred. ID is not found</h1>';
    }
}
