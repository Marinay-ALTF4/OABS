<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OABS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="mb-0">Hi, <?= esc($user['name'] ?? 'User') ?></h4>
            <small class="text-muted">Signed in as <?= esc($user['role'] ?? 'guest') ?></small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary text-uppercase">Role: <?= esc($user['role'] ?? 'unknown') ?></span>
            <a href="<?= site_url('logout') ?>" class="btn btn-outline-secondary btn-sm">Sign Out</a>
        </div>
    </div>

    <?php if (session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-3 mb-4">
        <?php if (($user['role'] ?? '') === 'admin'): ?>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle-small me-3"><i class="bi bi-calendar-check"></i></div>
                            <div>
                                <div class="text-muted small">Appointments</div>
                                <div class="fw-semibold">Unified schedule</div>
                            </div>
                        </div>
                        <p class="mb-0 text-muted small">View today's bookings and new requests.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle-small me-3"><i class="bi bi-people"></i></div>
                            <div>
                                <div class="text-muted small">Clients</div>
                                <div class="fw-semibold">Profiles & history</div>
                            </div>
                        </div>
                        <p class="mb-0 text-muted small">Keep track of client activity and notes.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle-small me-3"><i class="bi bi-graph-up"></i></div>
                            <div>
                                <div class="text-muted small">Performance</div>
                                <div class="fw-semibold">At-a-glance metrics</div>
                            </div>
                        </div>
                        <p class="mb-0 text-muted small">Quick insights into bookings and cancellations.</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Overview</h6>
                        <span class="badge bg-success">Client</span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="p-3 border rounded-3 bg-light h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-clock-history text-primary me-2"></i>
                                        <span class="fw-semibold">Upcoming Appointment</span>
                                    </div>
                                    <p class="text-muted small mb-2">No appointment scheduled.</p>
                                    <span class="badge bg-secondary">Pending</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="p-3 border rounded-3 h-100">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-bell text-warning me-2"></i>
                                        <span class="fw-semibold">Notifications</span>
                                    </div>
                                    <p class="text-muted small mb-2">No new notifications.</p>
                                    <button class="btn btn-outline-primary btn-sm" type="button" disabled>View all</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Profile</h6>
                        <i class="bi bi-person-circle text-secondary"></i>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle-small me-3"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="fw-semibold mb-1"><?= esc($user['name'] ?? 'Guest') ?></div>
                                <div class="text-muted small mb-1"><?= esc($user['email'] ?? '') ?></div>
                                <span class="badge bg-light text-dark text-uppercase"><?= esc($user['role'] ?? 'client') ?></span>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                Contact
                                <span class="text-muted small">Add number</span>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                Security
                                <span class="text-muted small">Password not set</span>
                            </li>
                        </ul>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" type="button" disabled>Edit profile</button>
                            <button class="btn btn-outline-secondary" type="button" disabled>Change password</button>
                            <a class="btn btn-outline-danger" href="<?= site_url('logout') ?>">Logout</a>
                        </div>
                        <p class="small text-muted mb-0 mt-2">Wire these actions to profile endpoints when ready.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- FOR ADMIN -->
    <div class="row g-4">
        <?php if (($user['role'] ?? '') === 'admin'): ?>
            <div class="col-12 col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Admin Panel</h6>
                        <span class="badge bg-warning text-dark">Admin</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                User management
                                <span class="text-muted small">Create, disable, reset access</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Schedule governance
                                <span class="text-muted small">Configure slots and blackout dates</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Reports & exports
                                <span class="text-muted small">Download CSV/PDF summaries</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Recent Activity</h6>
                        <i class="bi bi-lightning-charge text-warning"></i>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-2">Latest admin-side events will appear here.</p>
                        <div class="alert alert-info small mb-0">Connect this to your audit log once data is available.</div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">My Appointments</h6>
                        <span class="badge bg-light text-dark">History</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Your bookings will appear here with status.</p>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-2">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-muted small text-center">No appointments yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-outline-danger btn-sm" type="button" disabled>Cancel (pending)</button>
                            <button class="btn btn-outline-primary btn-sm" type="button" disabled>Reschedule</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Book Appointment</h6>
                        <i class="bi bi-journal-plus text-primary"></i>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <button class="btn btn-primary w-100" type="button" disabled>Select service</button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button class="btn btn-outline-secondary w-100" type="button" disabled>Choose doctor</button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button class="btn btn-outline-secondary w-100" type="button" disabled>Pick date & time</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success w-100" type="button" disabled>Submit request</button>
                            </div>
                        </div>
                        <p class="small text-muted mt-3 mb-0">Enable these actions once scheduling APIs are wired.</p>
                    </div>
                </div>
            </div>

            
        <?php endif; ?>
    </div>
</div>

<style>
    body { font-family: "Space Grotesk", "Segoe UI", system-ui, sans-serif; }
    .icon-circle-small {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #14b8a6, #1e3a8a);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(20, 184, 166, 0.2);
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
