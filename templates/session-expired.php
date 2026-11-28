<?php

$title = Config::lang('session_expired_title') ?: 'Session expired';
$message = Config::lang('session_expired_message') ?: 'The page token is no longer valid. Please return and try again.';
$button = Config::lang('session_expired_button') ?: 'Continue';
$prefix = basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'users' ? '../' : '';
$themeCss = Config::read_string('theme_css');
$customCss = Config::read_string('theme_custom_css');
$favicon = Config::read_string('theme_favicon');
$logo = Config::read_string('theme_logo') ?: 'images/postbox.png';
?>
<!doctype html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'en') ?>" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?> - Postfix Admin</title>
    <script>
        try {
            if (localStorage.getItem('bsTheme') === 'light') {
                document.documentElement.dataset.bsTheme = 'light';
            }
        } catch {
            // Keep the default theme when browser storage is unavailable.
        }
    </script>
    <?php if ($favicon !== '') { ?>
        <link rel="shortcut icon" href="<?= htmlspecialchars($prefix . $favicon) ?>">
    <?php } ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($prefix . $themeCss) ?>">
    <?php if ($customCss !== '') { ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($prefix . $customCss) ?>">
    <?php } ?>
</head>
<body class="page-session-expired">
    <header class="navbar navbar-expand-xl bg-body-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="main.php">
                <img id="login_header_logo" src="<?= htmlspecialchars($prefix . $logo) ?>" alt="Postfix Admin">
            </a>
        </div>
    </header>
    <main class="container-xl mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h4 mb-0">
                            <span class="bi bi-exclamation-triangle text-warning me-2" aria-hidden="true"></span><?= htmlspecialchars($title) ?>
                        </h1>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><?= htmlspecialchars($message) ?></p>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-primary" href="main.php"><?= htmlspecialchars($button) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
