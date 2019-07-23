<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main()
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function about_me()
    {
        $this->view->renderHtml('main/about-me.php');
    }

}