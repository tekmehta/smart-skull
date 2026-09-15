<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lumina Academy</title>
    <meta name="description" content="Sign in to your Lumina Academy student, teacher, or parent portal.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="login.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="login-body">

    <!-- Background blobs (reuse from main) -->
    <div class="login-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <header>
        <a href="index.php" class="brand-logo">Lumina.</a>
        <a href="index.php" class="btn-back"><i data-lucide="arrow-left"></i> Back to Home</a>
    </header>

    <main class="login-main">
        <div class="login-box">
            <div class="login-header">
                <h1>Welcome Back</h1>
                <p>Select your role and sign in to your portal.</p>
            </div>

            <!-- Role Tabs -->
            <div class="role-tabs" role="tablist">
                <button class="role-tab active" data-role="student" role="tab" aria-selected="true">
                    <span class="tab-icon"><i data-lucide="graduation-cap"></i></span>
                    <span>Student</span>
                </button>
                <button class="role-tab" data-role="teacher" role="tab" aria-selected="false">
                    <span class="tab-icon"><i data-lucide="book-open"></i></span>
                    <span>Teacher</span>
                </button>
                <button class="role-tab" data-role="parent" role="tab" aria-selected="false">
                    <span class="tab-icon"><i data-lucide="users"></i></span>
                    <span>Parent</span>
                </button>
            </div>

            <!-- Student Login Form -->
            <form class="login-form active" id="form-student" action="student_dashboard.php" method="GET" novalidate>
                <input type="hidden" name="role" value="student">
                <div class="form-group">
                    <label for="student-id">Student ID / Email</label>
                    <div class="input-wrapper">
                        <i data-lucide="user" class="input-icon"></i>
                        <input type="text" id="student-id" name="username" placeholder="Enter your student ID" required
                            autocomplete="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="student-pass">Password</label>
                    <div class="input-wrapper">
                        <i data-lucide="lock" class="input-icon"></i>
                        <input type="password" id="student-pass" name="password" placeholder="Enter your password"
                            required autocomplete="current-password">
                        <button type="button" class="pass-toggle" aria-label="Toggle password visibility">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot">Forgot password?</a>
                </div>
                <button type="submit" class="btn-submit student-btn">
                    <i data-lucide="log-in"></i> Sign in as Student
                </button>
            </form>

            <!-- Teacher Login Form -->
            <form class="login-form" id="form-teacher" action="teacher_login.php" method="POST" novalidate>
                <input type="hidden" name="role" value="teacher">
                <div class="form-group">
                    <label for="teacher-id">Teacher ID / Email</label>
                    <div class="input-wrapper">
                        <i data-lucide="user" class="input-icon"></i>
                        <input type="text" id="teacher-id" name="username" placeholder="Enter your teacher ID" required
                            autocomplete="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="teacher-pass">Password</label>
                    <div class="input-wrapper">
                        <i data-lucide="lock" class="input-icon"></i>
                        <input type="password" id="teacher-pass" name="password" placeholder="Enter your password"
                            required autocomplete="current-password">
                        <button type="button" class="pass-toggle" aria-label="Toggle password visibility">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot">Forgot password?</a>
                </div>
                <button type="submit" class="btn-submit teacher-btn">
                    <i data-lucide="log-in"></i> Sign in as Teacher
                </button>
            </form>

            <!-- Parent Login Form -->
            <form class="login-form" id="form-parent" action="parent_login.php" method="POST" novalidate>
                <input type="hidden" name="role" value="parent">
                <div class="form-group">
                    <label for="parent-id">Parent ID / Email</label>
                    <div class="input-wrapper">
                        <i data-lucide="user" class="input-icon"></i>
                        <input type="text" id="parent-id" name="username" placeholder="Enter your parent ID" required
                            autocomplete="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent-pass">Password</label>
                    <div class="input-wrapper">
                        <i data-lucide="lock" class="input-icon"></i>
                        <input type="password" id="parent-pass" name="password" placeholder="Enter your password"
                            required autocomplete="current-password">
                        <button type="button" class="pass-toggle" aria-label="Toggle password visibility">
                            <i data-lucide="eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot">Forgot password?</a>
                </div>
                <button type="submit" class="btn-submit parent-btn">
                    <i data-lucide="log-in"></i> Sign in as Parent
                </button>
            </form>

        </div>
    </main>

    <script>
        lucide.createIcons();

        // Tab Switching
        const tabs = document.querySelectorAll('.role-tab');
        const forms = document.querySelectorAll('.login-form');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const role = tab.dataset.role;

                tabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected', 'false'); });
                forms.forEach(f => f.classList.remove('active'));

                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                document.getElementById('form-' + role).classList.add('active');
            });
        });

        // Password Toggle
        document.querySelectorAll('.pass-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.closest('.input-wrapper').querySelector('input');
                const isText = input.type === 'text';
                input.type = isText ? 'password' : 'text';
                btn.innerHTML = isText
                    ? '<i data-lucide="eye"></i>'
                    : '<i data-lucide="eye-off"></i>';
                lucide.createIcons();
            });
        });
    </script>
</body>

</html>