<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Môn học - StudyHub</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Giao dien chung StudyHub -->
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- CSS Quan ly Mon hoc -->
    <link rel="stylesheet" href="asset/css/subject.css">
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

                <a href="?controller=student&action=index" class="menu-link">
                    <i class="bi bi-people"></i>
                    <span>Quản lý sinh viên</span>
                </a>

                <a href="?controller=subject&action=index" class="menu-link active">
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


        <!-- KHU VUC NOI DUNG (MAIN AREA) -->
        <div class="main-area">

            <!-- HEADER -->
            <header class="top-header">

                <h5 class="header-title">Quản lý môn học</h5>

                <div class="header-right">

                    <div class="user-info">
                        <div class="text-end">
                            <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Quản trị viên') ?></strong>
                            <p>Quản trị hệ thống</p>
                        </div>

                        <div class="user-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>

                        <a href="?controller=auth&action=logout" class="header-button text-danger text-decoration-none d-flex align-items-center justify-content-center ms-2" title="Đăng xuất" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </a>
                    </div>

                </div>

            </header>


            <!-- NOI DUNG CHINH -->
            <main class="content">

                <!-- Page Banner -->
                <div class="page-banner">
                    <div class="page-banner-title">
                        <h2>Danh mục Môn học</h2>
                        <p>Quản lý danh sách các môn học, số tín chỉ và thông tin đào tạo của nhà trường</p>
                    </div>

                    <a href="?controller=addSubject" class="btn-add-subject">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Thêm môn học mới</span>
                    </a>
                </div>

                <!-- Table Card -->
                <div class="table-card">

                    <div class="table-card-header">
                        <h4 class="table-card-title">
                            <i class="bi bi-journal-text text-primary"></i>
                            <span>Danh sách môn học</span>
                            <span class="badge-count"><?= !empty($subjects) ? count($subjects) : 0 ?> môn</span>
                        </h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th style="width: 70px; text-align: center;">ID</th>
                                    <th style="width: 160px;">Mã môn học</th>
                                    <th>Tên môn học</th>
                                    <th style="width: 140px; text-align: center;">Số tín chỉ</th>
                                    <th style="width: 110px; text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($subjects)): ?>
                                    <?php foreach ($subjects as $subject): ?>
                                        <tr>
                                            <td style="text-align: center; color: #64748b; font-weight: 600;">
                                                #<?= $subject->getId(); ?>
                                            </td>
                                            <td>
                                                <span class="badge-code"><?= htmlspecialchars($subject->getCode()); ?></span>
                                            </td>
                                            <td>
                                                <span style="font-weight: 600; color: #0f172a;">
                                                    <?= htmlspecialchars($subject->getName()); ?>
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <span class="badge-credits">
                                                    <i class="bi bi-award me-1"></i><?= $subject->getCredits(); ?> Tín chỉ
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="d-inline-flex gap-2">
                                                    <a href="?controller=editSubject&id=<?= $subject->getId() ?>" class="btn-action-edit" title="Chỉnh sửa môn học">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="?controller=deleteSubject&id=<?= $subject->getId() ?>" class="btn-action-delete" title="Xóa môn học">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty-table-state">
                                                <div class="empty-table-icon">
                                                    <i class="bi bi-journal-x"></i>
                                                </div>
                                                <h5 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Chưa có môn học nào</h5>
                                                <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto 18px;">
                                                    Hiện tại cơ sở dữ liệu chưa có môn học nào. Hãy thêm môn học đầu tiên để bắt đầu quản lý.
                                                </p>
                                                <a href="?controller=addSubject" class="btn-add-subject">
                                                    <i class="bi bi-plus-circle-fill"></i>
                                                    <span>Thêm môn học ngay</span>
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