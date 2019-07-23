<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\Forbidden;

class AdminController extends AbstractController {




    public function admin()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if(!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа к этому разделу Вы должны обладать правами администратора');
        }

        //$articles = Article::findAll();
        $this->view->renderHtml('admin/admin.php');
    }
/*
    public function admin()
    {
        {
            $articles = Article::findAll();
            $this->view->renderHtml('main/main.php', ['articles' => $articles]);
        }
    }
*/
    public function add()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if(!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа к этому разделу Вы должны обладать правами администратора');
        }

        $articles = Article::findAll();
        $this->view->renderHtml('articles/add.php', ['articles' => $articles]);
    }

    public function edit()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if(!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа к этому разделу Вы должны обладать правами администратора');
        }

        $articles = Article::findAll();
        $this->view->renderHtml('admin/edit.php', ['articles' => $articles]);
    }

    public function delete()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if(!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа к этому разделу Вы должны обладать правами администратора');
        }

        $articles = Article::findAll();
        $this->view->renderHtml('admin/delete.php', ['articles' => $articles]);
    }

}