<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?php if(!empty($user)): ?>
                Привет, <?= $user->getNickname() ?>  | <a href="/users/logOut">Выйти</a>
            <?php else: ?>
                <a href="/users/login">Войти</a> | <a href="/users/register">Зарегестрироваться</a>
            <? endif; ?>
        </td>
    </tr>
    <tr>
        <td>