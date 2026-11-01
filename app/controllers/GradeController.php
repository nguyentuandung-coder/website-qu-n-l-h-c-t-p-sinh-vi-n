<?php
require_once APP_ROOT . '/app/services/GradeService.php';
require_once APP_ROOT . '/app/services/SubjectService.php';

class GradeController
{

    // Hien thi danh sach diem
    public function index()
    {
        $gradeService = new GradeService();
        $subjectService = new SubjectService();

        $selectedClass = trim($_GET['class'] ?? '');
        $selectedSubject = (int)($_GET['subject_id'] ?? 0);

        $classes = $gradeService->getAllClasses();
        $subjects = $subjectService->getAllSubjects();
        $grades = $gradeService->getAllGrades($selectedClass, $selectedSubject);

        include APP_ROOT . '/app/views/grade/index.php';
    }

    // Hien thi form them diem
    public function add()
    {
        $studentCode = '';
        $subjectCode = '';
        $scoreInput = '';
        $errorMessage = null;
        include_once APP_ROOT . '/app/views/grade/add.php';
    }

    // Xu ly them diem
    public function store()
    {
        $studentCode = strtoupper(trim($_POST['student_code'] ?? ''));
        $subjectCode = strtoupper(trim($_POST['subject_code'] ?? ''));
        $scoreInput = $_POST['score'] ?? null;
        $score = is_numeric($scoreInput) ? (float)$scoreInput : -1;
        $gradeService = new GradeService();
        $student = $studentCode !== '' ? $gradeService->getStudentByCode($studentCode) : null;
        $subject = $subjectCode !== '' ? $gradeService->getSubjectByCode($subjectCode) : null;

        if ($student === null) {
            $errorMessage = 'Mã sinh viên không tồn tại. Vui lòng kiểm tra lại.';
        } elseif ($subject === null) {
            $errorMessage = 'Mã môn học không tồn tại trong hệ thống. Vui lòng kiểm tra lại.';
        } elseif ($score < 0 || $score > 10) {
            $errorMessage = 'Vui lòng nhập điểm từ 0 đến 10.';
        } elseif ($gradeService->hasGradeForSubject($student['id'], $subject['id'])) {
            $subjectName = $subject['name'] ?? $subjectCode;
            $studentName = $student['student_name'] ?? $studentCode;
            $errorMessage = 'Sinh viên ' . $studentName . ' (' . $studentCode . ') đã có điểm môn "' . $subjectName . '" (' . $subjectCode . '). Vui lòng chỉnh sửa điểm hiện có thay vì thêm mới!';
        } else {
            try {
                $grade = new Grade(null, $student['id'], $subject['id'], $score);
                $gradeService->addGrade($grade);
                header('Location: ?controller=grade&action=index');
                exit;
            } catch (PDOException $e) {
                $errorMessage = 'Lỗi lưu điểm: Sinh viên này đã có điểm môn học vừa chọn trong hệ thống!';
            }
        }

        include APP_ROOT . '/app/views/grade/add.php';
    }

    // Hien thi form sua diem
    public function edit($id)
    {
        if (!empty($id)) {
            $gradeService = new GradeService();
            $grade = $gradeService->getGradeById($id);

            if ($grade != null) {
                $studentCode = $grade->getStudentCode();
                $subjectCode = $grade->getSubjectCode();
                $scoreInput = $grade->getScore();
                $errorMessage = null;
                include APP_ROOT . '/app/views/grade/edit.php';
            } else {
                echo 'Không tìm thấy điểm!';
            }
        } else {
            echo 'ID điểm không hợp lệ!';
        }
    }

    // Xu ly cap nhat diem
    public function update($id)
    {
        $studentCode = strtoupper(trim($_POST['student_code'] ?? ''));
        $subjectCode = strtoupper(trim($_POST['subject_code'] ?? ''));
        $scoreInput = $_POST['score'] ?? null;
        $score = is_numeric($scoreInput) ? (float)$scoreInput : -1;
        $gradeService = new GradeService();
        $student = $studentCode !== '' ? $gradeService->getStudentByCode($studentCode) : null;
        $subject = $subjectCode !== '' ? $gradeService->getSubjectByCode($subjectCode) : null;

        $grade = $gradeService->getGradeById($id);
        if ($grade === null) {
            echo 'Không tìm thấy điểm!';
            return;
        }

        if ($student === null) {
            $errorMessage = 'Mã sinh viên không tồn tại. Vui lòng kiểm tra lại.';
        } elseif ($subject === null) {
            $errorMessage = 'Mã môn học không tồn tại trong hệ thống. Vui lòng kiểm tra lại.';
        } elseif ($score < 0 || $score > 10) {
            $errorMessage = 'Vui lòng nhập điểm từ 0 đến 10.';
        } elseif ($gradeService->hasGradeForSubject($student['id'], $subject['id'], $id)) {
            $subjectName = $subject['name'] ?? $subjectCode;
            $studentName = $student['student_name'] ?? $studentCode;
            $errorMessage = 'Sinh viên ' . $studentName . ' (' . $studentCode . ') đã có một bản ghi điểm khác cho môn "' . $subjectName . '" (' . $subjectCode . ')!';
        } else {
            try {
                $updatedGrade = new Grade($id, $student['id'], $subject['id'], $score);
                $gradeService->updateGrade($updatedGrade);
                header('Location: ?controller=grade&action=index');
                exit;
            } catch (PDOException $e) {
                $errorMessage = 'Lỗi cập nhật: Sinh viên này đã có điểm môn học vừa chọn trong hệ thống!';
            }
        }

        include APP_ROOT . '/app/views/grade/edit.php';
    }

    // Xoa diem: GET -> Trang xac nhan xoa (delete.php), POST -> Thuc hien xoa
    public function delete($id)
    {
        if (empty($id)) {
            header('Location: ?controller=grade&action=index');
            exit;
        }

        $gradeService = new GradeService();

        // Neu la POST hoac bam nut xac nhan xoa -> Thuc hien xoa trong CSDL
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['btn_confirm_delete'])) {
            $gradeService->deleteGrade($id);
            header('Location: ?controller=grade&action=index');
            exit;
        }

        // Neu la GET -> Hien thi giao dien xac nhan xoa (delete.php)
        $grade = $gradeService->getGradeById($id);
        if ($grade == null) {
            header('Location: ?controller=grade&action=index');
            exit;
        }

        include APP_ROOT . '/app/views/grade/delete.php';
    }
}
