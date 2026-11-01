<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa sinh viên - StudyHub</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS giao diện chung StudyHub -->
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- CSS Quan ly Sinh vien -->
    <link rel="stylesheet" href="asset/css/student.css">
</head>

<body>

    <div class="dashboard">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <!-- Logo -->
            <a href="?controller=home" class="logo">
                <div class="logo-icon">
                    <i class="bi bi-mortarboard"></i>
                </div>

                <div class="logo-text">
                    <h4>StudyHub</h4>
                    <p>ACADEMIC WORKSPACE</p>
                </div>
            </a>

            <!-- Menu -->
            <p class="menu-title">HỆ THỐNG QUẢN LÝ</p>

            <nav class="menu-links">

                <a href="?controller=home" class="menu-link">
                    <i class="bi bi-grid"></i>
                    <span>Trang chủ</span>
                </a>

                <a href="?controller=student&action=index" class="menu-link active">
                    <i class="bi bi-people"></i>
                    <span>Quản lý sinh viên</span>
                </a>

                <a href="?controller=subject&action=index" class="menu-link">
                    <i class="bi bi-book"></i>
                    <span>Quản lý môn học</span>
                </a>

                <a href="?controller=grade&action=index" class="menu-link">
                    <i class="bi bi-star"></i>
                    <span>Quản lý điểm</span>
                </a>

            </nav>

            <!-- Hỗ trợ -->
            <div class="support-box">
                <div class="support-icon">
                    <i class="bi bi-question-circle"></i>
                </div>

                <div>
                    <strong>Hỗ trợ kỹ thuật</strong>
                    <p>Phòng đào tạo & CNTT</p>
                </div>
            </div>

        </aside>

        <!-- MAIN AREA -->
        <div class="main-area">

            <!-- HEADER -->
            <header class="top-header">

                <h5 class="header-title">Quản lý sinh viên • Xác nhận xóa</h5>

                <div class="header-right">

                    <div class="user-info">

                        <div class="text-end">
                            <strong>
                                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Quản trị viên') ?>
                            </strong>

                            <p>
                                <?= (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student')
                                    ? 'Sinh viên'
                                    : ((isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'teacher')
                                        ? 'Giảng viên'
                                        : 'Quản trị hệ thống') ?>
                            </p>
                        </div>

                        <div class="user-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>

                        <a href="?controller=auth&action=logout"
                            class="header-button text-danger text-decoration-none d-flex align-items-center justify-content-center ms-2"
                            title="Đăng xuất"
                            onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </a>

                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="content">

                <!-- Nút quay lại -->
                <div class="mb-3">
                    <a href="?controller=student&action=index"
                        class="btn btn-sm btn-outline-secondary"
                        style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i>
                        Quay lại danh sách sinh viên
                    </a>
                </div>

                <!-- Card xác nhận xóa -->
                <div class="delete-card">

                    <div class="delete-icon-box">
                        <i class="bi bi-trash3-fill"></i>
                    </div>

                    <h3 class="delete-title">Xác nhận xóa sinh viên?</h3>

                    <p class="delete-desc">
                        Bạn đang chuẩn bị xóa thông tin sinh viên khỏi hệ thống.
                        Vui lòng kiểm tra kỹ thông tin trước khi xác nhận.
                    </p>

                    <!-- Thông tin sinh viên -->
                    <div class="student-info-box">

                        <div class="info-row">
                            <span class="info-label">Mã định danh (ID):</span>
                            <span class="info-value">
                                #<?= htmlspecialchars((string) $student->getId()) ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Mã sinh viên:</span>
                            <span class="badge-code">
                                <?= htmlspecialchars($student->getStudentCode()) ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Họ và tên:</span>
                            <span class="info-value" style="font-size: 15px; color: #1e1b4b;">
                                <?= htmlspecialchars($student->getFullName()) ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Email:</span>
                            <span class="info-value">
                                <?= htmlspecialchars($student->getEmail() ?? '') ?: 'Chưa cập nhật' ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Số điện thoại:</span>
                            <span class="info-value">
                                <?= htmlspecialchars($student->getPhone() ?? '') ?: 'Chưa cập nhật' ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Lớp:</span>
                            <span class="badge-class">
                                <?= htmlspecialchars($student->getClassName()) ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Ngày sinh:</span>
                            <span class="info-value">
                                <?= htmlspecialchars($student->getDateOfBirth() ?? '') ?: 'Chưa cập nhật' ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Giới tính:</span>
                            <span class="info-value">
                                <?= htmlspecialchars($student->getGender()) ?>
                            </span>
                        </div>

                    </div>

                    <!-- Cảnh báo -->
                    <div class="warning-note">
                        <i class="bi bi-exclamation-triangle-fill fs-5 text-warning flex-shrink-0"></i>

                        <div>
                            <strong>Lưu ý quan trọng:</strong>
                            Khi xóa sinh viên, các dữ liệu liên quan như điểm số học tập
                            có thể bị ảnh hưởng. Hãy kiểm tra các ràng buộc khóa ngoại
                            trong cơ sở dữ liệu trước khi thực hiện.
                        </div>
                    </div>

                    <!-- Form xác nhận xóa -->
                    <form action="?controller=deleteStudent&id=<?= urlencode((string) $student->getId()) ?>"
                        method="POST"
                        class="d-flex justify-content-center gap-2 flex-wrap">

                        <a href="?controller=student&action=index" class="btn-cancel">
                            <i class="bi bi-x-circle"></i>
                            <span>Hủy bỏ, giữ lại</span>
                        </a>

                        <button type="submit" name="btn_confirm_delete" class="btn-confirm-delete">
                            <i class="bi bi-trash3"></i>
                            <span>Xác nhận xóa vĩnh viễn</span>
                        </button>

                    </form>

                </div>

            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>