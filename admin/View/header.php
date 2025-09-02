<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Админ-панель</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/dashboard.css" rel="stylesheet">

    <!-- simplelineicons for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <!-- Redactor CSS -->
    <link rel="stylesheet" href="/assets/js/plugins/redactor/redactor.css">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Admin CMS</a>

            <!-- Burger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="icon-speedometer icons"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/pages">
                            <i class="icon-doc icons"></i> Pages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/posts">
                            <i class="icon-pencil icons"></i> Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/settings/general">
                            <i class="icon-equalizer icons"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Right toolbar -->
            <div class="right-toolbar">
                <a href="/admin/logout">
                    <i class="icon-logout icons"></i> Logout
                </a>
            </div>
        </div>
    </nav>
</header>
