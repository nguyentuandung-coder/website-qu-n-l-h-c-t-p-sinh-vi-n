<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên - StudyHub</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS giao dien chung StudyHub -->
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

            <!-- Ho tro -->


        </aside>


        <!-- KHU VUC NOI DUNG -->
        <div class="main-area">

            <!-- HEADER -->
            <header class="top-header">

                <h5 class="header-title">Quản lý sinh viên</h5>

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


            <!-- NOI DUNG CHINH -->
            <main class="content">

                <!-- Banner -->
                <div class="page-banner">

                    <div class="page-banner-title">
                        <h2>Danh mục Sinh viên</h2>
                        <p>
                            Quản lý hồ sơ, thông tin liên hệ và lớp học của sinh viên.
                        </p>
                    </div>

                    <a href="?controller=addStudent" class="btn-add-student">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Thêm sinh viên mới</span>
                    </a>

                </div>


                <!-- Bang danh sach sinh vien -->
                <div class="table-card">

                    <div class="table-card-header">

                        <h4 class="table-card-title">
                            <i class="bi bi-people-fill text-primary"></i>
                            <span>Danh sách sinh viên</span>

                            <span class="badge-count">
                                <?= !empty($students) ? count($students) : 0 ?> sinh viên
                            </span>
                        </h4>

                    </div>


                    <div class="table-responsive">

                        <table class="table-custom">

                            <thead>
                                <tr>
                                    <th style="text-align: center;">ID</th>
                                    <th>Mã sinh viên</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Lớp</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if (!empty($students)): ?>

                                    <?php foreach ($students as $student): ?>

                                        <tr>
                                            <td style="text-align: center; color: #64748b; font-weight: 600;">
                                                #<?= htmlspecialchars((string)$student->getId()) ?>
                                            </td>

                                            <td>
                                                <span class="badge-code">
                                                    <?= htmlspecialchars($student->getStudentCode()) ?>
                                                </span>
                                            </td>

                                            <td style="font-weight: 600;">
                                                <?= htmlspecialchars($student->getFullName()) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($student->getEmail() ?? '') ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($student->getPhone() ?? '') ?>
                                            </td>

                                            <td>
                                                <span class="badge-class">
                                                    <?= htmlspecialchars($student->getClassName() ?? '') ?>
                                                </span>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($student->getDateOfBirth() ?? '') ?>
                                            </td>

                                            <td>
                                                <span class="badge-gender">
                                                    <?= htmlspecialchars($student->getGender() ?? '') ?>
                                                </span>
                                            </td>

                                            <td style="text-align: center;">
                                                <div class="d-inline-flex gap-2">

                                                    <a href="?controller=editStudent&id=<?= urlencode((string)$student->getId()) ?>"
                                                        class="btn-action-edit"
                                                        title="Chỉnh sửa sinh viên">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <a href="?controller=deleteStudent&id=<?= urlencode((string)$student->getId()) ?>"
                                                        class="btn-action-delete"
                                                        title="Xóa sinh viên">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="9">

                                            <div class="empty-table-state">

                                                <div class="empty-table-icon">
                                                    <i class="bi bi-people"></i>
                                                </div>

                                                <h5 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">
                                                    Chưa có sinh viên nào
                                                </h5>

                                                <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto 18px;">
                                                    Hiện tại cơ sở dữ liệu chưa có sinh viên nào.
                                                    Hãy thêm sinh viên đầu tiên để bắt đầu quản lý.
                                                </p>

                                                <a href="?controller=addStudent" class="btn-add-student">
                                                    <i class="bi bi-plus-circle-fill"></i>
                                                    <span>Thêm sinh viên ngay</span>
                                                </a>

                                            </div>

                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
