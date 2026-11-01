<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/config/config.php';
require_once APP_ROOT . '/app/libs/DbConnection.php';
require_once APP_ROOT . '/app/controllers/HomeController.php';
require_once APP_ROOT . '/app/controllers/SubjectController.php';
require_once APP_ROOT . '/app/controllers/GradeController.php';
require_once APP_ROOT . '/app/controllers/AuthController.php';
require_once APP_ROOT . '/app/controllers/StudentController.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$homeController = new HomeController();
$subjectController = new SubjectController();
$gradeController = new GradeController();
$authController = new AuthController();
$studentController = new StudentController();

// Kiem tra trang thai dang nhap
$isLoggedIn = isset($_SESSION['user_id']);

// Neu nguoi dung chua dang nhap -> Chi cho phep dang nhap
if (!$isLoggedIn) {
    if ($controller === 'auth') {
        if ($action === 'login' || empty($action)) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->processLogin();
            } else {
                $authController->login();
            }
        } else {
            header('Location: ?controller=auth&action=login');
            exit;
        }
    } else if ($controller === 'login') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->processLogin();
        } else {
            $authController->login();
        }
    } else {
        // Mac dinh hien thi trang dang nhap Quan tri
        $authController->login();
    }
    exit;
}

// Kiem tra phan quyen: Chi cho phep Quan tri vien ('admin')
if (($_SESSION['user_role'] ?? '') !== 'admin') {
    $authController->logout();
    exit;
}

// Khi da dang nhap: Neu truy cap login -> Chuyen huong ve trang chu
if ($controller === 'login' || ($controller === 'auth' && $action !== 'logout')) {
    header('Location: ?controller=home');
    exit;
}

// Cac tuyen duong cho Quan tri vien da dang nhap
if ($controller === 'logout' || ($controller === 'auth' && $action === 'logout')) {
    $authController->logout();
}
// Trang chu
else if ($controller === 'home' || empty($controller)) {
    $homeController->index();
}
// Quan ly sinh vien
else if ($controller === 'student' && ($action === 'index' || empty($action))) {
    $studentController->index();
} else if ($controller === 'addStudent' || ($controller === 'student' && $action === 'add')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentController->store();
    } else {
        $studentController->add();
    }
} else if ($controller === 'editStudent' || ($controller === 'student' && $action === 'edit')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentController->update($id);
    } else {
        $studentController->edit($id);
    }
} else if ($controller === 'deleteStudent' || ($controller === 'student' && $action === 'delete')) {
    $studentController->delete($id);
}
// Quan ly mon hoc
else if ($controller === 'subject' && ($action === 'index' || empty($action))) {
    $subjectController->index();
} else if ($controller === 'addSubject' || ($controller === 'subject' && $action === 'add')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['btn_create'])) {
        $subjectController->store();
    } else {
        $subjectController->add();
    }
} else if ($controller === 'editSubject' || ($controller === 'subject' && $action === 'edit')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['btn_update'])) {
        $subjectController->update($id);
    } else {
        $subjectController->edit($id);
    }
} else if ($controller === 'deleteSubject' || ($controller === 'subject' && $action === 'delete')) {
    $subjectController->delete($id);
}
// Hien thi danh sach diem
else if ($controller === 'grade' && ($action === 'index' || empty($action))) {
    $gradeController->index();
} else if ($controller === 'addGrade' || ($controller === 'grade' && $action === 'add')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['btn_create'])) {
        $gradeController->store();
    } else {
        $gradeController->add();
    }
} else if ($controller === 'editGrade' || ($controller === 'grade' && $action === 'edit')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['btn_update'])) {
        $gradeController->update($id);
    } else {
        $gradeController->edit($id);
    }
} else if ($controller === 'deleteGrade' || ($controller === 'grade' && $action === 'delete')) {
    $gradeController->delete($id);
} else {
    $homeController->index();
}
