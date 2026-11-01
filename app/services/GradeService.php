<?php
require_once APP_ROOT . '/app/libs/DbConnection.php';
require_once APP_ROOT . '/app/models/Grade.php';

class GradeService
{

    public function getAllGrades()
    {
        $grades = [];
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                [$nameColumn, $classColumn] = $this->getStudentColumns($conn);
                $sql = "SELECT g.*, s.student_code, s.$nameColumn AS student_name,
                               s.$classColumn AS student_class, sub.name AS subject_name
                        FROM grades g
                        INNER JOIN students s ON s.id = g.student_id
                        LEFT JOIN subjects sub ON sub.id = g.subject_id
                        ORDER BY g.id ASC";
                $stmt = $conn->query($sql);

                if ($stmt) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $grade = new Grade(
                            $row['id'],
                            $row['student_id'],
                            $row['subject_id'],
                            $row['score'],
                            $row['student_code'],
                            $row['student_name'],
                            $row['student_class'],
                            $row['subject_name']
                        );

                        $grades[] = $grade;
                    }
                }
            }
        }

        return $grades;
    }

    public function getAllGrade()
    {
        return $this->getAllGrades();
    }

    public function getGradeById($id)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                [$nameColumn, $classColumn] = $this->getStudentColumns($conn);
                $sql = "SELECT g.*, s.student_code, s.$nameColumn AS student_name,
                               s.$classColumn AS student_class, sub.name AS subject_name
                        FROM grades g
                        INNER JOIN students s ON s.id = g.student_id
                        LEFT JOIN subjects sub ON sub.id = g.subject_id
                        WHERE g.id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['id' => $id]);

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    return new Grade(
                        $row['id'],
                        $row['student_id'],
                        $row['subject_id'],
                        $row['score'],
                        $row['student_code'],
                        $row['student_name'],
                        $row['student_class'],
                        $row['subject_name']
                    );
                }
            }
        }

        return null;
    }

    public function getStudentByCode($studentCode)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            throw new RuntimeException('KhÃ´ng thá»ƒ káº¿t ná»‘i cÆ¡ sá»Ÿ dá»¯ liá»‡u Ä‘á»ƒ kiá»ƒm tra mÃ£ sinh viÃªn.');
        }

        [$nameColumn, $classColumn] = $this->getStudentColumns($conn);
        $sql = "SELECT id, student_code, $nameColumn AS student_name,
                       $classColumn AS student_class
                FROM students
                WHERE student_code = :student_code";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['student_code' => $studentCode]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        return $student ?: null;
    }

    public function getSubjectById($subjectId)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            return null;
        }

        $stmt = $conn->prepare("SELECT * FROM subjects WHERE id = :id");
        $stmt->execute(['id' => $subjectId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Kiem tra xem sinh vien da co ban ghi diem cho mon hoc nay chua
     */
    public function hasGradeForSubject($studentId, $subjectId, $excludeId = null)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
            return false;
        }

        $sql = "SELECT COUNT(*) FROM grades WHERE student_id = :student_id AND subject_id = :subject_id";
        $params = [
            'student_id' => $studentId,
            'subject_id' => $subjectId
        ];

        if (!empty($excludeId)) {
            $sql .= " AND id != :exclude_id";
            $params['exclude_id'] = $excludeId;
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return ((int)$stmt->fetchColumn()) > 0;
    }

    public function addGrade(Grade $grade)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "INSERT INTO grades (student_id, subject_id, score)
                        VALUES (:student_id, :subject_id, :score)";

                $stmt = $conn->prepare($sql);

                $stmt->execute([
                    'student_id' => $grade->getStudentId(),
                    'subject_id' => $grade->getSubjectId(),
                    'score' => $grade->getScore()
                ]);
            }
        }
    }

    public function updateGrade(Grade $grade)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "UPDATE grades
                        SET student_id = :student_id,
                            subject_id = :subject_id,
                            score = :score
                        WHERE id = :id";

                $stmt = $conn->prepare($sql);

                $stmt->execute([
                    'student_id' => $grade->getStudentId(),
                    'subject_id' => $grade->getSubjectId(),
                    'score' => $grade->getScore(),
                    'id' => $grade->getId()
                ]);
            }
        }
    }

    public function deleteGrade($id)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "DELETE FROM grades WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['id' => $id]);
            }
        }
    }

    private function getStudentColumns(PDO $conn)
    {
        $stmt = $conn->query("SHOW COLUMNS FROM students");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        $nameColumn = in_array('full_name', $columns, true)
            ? 'full_name'
            : (in_array('name', $columns, true) ? 'name' : null);
        $classColumn = in_array('class_name', $columns, true)
            ? 'class_name'
            : (in_array('class', $columns, true) ? 'class' : null);

        if ($nameColumn === null || $classColumn === null) {
            throw new RuntimeException('KhÃ´ng tÃ¬m tháº¥y cá»™t há» tÃªn hoáº·c lá»›p trong báº£ng students.');
        }

        return [$nameColumn, $classColumn];
    }
}
