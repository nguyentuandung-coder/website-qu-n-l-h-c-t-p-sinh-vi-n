<?php
require_once APP_ROOT . '/app/services/StudentService.php';
require_once APP_ROOT . '/app/services/SubjectService.php';
require_once APP_ROOT . '/app/services/GradeService.php';

class HomeController {
    public function index() {
        $studentService = new StudentService();
        $subjectService = new SubjectService();

        $students = $studentService->getAllStudents();
        $subjects = $subjectService->getAllSubjects();

        include APP_ROOT . '/app/views/home/index.php';
    }
}
