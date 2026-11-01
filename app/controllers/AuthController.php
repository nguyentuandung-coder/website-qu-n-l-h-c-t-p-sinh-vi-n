<?php
require_once APP_ROOT . '/app/services/UserService.php';

class AuthController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id']) && ($_SESSION['user_role'] ?? '') === 'admin') {
            header('Location: ?controller=home');
            exit;
        }

        $error = null;
        $success = null;
        $old = [];

        include APP_ROOT . '/app/views/auth/auth.php';
    }

    public function processLogin() {
        $error = null;
        $success = null;

        $identifier = trim($_POST['identifier'] ?? '');
        $password = $_POST['password'] ?? '';

        $old = [
            'identifier' => $identifier
        ];

        $result = $this->userService->login($identifier, $password);

        if ($result['success']) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $result['user']->getId();
            $_SESSION['user_name'] = $result['user']->getFullname();
            $_SESSION['user_email'] = $result['user']->getEmail();
            $_SESSION['user_role'] = $result['user']->getRole();

            header('Location: ?controller=home');
            exit;
        } else {
            $error = $result['message'];
            include APP_ROOT . '/app/views/auth/auth.php';
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        header('Location: ?controller=auth&action=login');
        exit;
    }
}
