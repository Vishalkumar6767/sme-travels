<header id="header" class="header fixed-top d-flex align-items-center bg-light">
    <div class="d-flex align-items-center justify-content-between w-100">
        <!-- Logo -->
        <a href="index" class="logo d-flex align-items-center">
            <img src="{{ asset('collection/img/logo/logo.png') }}" alt="Logo" style="width: 30%;">
        </a>
        
        <!-- Sidebar Toggle Button -->
        <i class="bi bi-list toggle-sidebar-btn"></i>

        <!-- Navigation Menu -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center" style="list-style: none">

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('collection/img/logo/logo.png') }}" alt="Profile" width="10%" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #1641a3;">Dorrela Service <pvt class="ltd"></pvt></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="bi bi-key"></i><span>Change Password</span></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a href="#" class="dropdown-item d-flex align-items-center" id="logoutBTN">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="changePasswordBtn">Change Password</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Logout functionality
    const logoutBtn = document.getElementById('logoutBTN');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(event) {
            event.preventDefault();
            console.log('Logout button clicked');
            
            const token = localStorage.getItem('api_token');
            
            if (!token) {
                console.error('No API token found');
                redirectToLogin();
                return;
            }
            
            fetch('/api/v1/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Logout response:', response);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Logout successful:', data);
                localStorage.removeItem('api_token');
                redirectToLogin();
            })
            .catch(error => {
                console.error('Logout error:', error);
                alert('Error during logout: ' + error.message);
            });
        });
    } else {
        console.error('Logout button not found');
    }

    // Change Password functionality
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    if (changePasswordBtn) {
        changePasswordBtn.addEventListener('click', function(event) {
            event.preventDefault();
            
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword !== confirmPassword) {
                alert('New password and confirm password do not match');
                return;
            }
            
            const token = localStorage.getItem('api_token');
            
            fetch('/api/v1/change-password', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    old_password: currentPassword,
                    password: newPassword,
                    confirm_password: confirmPassword
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`Network response was not ok: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                alert('Password changed successfully');
                $('#changePasswordModal').modal('hide');
                document.getElementById('changePasswordForm').reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            });
        });
    } else {
        console.error('Change Password button not found');
    }

    function redirectToLogin() {
        window.location.href = "/login";
    }

    // Update the sidebar toggle functionality
    const sidebarToggleBtn = document.querySelector('.toggle-sidebar-btn');
    const sidebar = document.querySelector('#sidebar');
    const body = document.body;

    let clickCount = 0;
    let clickTimer;

    if (sidebarToggleBtn && sidebar) {
        sidebarToggleBtn.addEventListener('click', function() {
            clickCount++;
            if (clickCount === 1) {
                clickTimer = setTimeout(() => {
                    // Single click
                    sidebar.classList.toggle('hidden-sidebar');
                    body.classList.toggle('toggle-sidebar');
                    clickCount = 0;
                }, 300);
            } else if (clickCount === 2) {
                // Double click
                clearTimeout(clickTimer);
                sidebar.classList.add('hidden-sidebar');
                body.classList.add('toggle-sidebar');
                clickCount = 0;
            }
        });
    }

    // Function to check and adjust sidebar visibility based on screen size
    function checkSidebarVisibility() {
        if (window.innerWidth < 992) {
            sidebar.classList.add('hidden-sidebar');
            body.classList.add('toggle-sidebar');
        } else {
            sidebar.classList.remove('hidden-sidebar');
            body.classList.remove('toggle-sidebar');
        }
    }

    // Check sidebar visibility on page load and window resize
    window.addEventListener('load', checkSidebarVisibility);
    window.addEventListener('resize', checkSidebarVisibility);

    // Add double-click functionality to the sidebar itself
    if (sidebar) {
        sidebar.addEventListener('dblclick', function(e) {
            // Prevent double-click from affecting child elements
            if (e.target === sidebar) {
                sidebar.classList.add('hidden-sidebar');
                body.classList.add('toggle-sidebar');
            }
        });
    }
});
</script>
@endpush