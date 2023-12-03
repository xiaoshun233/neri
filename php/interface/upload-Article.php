<?php
    include 'Article.class.php';
    if(isset($_POST['data'])){
        $data = json_decode($_POST['data']);
        $article = new Article();
        require "../link/session.php";
        $article -> setAll(
            $data->title,
            $data->cover,
            $_SESSION['username'],
            $data->type,
            $data->about,
            $data->baidu,
            $data->od,
            $data->outlinks,
            $data->about_imgs
        );
        $result = $article -> Contributearticles();
        echo json_encode($result);
    }
    
?>