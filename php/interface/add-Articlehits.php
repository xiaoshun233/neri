<?php
try {
    if (!isset($_POST['data'])) {
        throw new Exception('no data');
    }
    $number = json_decode($_POST['data']);
    if (!($number = intval($number))) {
        throw new Exception('number can not is zero');
    }
    require_once './../class/Article.class.php';
    $article = new Article();
    $article->setvar('number', $number);
    $result = $article->addhits();
} catch (Exception $e) {
    $result = false;
} finally {
    echo json_encode($result);
}
