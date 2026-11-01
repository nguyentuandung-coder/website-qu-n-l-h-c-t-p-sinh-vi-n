<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa điểm - StudyHub</title>

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
                <div>
                    <strong>Hỗ trợ kỹ thuật</strong>
                    <p>Phòng đào tạo &amp; CNTT</p>
                </div>
            </div>
        </aside>

        <div class="main-area">
            <header class="top-header">
                <h5 class="header-title">Quản lý điểm • Xác nhận xóa</h5>
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

                <div class="delete-card">
                    <div class="delete-icon-box"><i class="bi bi-trash3-fill"></i></div>
                    <h3 class="delete-title">Xác nhận xóa điểm?</h3>
                    <p class="delete-desc">
                        Điểm số sau khi xóa sẽ không thể khôi phục. Vui lòng kiểm tra kỹ thông tin trước khi xác nhận.
                    </p>

                    <div class="grade-info-box">
                        <div class="info-row">
                            <span class="info-label">Mã định danh (ID):</span>
                            <span class="info-value">#<?= htmlspecialchars((string)$grade->getId()) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Mã sinh viên:</span>
                            <span class="badge-code"><?= htmlspecialchars((string)$grade->getStudentCode()) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Họ tên:</span>
                            <span class="info-value"><?= htmlspecialchars((string)$grade->getName()) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Lớp:</span>
                            <span class="info-value"><?= htmlspecialchars((string)$grade->getClassName()) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Môn học:</span>
                            <span class="info-value"><?= htmlspecialchars((string)($grade->getSubjectName() ?? 'Không xác định')) ?> (ID: <?= htmlspecialchars((string)$grade->getSubjectId()) ?>)</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Điểm:</span>
                            <span class="badge-grade"><?= htmlspecialchars((string)$grade->getScore()) ?></span>
                        </div>
                    </div>

                    <div class="warning-note">
                        <i class="bi bi-exclamation-triangle-fill fs-5 text-warning flex-shrink-0"></i>
                        <div><strong>Lưu ý quan trọng:</strong> Thao tác này sẽ xóa vĩnh viễn điểm số đã chọn khỏi hệ thống.</div>
                    </div>

                    <form action="?controller=deleteGrade&id=<?= urlencode((string)$grade->getId()) ?>" method="POST" class="d-flex justify-content-center gap-2">
                        <a href="?controller=grade&action=index" class="btn-cancel">
                            <i class="bi bi-x-circle"></i><span>Hủy bỏ, giữ lại</span>
                        </a>
                        <button type="submit" name="btn_confirm_delete" class="btn-confirm-delete">
                            <i class="bi bi-trash3"></i><span>Xác nhận xóa vĩnh viễn</span>
                        </button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
