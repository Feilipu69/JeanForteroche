<?php
require_once 'utils/MyAutoload.php';

MyAutoload::start();

$router = new Router();
$router->renderController();