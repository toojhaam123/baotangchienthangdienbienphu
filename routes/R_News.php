<?php
$newsConrol = new C_News();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['creat_news'])) {
        $errors = $newsConrol->createNews();
    } elseif (isset($_POST['update_news'])) {
        $errors = $newsConrol->updateNews();
    } elseif (isset($_POST['del_news'])) {
        $newsConrol->deleteNews();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['news_id'])) {
    $newsConrol->addViewNews();
}

$news_ToltalPage = $newsConrol->viewAllNews();
$pageNews = $news_ToltalPage[0];
$totalPageNews = $news_ToltalPage[1];
$allNews = $news_ToltalPage[2];

$allMaxNewsViews = $newsConrol->getMaxView();
$detailsNews = $newsConrol->detailNews();

$AllImageNews_TotalPage = $newsConrol->getAllImageNews();
$pageImgaeNews = $AllImageNews_TotalPage[0];
$totalPageImageNews = $AllImageNews_TotalPage[1];
$allImageNews = $AllImageNews_TotalPage[2];
