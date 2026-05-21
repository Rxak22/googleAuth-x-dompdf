<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: auth/singin.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            background: #1f4e79;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .navbar .brand {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }
        .navbar .nav-links {
            display: flex;
            gap: 18px;
        }
        .navbar .nav-links a {
            color: #f3f9ff;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }
        .navbar .nav-links a:hover {
            color: #cfe8ff;
        }
        .hero {
            max-width: 960px;
            margin: 36px auto;
            padding: 32px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(24, 45, 72, 0.08);
        }
        .hero h1 {
            margin: 0 0 14px;
            font-size: 2.3rem;
            color: #1e3d65;
        }
        .hero p {
            margin: 0;
            line-height: 1.75;
            color: #4f5d72;
            font-size: 1.05rem;
        }
        .hero .welcome-card {
            margin-top: 26px;
            padding: 22px;
            border-radius: 14px;
            background: #eef6ff;
            border: 1px solid #d7e6fb;
        }
        .hero .welcome-card p {
            margin: 0 0 10px;
        }
        .hero .button-group {
            margin-top: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .button-group a {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 999px;
            text-decoration: none;
            color: #fff;
            background: #2962ff;
            transition: background 0.2s ease;
        }
        .button-group a.secondary {
            background: #4a90e2;
        }
        .button-group a:hover {
            background: #154ecb;
        }
        @media (max-width: 720px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .navbar .nav-links {
                flex-wrap: wrap;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="brand">My App</div>
        <nav class="nav-links">
            <a href="auth/logout.php">Logout</a>
        </nav>
    </header>

    <main class="hero">
        <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user']['name'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
        <p>You've successfully signed in. have a nice day today!</p>

        <div class="welcome-card">
            <p><strong>Signed in as:</strong> <?php echo htmlspecialchars($_SESSION['user']['email'] ?? 'Unknown email', ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Need a PDF version of your information? Click the button below to generate it instantly.</p>
        </div>

        <div class="button-group">
            <a download="" href="auth/credentials.pdf">Save your Credential</a>
        </div>
    </main>
</body>
</html>