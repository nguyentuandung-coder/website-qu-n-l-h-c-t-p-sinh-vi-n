<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa điểm - StudyHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- CSS Quan ly Diem -->
    <link rel="stylesheet" href="asset/css/grade.css">
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <a href="?controller=home" class="logo">
                <div class="logo-icon"><i class="bi bi-mortarboard"></i></div>
                <div class="logo-text">
                    <h4>StudyHub</h4>
                    <p>ACADEMIC WORKSPACE</p>
                </div>
            </a>
            <p class="menu-title">HỆ THỐNG QUẢN LÝ</p>
            <nav class="menu-links">
                <a href="?controller=home" class="menu-link"><i class="bi bi-grid"></i><span>Trang chủ</span></a>
                <a href="?controller=student&action=index" class="menu-link"><i class="bi bi-people"></i><span>Quản lý sinh viên</span></a>
                <a href="?controller=subject&action=index" class="menu-link"><i class="bi bi-book"></i><span>Quản lý môn học</span></a>
                <a href="?controller=grade&action=index" class="menu-link active"><i class="bi bi-star"></i><span>Quản lý điểm</span></a>
            </nav>
            <div class="support-box">
                <div class="support-icon"><i class="bi bi-question-circle"></i></div>
                <div><strong>Hỗ trợ kỹ thuật</strong><p>Phòng đào tạo &amp; CNTT</p></div>
            </div>
        </aside>

        <div class="main-area">
            <header class="top-header">
                <h5 class="header-title">Quản lý điểm • Chỉnh sửa</h5>
                <div class="header-right">
                    <div class="user-info">
                        <div class="text-end">
                            <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Quản trị viên') ?></strong>
                            <p>Quản trị hệ thống</p>
                        </div>
                        <div class="user-icon"><i class="bi bi-person-fill"></i></div>
                        <a href="?controller=auth&action=logout" class="header-button text-danger text-decoration-none d-flex align-items-center justify-content-center ms-2" title="Đăng xuất" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')"><i class="bi bi-box-arrow-right fs-5"></i></a>
                    </div>
                </div>
            </header>

            <main class="content">
                <div class="mb-3">
                    <a href="?controller=grade&action=index" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách điểm
                    </a>
                </div>

                <div class="form-card">
                    <div class="form-card-header">
                        <div class="edit-icon-box"><i class="bi bi-pencil-square"></i></div>
                        <h3 class="form-title">Cập nhật điểm</h3>
                        <p class="form-subtitle">Chỉnh sửa thông tin sinh viên, môn học hoặc điểm số</p>
                        <span class="grade-badge-id"><i class="bi bi-hash"></i> ID điểm: <?= htmlspecialchars((string)$grade->getId()) ?></span>
                    </div>

                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage); ?></div>
                    <?php endif; ?>

                    <form action="?controller=editGrade&id=<?= urlencode((string)$grade->getId()) ?>" method="POST">
                        <div class="form-group-custom">
                            <label for="student_code" class="form-label-custom">Mã sinh viên <span class="text-danger">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="bi bi-person-vcard"></i></span>
                                <input type="text" class="form-input-custom" id="student_code" name="student_code"
                                    value="<?= htmlspecialchars($studentCode ?? (string)$grade->getStudentCode()) ?>" required>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="subject_code" class="form-label-custom">Mã môn học <span class="text-danger">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="bi bi-book"></i></span>
                                <input type="text" class="form-input-custom" id="subject_code" name="subject_code"
                                    value="<?= htmlspecialchars($subjectCode ?? (string)($grade->getSubjectCode() ?? '')) ?>"
                                    placeholder="Nhập mã môn học đã tồn tại" required>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="score" class="form-label-custom">Điểm <span class="text-danger">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="bi bi-award"></i></span>
                                <input type="number" class="form-input-custom" id="score" name="score"
                                    min="0" max="10" step="0.01" value="<?= htmlspecialchars((string)($scoreInput ?? $grade->getScore())) ?>" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-2">
                            <a href="?controller=grade&action=index" class="btn-cancel-custom">
                                <i class="bi bi-x-circle"></i><span>Hủy bỏ</span>
                            </a>
                            <button type="submit" name="btn_update" class="btn-submit-blue">
                                <i class="bi bi-save2"></i><span>Cập nhật thay đổi</span>
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
