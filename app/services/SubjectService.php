<?php
require_once APP_ROOT . '/app/libs/DbConnection.php';
require_once APP_ROOT . '/app/models/Subject.php';

class SubjectService {

    public function getAllSubjects() {
        $subjects = [];
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM subjects ORDER BY id ASC";
                $stmt = $conn->query($sql);

                if ($stmt) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $subject = new Subject($row['id'], $row['code'], $row['name'], $row['credits']);
                        $subjects[] = $subject;
                    }
                }
            }
        }
        return $subjects;
    }

    public function getSubjectById($id) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM subjects WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['id' => $id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    return new Subject($row['id'], $row['code'], $row['name'], $row['credits']);
                }
            }
        }
        return null;
    }

    /**
     * Kiem tra xem ma mon hoc da ton tai chua (ho tro loai tru ID hien tai khi cap nhat)
     */
    public function codeExists($code, $excludeId = null) {
        $code = strtoupper(trim($code));
        if (empty($code)) return false;

        $dbConnection = new DBConnection();
        if ($dbConnection == null) return false;
        $conn = $dbConnection->getConnection();
        if ($conn == null) return false;

        $sql = "SELECT COUNT(*) FROM subjects WHERE UPPER(code) = :code";
        $params = [':code' => $code];

        if (!empty($excludeId)) {
            $sql .= " AND id != :exclude_id";
            $params[':exclude_id'] = $excludeId;
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return ((int)$stmt->fetchColumn()) > 0;
    }

    public function addSubject(Subject $subject) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "INSERT INTO subjects (code, name, credits) VALUES (:code, :name, :credits)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'code' => strtoupper(trim($subject->getCode())),
                    'name' => trim($subject->getName()),
                    'credits' => $subject->getCredits()
                ]);
            }
        }
    }

    public function updateSubject(Subject $subject) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "UPDATE subjects SET code = :code, name = :name, credits = :credits WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'code' => strtoupper(trim($subject->getCode())),
                    'name' => trim($subject->getName()),
                    'credits' => $subject->getCredits(),
                    'id' => $subject->getId()
                ]);
            }
        }
    }

    public function deleteSubject($id) {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "DELETE FROM subjects WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['id' => $id]);
            }
        }
    }
}
