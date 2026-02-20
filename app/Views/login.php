<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login OABS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

</head>
<body>

<div class="container py-4">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">

            <div class="card login-card border-0">
                <div class="card-body p-4 p-lg-4">

                    <div class="d-flex justify-content-center mb-3">
                        <span class="icon-circle"><i class="bi bi-calendar-check"></i></span>
                    </div>
                    <h4 class="text-center fw-semibold mb-1">Welcome to OABS</h4>
                    <p class="text-center text-muted small mb-4">Online Appointment Booking System</p>

                    <?php if (session('success')): ?>
                        <div class="alert alert-success py-2 small mb-3"><?= esc(session('success')) ?></div>
                    <?php endif; ?>

                    <?php if (session('error')): ?>
                        <div class="alert alert-danger py-2 small mb-3"><?= esc(session('error')) ?></div>
                    <?php endif; ?>

                    <?php $errors = session('errors'); ?>
                    <?php if ($errors): ?>
                        <div class="alert alert-danger py-2 small mb-3">
                            <ul class="mb-0 ps-3">
                                <?php foreach ($errors as $msg): ?>
                                    <li><?= esc($msg) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('login') ?>" method="post" novalidate>
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="you@example.com" value="<?= old('email') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Enter your password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Show password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                                <label class="form-check-label small" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="small text-decoration-none">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-accent text-white w-100 mb-2">Sign In</button>
                    </form>

                    <p class="text-center text-muted small mt-3 mb-0">
                        Don't have an account? <a href="#" class="text-decoration-none">Register</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
    <style>
        :root {
            --primary: #14B8A6;   /* teal */
            --secondary: #1E3A8A; /* navy */
            --background: #FFFFFF;
            --accent: #F3F4F6;    /* light gray */
        }

        body {
            background: radial-gradient(circle at 15% 20%, rgba(20, 184, 166, 0.08), transparent 32%),
                        radial-gradient(circle at 80% 12%, rgba(30, 58, 138, 0.08), transparent 30%),
                        var(--accent);
            font-family: "Segoe UI", system-ui, sans-serif;
        }

        .login-card {
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: var(--background);
            box-shadow: 0 16px 46px rgba(30, 58, 138, 0.14);
        }

        .icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 10px 20px rgba(20, 184, 166, 0.25);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            box-shadow: 0 10px 24px rgba(30, 58, 138, 0.2);
        }
        .btn-accent:hover { background: linear-gradient(135deg, #0fa08f, #172c66); }

        .input-group-text {
            background: #fff;
            border-right: 0;
            color: #9ca3af;
        }

        .input-group .form-control {
            border-left: 0;
            padding-left: 0.5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(20, 184, 166, 0.15);
            border-color: var(--primary);
        }
    </style>

<script>
    (function() {
        const toggle = document.getElementById('togglePassword');
        const pwd = document.getElementById('password');
        if (toggle && pwd) {
            toggle.addEventListener('click', () => {
                const isHidden = pwd.type === 'password';
                pwd.type = isHidden ? 'text' : 'password';
                const icon = toggle.querySelector('i');
                if (icon) {
                    icon.classList.toggle('bi-eye', !isHidden);
                    icon.classList.toggle('bi-eye-slash', isHidden);
                }
                toggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        }
    })();
</script>
</html>
