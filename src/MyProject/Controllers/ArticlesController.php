<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\Forbidden;

class ArticlesController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('admin/articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            //header('Location: /admin/edit' . $article->getId(), true, 302);
            header('Location: /admin/edit', true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function delete(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->delete();

        header('Location: /admin/delete', true, 302);
        exit();

    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if(!$this->user->isAdmin()) {
            throw new Forbidden('Для добавления статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            //header('Location: /articles/' . $article->getId(), true, 302);
            header('Location: /admin/edit', true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
    }

}