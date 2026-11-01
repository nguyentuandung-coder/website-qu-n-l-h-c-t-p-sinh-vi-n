<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý điểm - StudyHub</title>

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
                <a href="?controller=home" class="menu-link">
                    <i class="bi bi-grid"></i><span>Trang chủ</span>
                </a>
                <a href="?controller=student&action=index" class="menu-link">
                    <i class="bi bi-people"></i><span>Quản lý sinh viên</span>
                </a>
                <a href="?controller=subject&action=index" class="menu-link">
                    <i class="bi bi-book"></i><span>Quản lý môn học</span>
                </a>
                <a href="?controller=grade&action=index" class="menu-link active">
                    <i class="bi bi-star"></i><span>Quản lý điểm</span>
                </a>
            </nav>


        </aside>

        <div class="main-area">
            <header class="top-header">
                <h5 class="header-title">Quản lý điểm</h5>
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

            <main class="content">
                <div class="page-banner">
                    <div class="page-banner-title">
                        <h2>Quản lý điểm sinh viên</h2>
                        <p>Theo dõi điểm số theo sinh viên và môn học</p>
                    </div>
                    <a href="?controller=addGrade" class="btn-add-grade">
                        <i class="bi bi-plus-circle-fill"></i><span>Thêm điểm mới</span>
                    </a>
                </div>

                <!-- Thanh Bo Loc Lop & Mon Hoc -->
                <div class="filter-card mb-4" style="background: #ffffff; border: 1px solid #eeeeF5; border-radius: 16px; padding: 18px 24px; box-shadow: 0 2px 8px rgba(20, 20, 60, 0.03);">
                    <form method="GET" action="" class="row g-3 align-items-end">
                        <input type="hidden" name="controller" value="grade">
                        <input type="hidden" name="action" value="index">

                        <!-- Loc theo Lop -->
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label mb-1" style="font-size: 13px; font-weight: 600; color: #475569;">
                                <i class="bi bi-people-fill text-primary me-1"></i> Lớp học
                            </label>
                            <select name="class" class="form-select form-select-sm" style="border-radius: 10px; height: 40px; font-size: 13.5px; border-color: #e2e8f0;">
                                <option value="">-- Tất cả các lớp --</option>
                                <?php if (!empty($classes)): ?>
                                    <?php foreach ($classes as $c): ?>
                                        <option value="<?= htmlspecialchars($c) ?>" <?= ($selectedClass ?? '') === $c ? 'selected' : '' ?>>
                                            Lớp <?= htmlspecialchars($c) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Loc theo Mon hoc -->
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label mb-1" style="font-size: 13px; font-weight: 600; color: #475569;">
                                <i class="bi bi-book-fill text-primary me-1"></i> Môn học
                            </label>
                            <select name="subject_id" class="form-select form-select-sm" style="border-radius: 10px; height: 40px; font-size: 13.5px; border-color: #e2e8f0;">
                                <option value="0">-- Tất cả các môn học --</option>
                                <?php if (!empty($subjects)): ?>
                                    <?php foreach ($subjects as $s): ?>
                                        <option value="<?= $s->getId() ?>" <?= ($selectedSubject ?? 0) == $s->getId() ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($s->getName()) ?> (<?= htmlspecialchars($s->getCode()) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Nut thao tac -->
                        <div class="col-md-4 col-sm-12 d-flex gap-2">
                            <button type="submit" class="btn btn-purple d-flex align-items-center justify-content-center" style="height: 40px; border-radius: 10px; padding: 0 20px; font-size: 13.5px;">
                                <i class="bi bi-funnel-fill me-1"></i> Lọc dữ liệu
                            </button>

                            <?php if (!empty($selectedClass) || !empty($selectedSubject)): ?>
                                <a href="?controller=grade&action=index" class="btn btn-light-purple d-flex align-items-center justify-content-center" style="height: 40px; border-radius: 10px; padding: 0 16px; font-size: 13.5px;" title="Xóa bộ lọc">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Đặt lại
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <?php if (!empty($selectedClass) || !empty($selectedSubject)): ?>
                        <div class="mt-2 pt-2 border-top d-flex align-items-center gap-2" style="font-size: 12.5px; color: #64748b;">
                            <i class="bi bi-info-circle text-primary"></i>
                            <span>
                                Đang lọc: 
                                <strong><?= !empty($selectedClass) ? 'Lớp ' . htmlspecialchars($selectedClass) : 'Mọi lớp' ?></strong> 
                                • 
                                <strong>
                                    <?php
                                        $subName = 'Mọi môn';
                                        if (!empty($selectedSubject) && !empty($subjects)) {
                                            foreach ($subjects as $sb) {
                                                if ($sb->getId() == $selectedSubject) {
                                                    $subName = 'Môn ' . $sb->getName();
                                                    break;
                                                }
                                            }
                                        }
                                        echo htmlspecialchars($subName);
                                    ?>
                                </strong>
                                (Tìm thấy <strong><?= count($grades) ?></strong> kết quả)
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="table-card">
                    <div class="table-card-header">
                        <h4 class="table-card-title">
                            <i class="bi bi-journal-check text-primary"></i>
                            <span>Danh sách điểm</span>
                            <span class="badge-count"><?= !empty($grades) ? count($grades) : 0 ?> điểm</span>
                        </h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th style="width: 75px; text-align: center;">ID</th>
                                    <th style="width: 140px;">Mã sinh viên</th>
                                    <th>Họ tên</th>
                                    <th style="width: 130px;">Lớp</th>
                                    <th>Môn học</th>
                                    <th style="width: 100px; text-align: center;">Điểm</th>
                                    <th style="width: 110px; text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($grades)): ?>
                                    <?php foreach ($grades as $grade): ?>
                                        <tr>
                                            <td style="text-align: center; color: #64748b; font-weight: 600;">
                                                #<?= htmlspecialchars((string)$grade->getId()); ?>
                                            </td>
                                            <td>
                                                <span class="badge-code"><?= htmlspecialchars((string)$grade->getStudentCode()); ?></span>
                                            </td>
                                            <td style="font-weight: 600; color: #0f172a;">
                                                <?= htmlspecialchars((string)$grade->getName()); ?>
                                            </td>
                                            <td><?= htmlspecialchars((string)$grade->getClassName()); ?></td>
                                            <td><?= htmlspecialchars((string)$grade->getSubjectName()); ?></td>
                                            <td style="text-align: center;">
                                                <span class="badge-grade"><?= htmlspecialchars((string)$grade->getScore()); ?></span>
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="d-inline-flex gap-2">
                                                    <a href="?controller=editGrade&id=<?= urlencode((string)$grade->getId()); ?>" class="btn-action-edit" title="Chỉnh sửa điểm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="?controller=deleteGrade&id=<?= urlencode((string)$grade->getId()); ?>" class="btn-action-delete" title="Xóa điểm">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-table-state">
                                                <div class="empty-table-icon"><i class="bi bi-journal-x"></i></div>
                                                <?php if (!empty($selectedClass) || !empty($selectedSubject)): ?>
                                                    <h5 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Không tìm thấy kết quả phù hợp</h5>
                                                    <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto 18px;">
                                                        Không có bản ghi điểm nào thỏa mãn điều kiện lọc. Hãy thử chọn lớp hoặc môn học khác.
                                                    </p>
                                                    <a href="?controller=grade&action=index" class="btn btn-light-purple" style="font-size: 13px;">
                                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Xóa bộ lọc
                                                    </a>
                                                <?php else: ?>
                                                    <h5 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Chưa có điểm nào</h5>
                                                    <p style="color: #64748b; font-size: 13.5px; max-width: 420px; margin: 0 auto 18px;">
                                                        Hiện tại chưa có điểm trong cơ sở dữ liệu. Hãy thêm điểm đầu tiên để bắt đầu quản lý.
                                                    </p>
                                                    <a href="?controller=addGrade" class="btn-add-grade">
                                                        <i class="bi bi-plus-circle-fill"></i><span>Thêm điểm ngay</span>
                                                    </a>
                                                <?php endif; ?>
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