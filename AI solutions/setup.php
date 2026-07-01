<?php
// setup.php
// Setup script to initialize MySQL database and import schema

$host = 'localhost';
$user = 'root';
$pass = '';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - AI-Solutions</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0B0C10;
            color: #E2E8F0;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .container {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        h1 {
            color: #6C5CE7;
            margin-top: 0;
            border-bottom: 2px solid rgba(108, 92, 231, 0.3);
            padding-bottom: 10px;
        }
        .status-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #94A3B8;
        }
        .success {
            border-left-color: #00CEC9;
        }
        .error {
            border-left-color: #D63031;
            color: #FF7675;
        }
        .info {
            border-left-color: #6C5CE7;
        }
        ul {
            padding-left: 20px;
            margin: 10px 0 0 0;
        }
        li {
            margin-bottom: 5px;
        }
        a.btn {
            display: inline-block;
            background: linear-gradient(135deg, #6C5CE7, #a29bfe);
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
        }
        a.btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>AI-Solutions System Setup</h1>
    <?php
    try {
        // Connect to MySQL server (without specifying DB first)
        $pdo = new PDO("mysql:host=$host", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<div class='status-box success'>Connected to MySQL server successfully.</div>";

        // Create Database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `ai_solutions` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "<div class='status-box success'>Database `ai_solutions` verified/created.</div>";

        // Connect to the specific database
        $pdo->exec("USE `ai_solutions`");

        // Read SQL file
        $sqlFile = __DIR__ . '/database.sql';
        if (!file_exists($sqlFile)) {
            throw new Exception("SQL schema file database.sql not found at $sqlFile");
        }

        $sql = file_get_contents($sqlFile);
        
        // Execute SQL script
        // Note: exec() runs multiple statements if queries are semi-colon separated, but PDO exec can sometimes fail or block on multiple queries depending on driver settings.
        // Let's split statements by semicolon and run them one by one.
        // A simple split by semicolon will work, ignoring semicolons inside quotes (our seeds are simple and don't contain semicolons inside quotes).
        $queries = explode(';', $sql);
        $count = 0;
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $pdo->exec($query);
                $count++;
            }
        }
        echo "<div class='status-box success'>Imported schema and seeded data successfully ($count statements executed).</div>";

        // Create uploads directory
        $uploadsDir = __DIR__ . '/uploads';
        if (!file_exists($uploadsDir)) {
            if (mkdir($uploadsDir, 0777, true)) {
                echo "<div class='status-box success'>Created upload directory at <code>/uploads</code>.</div>";
            } else {
                echo "<div class='status-box error'>Failed to create upload directory at <code>/uploads</code>. Please create it manually.</div>";
            }
        } else {
            echo "<div class='status-box info'>Upload directory already exists.</div>";
        }

        // Create default static assets/images directory if it doesn't exist
        $imagesDirs = [
            __DIR__ . '/assets',
            __DIR__ . '/assets/css',
            __DIR__ . '/assets/js',
            __DIR__ . '/assets/images',
        ];
        foreach ($imagesDirs as $dir) {
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
        }
        echo "<div class='status-box success'>Verified assets folder hierarchy.</div>";

        echo "<div class='status-box info'>
                <strong>Setup Complete!</strong><br>
                You can now access:
                <ul>
                    <li><a href='index.php' style='color:#00CEC9;'>Home Page (index.php)</a></li>
                    <li><a href='admin_login.php' style='color:#00CEC9;'>Admin Login (admin_login.php)</a></li>
                </ul>
              </div>";
        echo "<a href='index.php' class='btn'>Launch Website</a>";

    } catch (Exception $e) {
        echo "<div class='status-box error'>
                <strong>Error during setup:</strong><br>
                " . htmlspecialchars($e->getMessage()) . "
              </div>";
        echo "<p>Please ensure MySQL is running on port 3306 on localhost, and your credentials are correct in setup.php.</p>";
    }
    ?>
</div>
</body>
</html>
