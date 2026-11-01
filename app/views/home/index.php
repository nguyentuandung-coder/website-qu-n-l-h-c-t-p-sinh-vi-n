<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="asset/css/style.css">
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

                <a href="?controller=home" class="menu-link active">
                    <i class="bi bi-grid"></i>
                    <span>Trang chủ</span>
                </a>

                <a href="?controller=student&action=index" class="menu-link">
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

                <h5 class="header-title">Trang chủ</h5>

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

                <!-- Banner chao mung -->
                <section class="welcome-box">

                    <div class="semester-badge">
                        <i class="bi bi-circle-fill" style="font-size: 8px;"></i>
                        HỌC KỲ II • NĂM HỌC 2024–2025
                    </div>

                    <h1>Chào mừng đến với StudyHub — Không gian quản trị học tập</h1>

                    <p>
                        Nền tảng quản lý hồ sơ sinh viên, tiến độ đào tạo và kiểm soát
                        chất lượng điểm học tập tập trung. Mọi thông tin được tổ chức
                        rõ ràng, giúp việc quản lý thuận tiện hơn.
                    </p>

                </section>


                <!-- Cac the thong ke -->
                <section class="stats-row" style="grid-template-columns: repeat(2, minmax(0, 1fr));">

                    <div class="stat-card">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">TỔNG SỐ SINH VIÊN</p>
                                <h2 class="stat-number"><?= number_format(count($students)) ?></h2>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>

                        <p class="stat-description">
                            Thống kê số lượng sinh viên trong hệ thống
                        </p>

                        <div class="progress-line">
                            <div class="progress-value" style="width: 75%;"></div>
                        </div>
                    </div>


                    <div class="stat-card">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">TỔNG SỐ MÔN HỌC</p>
                                <h2 class="stat-number"><?= number_format(count($subjects)) ?></h2>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-journal-bookmark-fill"></i>
                            </div>
                        </div>

                        <p class="stat-description">
                            Danh sách môn học đang được quản lý
                        </p>

                        <div class="progress-line">
                            <div class="progress-value" style="width: 60%;"></div>
                        </div>
                    </div>




                </section>


                <!-- Khu vuc lam viec -->
                <section class="workspace">

                    <div class="workspace-header">
                        <div>
                            <h5>Không gian làm việc hiện tại</h5>
                            <p>
                                Khu vực sẵn sàng hiển thị danh sách, biểu mẫu
                                hoặc thông tin quản lý.
                            </p>
                        </div>
                    </div>

                    <div class="workspace-empty">

                        <div class="empty-icon">
                            <i class="bi bi-grid-1x2"></i>
                        </div>

                        <h5>Chào mừng bạn đến với StudyHub</h5>

                        <p>
                            Hãy chọn chức năng quản lý ở thanh điều hướng bên trái
                            để bắt đầu làm việc với dữ liệu sinh viên, môn học và điểm.
                        </p>

                        <div class="d-flex justify-content-center flex-wrap gap-2">

                            <a href="?controller=subject&action=index" class="btn-purple">
                                <i class="bi bi-book me-1"></i>
                                Quản lý môn học
                            </a>

                            <a href="?controller=grade&action=index" class="btn-light-purple">
                                <i class="bi bi-star me-1"></i>
                                Quản lý điểm
                            </a>

                        </div>

                    </div>

                    <div class="notice-box">
                        <i class="bi bi-info-circle"></i>

                        <span>
                            Gợi ý: Chọn một chức năng ở menu bên trái để chuyển
                            đến trang quản lý tương ứng.
                        </span>
                    </div>

                </section>

            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>