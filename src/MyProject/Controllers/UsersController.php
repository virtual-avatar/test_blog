<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;
use MyProject\Exceptions\ActivationException;

class UsersController extends AbstractController
{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function activate(int $userId, string $activationCode): void
    {
        try {
            $user = User::getById($userId);

            if ($user === null) {
                throw new ActivationException('Пользователь не найден.');
            }

            if ($user->IsConfirmed()) {
                throw new ActivationException('Пользователь уже активирован');
            }

            $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

            if (!$isCodeValid) {
                throw new ActivationException('Неверный код активации');
            }

            if ($isCodeValid) {
                $user->activate();
                $this->view->renderHtml('users/successfulActivation.php');
                UserActivationService::delActivationCode($user, $activationCode);
                return;
            }

        } catch (ActivationException $e) {
            $this->view->renderHtml('users/nonexistentCode.php', ['error' => $e->getMessage()]);
        }
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('users/login.php');
    }

    public function logOut()
    {
        setcookie('token', '', -1, '/', '', false, true);
        header('Location: /');
    }
}