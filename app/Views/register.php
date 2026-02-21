<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | OABS</title>
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
                        <span class="icon-circle"><i class="bi bi-person-plus"></i></span>
                    </div>
                    <h4 class="text-center fw-semibold mb-1">Create your account</h4>
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

                    <form id="registerForm" action="<?= site_url('register') ?>" method="post" novalidate>
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Juan Dela Cruz" value="<?= old('name') ?>" required>
                            </div>
                            <div class="form-text text-danger small d-none" id="nameRule">Only letters, spaces, and ñ are allowed.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="you@example.com" value="<?= old('email') ?>" required>
                            </div>
                            <div class="form-text text-danger small d-none" id="emailRule">Max 5 special characters and 8 numbers allowed.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="At least 6 characters" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                                       placeholder="Re-enter password" required>
                            </div>
                            <div class="form-text text-danger small d-none" id="passwordRule">Passwords must match.</div>
                        </div>

                        <button type="submit" class="btn btn-accent text-white w-100 mb-2">Register</button>
                    </form>

                    <p class="text-center text-muted small mt-3 mb-0">
                        Already have an account? <a href="<?= site_url('login') ?>" class="text-decoration-none">Sign In</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    :root {
        --primary: #14B8A6;
        --secondary: #1E3A8A;
        --background: #FFFFFF;
        --accent: #F3F4F6;
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validation rules: email max 5 specials & 8 digits; name only letters/spaces/ñ; passwords must match.
    (function() {
        const form = document.getElementById('registerForm');
        const emailInput = document.getElementById('email');
        const emailRule = document.getElementById('emailRule');
        const nameInput = document.getElementById('name');
        const nameRule = document.getElementById('nameRule');
        const pass = document.getElementById('password');
        const pass2 = document.getElementById('password_confirm');
        const passRule = document.getElementById('passwordRule');

        const show = (el) => el && el.classList.remove('d-none');
        const hide = (el) => el && el.classList.add('d-none');

        const validateEmail = () => {
            const val = emailInput.value || '';
            const specials = (val.match(/[^a-zA-Z0-9]/g) || []).length;
            const digits = (val.match(/\d/g) || []).length;
            const ok = specials <= 5 && digits <= 8;
            if (!ok) { show(emailRule); emailInput.classList.add('is-invalid'); }
            else { hide(emailRule); emailInput.classList.remove('is-invalid'); }
            return ok;
        };

        const validateName = () => {
            const val = nameInput.value || '';
            const ok = /^[A-Za-zñÑ\s]+$/.test(val);
            if (!ok) { show(nameRule); nameInput.classList.add('is-invalid'); }
            else { hide(nameRule); nameInput.classList.remove('is-invalid'); }
            return ok;
        };

        const validatePass = () => {
            const ok = (pass.value || '') === (pass2.value || '');
            if (!ok) { show(passRule); pass2.classList.add('is-invalid'); }
            else { hide(passRule); pass2.classList.remove('is-invalid'); }
            return ok;
        };

        [emailInput, nameInput, pass, pass2].forEach(el => el && el.addEventListener('input', () => {
            validateEmail();
            validateName();
            validatePass();
        }));

        if (form) {
            form.addEventListener('submit', (e) => {
                const ok = validateEmail() & validateName() & validatePass();
                if (!ok) e.preventDefault();
            });
        }
    })();
</script>
</body>
</html>
