<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | RTSS Academy</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="dashboard-body">

<?php include 'includes/student_sidebar.php'; ?>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="dashboard-main">
<?php include 'includes/student_topbar.php'; ?>

<?php
    $page = $_GET['page'] ?? 'profile';
    $allowed_pages = [
        'profile',
        'academic_register',
        'attendance',
        'library_books',
        'fee_details',
        'marks',
        'time_table',
        'topics_covered'
    ];

    if (in_array($page, $allowed_pages)) {
        include "modules/student/{$page}.php";
    } else {
        include "modules/student/profile.php";
    }
?>
    </main>

    <script>
        lucide.createIcons();

        // Sidebar toggle
        const menuToggles = document.querySelectorAll('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        menuToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('mobile-open');
                    overlay.classList.toggle('active');
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            });
        });

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            });
        }

        // Sidebar Navigation Active State Toggle & Routing is now handled by PHP
    </script>
</body>

</html>
