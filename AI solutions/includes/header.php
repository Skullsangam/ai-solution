<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI-Solutions - Innovating the Digital Employee Experience</title>
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Icon Font (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Background glow bubbles for glassmorphism layout -->
    <div class="bg-glow glow-primary"></div>
    <div class="bg-glow glow-accent"></div>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <i class="fa-solid fa-brain"></i>
                </div>
                <div class="logo-text">AI-<span>Solutions</span></div>
            </a>
            
            <ul class="nav-links">
                <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">About Us</a></li>
                <li><a href="solutions.php" class="<?php echo $current_page == 'solutions.php' ? 'active' : ''; ?>">Solutions</a></li>
                <li><a href="feedback.php" class="<?php echo $current_page == 'feedback.php' ? 'active' : ''; ?>">Reviews</a></li>
                <li><a href="articles.php" class="<?php echo $current_page == 'articles.php' || $current_page == 'article_detail.php' ? 'active' : ''; ?>">Articles</a></li>
                <li><a href="gallery.php" class="<?php echo $current_page == 'gallery.php' ? 'active' : ''; ?>">Gallery &amp; Events</a></li>
                <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Contact Us</a></li>
                <?php if ($is_admin): ?>
                    <li><a href="admin_dashboard.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-gauge" style="margin-right: 6px;"></i>Dashboard</a></li>
                    <li><a href="admin_login.php?action=logout" style="color: #FF7675;"><i class="fa-solid fa-sign-out-alt"></i></a></li>
                <?php else: ?>
                    <li><a href="admin_login.php" class="btn btn-sm btn-outline"><i class="fa-solid fa-lock" style="margin-right: 6px;"></i>Admin</a></li>
                <?php endif; ?>
            </ul>
            
            <div class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>
