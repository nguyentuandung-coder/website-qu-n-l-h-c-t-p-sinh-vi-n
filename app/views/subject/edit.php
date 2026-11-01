<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa môn học - StudyHub</title>

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


        <!-- KHU VUC NOI DUNG (MAIN AREA) -->
        <div class="main-area">

            <!-- HEADER -->
            <header class="top-header">

                <h5 class="header-title">Quản lý môn học • Chỉnh sửa</h5>

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

                <!-- Nut quay lai -->
                <div class="mb-3">
                    <a href="?controller=subject&action=index" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách môn học
                    </a>
                </div>

                <!-- Form Card -->
                <div class="form-card">

                    <div class="form-card-header">
                        <div class="edit-icon-box">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h3 class="form-title">Cập nhật môn học</h3>
                        <p class="form-subtitle">Chỉnh sửa thông tin mã môn, tên môn hoặc số tín chỉ đào tạo</p>
                        <span class="subject-badge-id">
                            <i class="bi bi-hash"></i> ID môn học: <?= htmlspecialchars($subject->getId()) ?>
                        </span>
                    </div>

                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger d-flex align-items-center mb-4 py-2 px-3" role="alert" style="border-radius: 12px; font-size: 13.5px;">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 text-danger flex-shrink-0"></i>
                            <div><?= htmlspecialchars($errorMessage); ?></div>
                        </div>
                    <?php endif; ?>

                    <form action="?controller=editSubject&id=<?= $subject->getId() ?>" method="POST">
                        
                        <!-- Ma mon hoc -->
                        <div class="form-group-custom">
                            <label for="code" class="form-label-custom">Mã môn học <span class="text-danger">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="bi bi-upc-scan"></i></span>
                                <input type="text" 
                                       class="form-input-custom" 
                                       id="code" 
                                       name="code" 
                                       value="<?= htmlspecialchars($code ?? $subject->getCode()) ?>" 
                                       required>
                            </div>
                        </div>

                        <!-- Ten mon hoc -->
                        <div class="form-group-custom">
                            <label for="name" class="form-label-custom">Tên môn học <span class="text-danger">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="bi bi-book"></i></span>
                                <input type="text" 
                                       class="form-input-custom" 
                                       id="name" 
                                       name="name" 
                                       value="<?= htmlspecialchars($name ?? $subject->getName()) ?>" 
                                       required>
                            </div>
                        </div>

                        <!-- So tin chi -->
                        <div class="form-group-custom">
                            <label for="credits" class="form-label-custom">Số tín chỉ <span class="text-danger">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="bi bi-award"></i></span>
                                <input type="number" 
                                       class="form-input-custom" 
                                       id="credits" 
                                       name="credits" 
                                       min="1" 
                                       max="10" 
                                       value="<?= htmlspecialchars((string)($credits ?? $subject->getCredits())) ?>" 
                                       required>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-2">
                            <a href="?controller=subject&action=index" class="btn-cancel-custom">
                                <i class="bi bi-x-circle"></i>
                                <span>Hủy bỏ</span>
                            </a>

                            <button type="submit" name="btn_update" class="btn-submit-blue">
                                <i class="bi bi-save2"></i>
                                <span>Cập nhật thay đổi</span>
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
