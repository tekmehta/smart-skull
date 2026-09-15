    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="index.php" class="brand-logo">
                <img src="assets/images/14860.jpg" alt="" height="100px" style="border-radius: 30%;">
            </a>
            <button class="menu-toggle" aria-label="Toggle menu"><i data-lucide="menu"></i></button>
        </div>

        <div class="user-profile">
            <div class="avatar">
                <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=4f46e5&color=fff&bold=true"
                    alt="Student">
            </div>
            <div class="user-info">
                <h3>Alex Johnson</h3>
                <p>Grade 10 - Section A</p>
                <span class="role-badge">Student</span>
            </div>
        </div>

        <?php $current_page = $_GET['page'] ?? 'profile'; ?>
        <nav class="sidebar-nav">
            <a href="?page=academic_register" class="nav-item <?= $current_page == 'academic_register' ? 'active' : '' ?>"><i data-lucide="book-check"></i> Academic Register</a>
            <a href="?page=profile" class="nav-item <?= $current_page == 'profile' ? 'active' : '' ?>"><i data-lucide="user"></i> Profile</a>
            <a href="?page=attendance" class="nav-item <?= $current_page == 'attendance' ? 'active' : '' ?>"><i data-lucide="user-check"></i> Attendance</a>
            <a href="?page=library_books" class="nav-item <?= $current_page == 'library_books' ? 'active' : '' ?>"><i data-lucide="library"></i> Library Books</a>
            <a href="?page=fee_details" class="nav-item <?= $current_page == 'fee_details' ? 'active' : '' ?>"><i data-lucide="dollar-sign"></i> Fee Details</a>
            <a href="?page=marks" class="nav-item <?= $current_page == 'marks' ? 'active' : '' ?>"><i data-lucide="award"></i> Marks</a>
            <a href="?page=time_table" class="nav-item <?= $current_page == 'time_table' ? 'active' : '' ?>"><i data-lucide="calendar"></i> Time Table</a>
            <a href="?page=topics_covered" class="nav-item <?= $current_page == 'topics_covered' ? 'active' : '' ?>"><i data-lucide="book-open"></i> Topics Covered</a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="nav-item"><i data-lucide="settings"></i> Settings</a>
            <a href="login.html" class="nav-item logout"><i data-lucide="log-out"></i> Logout</a>
        </div>
    </aside>
