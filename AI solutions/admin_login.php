<?php
// admin_login.php
// Secure administrator authentication portal

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = [];
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Standard credential verification as requested
    if ($email === 'skullsangam@gmail.com' && $password === 'Admin@321') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid administrator email or password.";
    }
}

include 'includes/header.php';
?>

<div class="admin-login-container">
    <div class="admin-login-card glass-panel">
        <div class="admin-login-header">
            <h2>Admin Portal</h2>
            <p style="color: var(--text-muted);">Access AI-Solutions Inquiry Metrics</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="alert-banner alert-danger" style="margin-bottom: 20px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div><?php echo htmlspecialchars($error); ?></div>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="admin_login.php">
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="email">Admin Email Address</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="skullsangam@gmail.com" required>
            </div>
            
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="password">Security Password</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Authenticate Session</button>
        </form>
    </div>
</div>

<!-- Footer inclusion -->
<?php include 'includes/footer.php'; ?>
