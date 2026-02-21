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
        <?php if (session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= esc(session('error')) ?>
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
            <?php
            // Hardcoded sample appointments for UI demo only (no database calls).
            $appointments = [
                [
                    'ref' => 'APT-2026-001',
                    'date' => '2026-03-15 10:30',
                    'service' => 'General Consultation',
                    'status' => 'confirmed',
                    'doctor' => 'Dr. Amelia Smith',
                    'clinic' => 'OABS Main Clinic, 123 Health St.',
                    'notes' => 'Bring previous reports and lab results.',
                ],
                [
                    'ref' => 'APT-2026-002',
                    'date' => '2026-03-01 15:00',
                    'service' => 'Dermatology Check',
                    'status' => 'pending',
                    'doctor' => 'Dr. Brian Lee',
                    'clinic' => 'Derm Wing, 2nd Floor',
                    'notes' => 'Awaiting confirmation.',
                ],
                [
                    'ref' => 'APT-2026-003',
                    'date' => '2026-02-10 09:00',
                    'service' => 'Dental Cleaning',
                    'status' => 'completed',
                    'doctor' => 'Dr. Carla Cruz',
                    'clinic' => 'Dental Suite, Room 5',
                    'notes' => 'Completed successfully.',
                ],
            ];

            // Badge colors for statuses.
            $badgeMap = [
                'pending' => 'warning',
                'confirmed' => 'success',
                'completed' => 'primary',
                'cancelled' => 'danger',
            ];

            // Pick the next confirmed appointment for countdown.
            $nextConfirmed = null;
            foreach ($appointments as $appt) {
                if (strtolower($appt['status']) === 'confirmed') {
                    $nextConfirmed = $appt;
                    break;
                }
            }
            ?>
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
                                    <?php if ($nextConfirmed): ?>
                                        <div class="text-muted small">Date: <?= esc($nextConfirmed['date']) ?></div>
                                        <div class="text-muted small mb-2">Doctor: <?= esc($nextConfirmed['doctor']) ?></div>
                                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                            <span class="badge bg-<?= $badgeMap[strtolower($nextConfirmed['status'])] ?? 'secondary' ?> text-uppercase"><?= esc(ucfirst($nextConfirmed['status'])) ?></span>
                                            <span class="small" id="countdown-label">Time remaining:</span>
                                            <span class="small fw-semibold" id="countdown-timer">--</span>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#appointmentModal" data-appt='<?= json_encode($nextConfirmed) ?>'>View details</button>
                                    <?php else: ?>
                                        <p class="text-muted small mb-2">No confirmed appointment yet.</p>
                                        <span class="badge bg-secondary">Pending</span>
                                    <?php endif; ?>
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
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle-small me-2" style="width:32px;height:32px;"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="fw-semibold mb-0 small"><?= esc($user['name'] ?? 'Guest') ?></div>
                                <div class="text-muted xsmall mb-1"><?= esc($user['email'] ?? '') ?></div>
                                <span class="badge bg-light text-dark text-uppercase xsmall">&nbsp;<?= esc($user['role'] ?? 'client') ?>&nbsp;</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted xsmall mb-1">
                            <span>Contact</span>
                            <span class="text-decoration-dotted">Add number</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted xsmall mb-3">
                            <span>Security</span>
                            <span class="text-decoration-dotted">Password not set</span>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary btn-sm" type="button" disabled>Edit profile</button>
                            <button class="btn btn-outline-secondary btn-sm" type="button" disabled>Change password</button>
                        </div>
                        <p class="text-muted xsmall mb-0 mt-2">Wire these actions when endpoints exist.</p>
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
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="bi bi-person-plus"></i> Add user
                            </button>
                            <span class="badge bg-warning text-dark">Admin</span>
                        </div>
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
                                    <?php foreach ($appointments as $appt): ?>
                                        <tr class="appt-row" role="button" data-bs-toggle="modal" data-bs-target="#appointmentModal" data-appt='<?= json_encode($appt) ?>'>
                                            <td class="text-nowrap"><?= esc($appt['date']) ?></td>
                                            <td><?= esc($appt['service']) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $badgeMap[strtolower($appt['status'])] ?? 'secondary' ?> text-uppercase"><?= esc(ucfirst($appt['status'])) ?></span>
                                            </td>
                                            <td class="text-end">
                                                <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#appointmentModal" data-appt='<?= json_encode($appt) ?>'>Details</button>
                                                <?php if (strtolower($appt['status']) === 'completed'): ?>
                                                    <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#feedbackModal" data-appt='<?= json_encode($appt) ?>'>Leave Feedback</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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

    <?php $addUserErrors = session('errors'); ?>
    <?php if (($user['role'] ?? '') === 'admin'): ?>
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="icon-circle"><i class="bi bi-person-plus"></i></span>
                            <h5 class="modal-title mb-0" id="addUserModalLabel">Add a user</h5>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <?php if ($addUserErrors): ?>
                        <div class="alert alert-danger py-2 small mb-3">
                            <ul class="mb-0 ps-3">
                                <?php foreach ($addUserErrors as $msg): ?>
                                    <li><?= esc($msg) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form id="addUserForm" action="<?= site_url('admin/users/create') ?>" method="post" novalidate>
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="add_name" class="form-label">Full name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="add_name" name="name" value="<?= old('name') ?>" placeholder="Juan Dela Cruz" required>
                            </div>
                            <div class="form-text text-danger small d-none" id="addNameRule">Only letters, spaces, and ñ are allowed.</div>
                        </div>

                        <div class="mb-3">
                            <label for="add_email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="add_email" name="email" value="<?= old('email') ?>" placeholder="you@example.com" required>
                            </div>
                            <div class="form-text text-danger small d-none" id="addEmailRule">Max 5 special characters and 8 numbers allowed.</div>
                        </div>

                        <div class="mb-3">
                            <label for="add_password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="add_password" name="password" placeholder="At least 6 characters" required>
                            </div>
                            <div class="form-text text-danger small d-none" id="addPasswordRule">Password must be at least 6 characters.</div>
                        </div>

                        <div class="mb-3">
                            <label for="add_role" class="form-label">Role</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <select class="form-select" id="add_role" name="role" required>
                                    <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="client" <?= old('role') === 'client' ? 'selected' : '' ?>>Client</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-accent text-white">Create user</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Appointment Details Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0" id="appointmentDetails">
                        <!-- Filled by JS -->
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Modal (UI only) -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Leave Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 small text-muted" id="feedbackApptLabel"></div>
                    <div class="d-flex gap-2 mb-3" id="starContainer">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <button type="button" class="btn btn-outline-warning btn-sm star-btn" data-value="<?= $i ?>">★</button>
                        <?php endfor; ?>
                    </div>
                    <div class="mb-3">
                        <label for="feedbackNotes" class="form-label">Notes (optional)</label>
                        <textarea id="feedbackNotes" class="form-control" rows="3" placeholder="Share your experience"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary w-100" id="submitFeedback">Submit</button>
                </div>
            </div>
        </div>
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
    .icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #14b8a6, #1e3a8a);
        color: #fff;
        box-shadow: 0 10px 20px rgba(20, 184, 166, 0.25);
    }
    .btn-accent {
        background: linear-gradient(135deg, #14b8a6, #1e3a8a);
        border: none;
        box-shadow: 0 10px 24px rgba(30, 58, 138, 0.2);
    }
    .btn-accent:hover { background: linear-gradient(135deg, #0fa08f, #172c66); }
    .input-group-text {
        background: #fff;
        border-right: 0;
        color: #9ca3af;
    }
    .input-group .form-control,
    .input-group .form-select {
        border-left: 0;
        padding-left: 0.5rem;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(20, 184, 166, 0.15);
        border-color: #14b8a6;
    }
    .xsmall { font-size: 0.78rem; }
    .star-btn.active { background-color: #f59e0b; color: #fff; border-color: #f59e0b; }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Countdown timer for next confirmed appointment (hardcoded date from PHP array)
    (function() {
        const nextConfirmed = <?= json_encode($nextConfirmed ?? null) ?>;
        const timerEl = document.getElementById('countdown-timer');
        const labelEl = document.getElementById('countdown-label');
        if (!nextConfirmed || !timerEl) return;

        const target = new Date(nextConfirmed.date);
        const tick = () => {
            const now = new Date();
            const diff = target - now;
            if (diff <= 0) {
                timerEl.textContent = 'Completed';
                labelEl.textContent = '';
                clearInterval(id);
                return;
            }
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            timerEl.textContent = `${days}d ${hours}h remaining`;
        };
        const id = setInterval(tick, 60 * 1000); // update every minute
        tick();
    })();

    // Populate appointment detail modal from data attributes
    (function() {
        const detailEls = document.querySelectorAll('[data-bs-target="#appointmentModal"]');
        const detailContainer = document.getElementById('appointmentDetails');
        if (!detailEls || !detailContainer) return;

        detailEls.forEach(btn => {
            btn.addEventListener('click', () => {
                const data = btn.getAttribute('data-appt');
                if (!data) return;
                const appt = JSON.parse(data);
                detailContainer.innerHTML = `
                    <dt class="col-4">Reference</dt><dd class="col-8">${appt.ref ?? ''}</dd>
                    <dt class="col-4">Doctor</dt><dd class="col-8">${appt.doctor ?? ''}</dd>
                    <dt class="col-4">Service</dt><dd class="col-8">${appt.service ?? ''}</dd>
                    <dt class="col-4">Date & Time</dt><dd class="col-8">${appt.date ?? ''}</dd>
                    <dt class="col-4">Clinic</dt><dd class="col-8">${appt.clinic ?? ''}</dd>
                    <dt class="col-4">Notes</dt><dd class="col-8">${appt.notes ?? ''}</dd>
                `;
            });
        });
    })();

    // Feedback modal: simple star toggle + alert demo
    (function() {
        const feedbackBtns = document.querySelectorAll('[data-bs-target="#feedbackModal"]');
        const starButtons = () => Array.from(document.querySelectorAll('.star-btn'));
        const submitBtn = document.getElementById('submitFeedback');
        const feedbackLabel = document.getElementById('feedbackApptLabel');
        let selected = 0;

        const setStars = (val) => {
            starButtons().forEach(btn => {
                const v = Number(btn.dataset.value);
                btn.classList.toggle('active', v <= val);
            });
            selected = val;
        };

        starButtons().forEach(btn => {
            btn.addEventListener('click', () => setStars(Number(btn.dataset.value)));
        });

        feedbackBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const data = btn.getAttribute('data-appt');
                const appt = data ? JSON.parse(data) : null;
                if (feedbackLabel && appt) {
                    feedbackLabel.textContent = `${appt.service ?? ''} with ${appt.doctor ?? ''}`;
                }
                setStars(0);
                document.getElementById('feedbackNotes').value = '';
            });
        });

        if (submitBtn) {
            submitBtn.addEventListener('click', () => {
                alert('Feedback submitted (demo only)');
            });
        }
    })();

    // Add-user modal validation (matches login/register rules)
    (function() {
        const form = document.getElementById('addUserForm');
        if (!form) return;

        const nameInput = document.getElementById('add_name');
        const nameRule = document.getElementById('addNameRule');
        const emailInput = document.getElementById('add_email');
        const emailRule = document.getElementById('addEmailRule');
        const passInput = document.getElementById('add_password');
        const passRule = document.getElementById('addPasswordRule');

        const show = (el) => el && el.classList.remove('d-none');
        const hide = (el) => el && el.classList.add('d-none');

        const validateName = () => {
            if (!nameInput) return true;
            const ok = /^[A-Za-zñÑ\s]+$/.test(nameInput.value || '');
            ok ? hide(nameRule) : show(nameRule);
            nameInput.classList.toggle('is-invalid', !ok);
            return ok;
        };

        const validateEmail = () => {
            if (!emailInput) return true;
            const val = emailInput.value || '';
            const specials = (val.match(/[^a-zA-Z0-9]/g) || []).length;
            const digits = (val.match(/\d/g) || []).length;
            const ok = specials <= 5 && digits <= 8;
            ok ? hide(emailRule) : show(emailRule);
            emailInput.classList.toggle('is-invalid', !ok);
            return ok;
        };

        const validatePass = () => {
            if (!passInput) return true;
            const ok = (passInput.value || '').length >= 6;
            ok ? hide(passRule) : show(passRule);
            passInput.classList.toggle('is-invalid', !ok);
            return ok;
        };

        [nameInput, emailInput, passInput].forEach(el => el && el.addEventListener('input', () => {
            validateName();
            validateEmail();
            validatePass();
        }));

        form.addEventListener('submit', (e) => {
            const ok = validateName() & validateEmail() & validatePass();
            if (!ok) e.preventDefault();
        });
    })();

    // Auto-open add-user modal when validation errors are present
    (function() {
        const shouldOpen = <?= (($user['role'] ?? '') === 'admin' && ($addUserErrors || old('name') || old('email') || old('role'))) ? 'true' : 'false' ?>;
        if (!shouldOpen) return;
        const modalEl = document.getElementById('addUserModal');
        if (modalEl && window.bootstrap) {
            window.bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }
    })();
</script>
</body>
</html>
