<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User | OABS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="mb-3">Add User (Admin / Client)</h5>

                    <?php if (session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= esc(session('success')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= esc(session('error')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
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

                    <form action="<?= site_url('admin/users/create') ?>" method="post" novalidate>
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="" disabled <?= old('role') ? '' : 'selected' ?>>Choose role</option>
                                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="client" <?= old('role') === 'client' ? 'selected' : '' ?>>Client</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('/dashboard') ?>" class="btn btn-outline-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
