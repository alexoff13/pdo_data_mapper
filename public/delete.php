<?php
require_once('../vendor/autoload.php');

$workerForRemove = \workers\WorkerRepository::getById($_GET['id']);
$is_remove = \workers\WorkerRepository::remove($workerForRemove);
if ($is_remove) {
    echo '<h1>The record is successful</h1>';
} else {
    echo '<h1>An error has occurred. The recording is not deleted</h1>';

}