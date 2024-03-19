<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css\estilopadrao.css">
    <link rel="icon" href="img\icon.png">
    <title>Sistema de controle de contatos</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        body, html {
            height: 100%;
        }
        main {
            display: flex;
            flex-wrap: nowrap;
            height: 100%;
            overflow-x: auto;
            overflow-y: hidden;
        }
        .b-example-divider {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100%;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }
        .bi {
            vertical-align: -.125em;
            pointer-events: none;
            fill: currentColor;
        }
        .dropdown-toggle { outline: 0; }
        .nav-flush .nav-link {
            border-radius: 0;
        }
        .btn-toggle {
            display: inline-flex;
            align-items: center;
            padding: .25rem .5rem;
            font-weight: 600;
            color: rgba(0, 0, 0, .65);
            background-color: transparent;
            border: 0;
        }
        .btn-toggle:hover,
        .btn-toggle:focus {
            color: rgba(0, 0, 0, .85);
            background-color: #d2f4ea;
        }
        .btn-toggle::before {
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: .5em 50%;
        }
        .btn-toggle[aria-expanded="true"] {
            color: rgba(0, 0, 0, .85);
        }
        .btn-toggle[aria-expanded="true"]::before {
            transform: rotate(90deg);
        }
        .btn-toggle-nav a {
            display: inline-flex;
            padding: .1875rem .5rem;
            margin-top: .125rem;
            margin-left: 1.25rem;
            text-decoration: none;
        }
        .btn-toggle-nav a:hover,
        .btn-toggle-nav a:focus {
            background-color: #d2f4ea;
        }
        .scrollarea {
            overflow-y: auto;
        }
        .fw-semibold { font-weight: 600; }
        .lh-tight { line-height: 1.25; }

        /* Adjusted styles for the sidebar */
        .sidebar {
            height: 100%;
            width: 4.5rem;
        }

        /* Custom styles for the tooltip */
        .tooltip-inner {
            background-color: #000;
            color: #fff;
            border-radius: 8px;
            padding: 8px;
        }
        .tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before, .tooltip.bs-tooltip-top .arrow::before {
            border-top-color: #000;
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column flex-shrink-0 bg-light">
    <a href="/" class="d-block p-3 link-dark text-decoration-none" title="Icon-only" data-bs-toggle="tooltip" data-bs-placement="right">
        <svg class="bi" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="visually-hidden">Icon-only</span>
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <a href="#" class="nav-link active py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Home"><use xlink:href="#home"/></svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Dashboard"><use xlink:href="#speedometer2"/></svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Orders" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Orders"><use xlink:href="#table"/></svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Products" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Products"><use xlink:href="#grid"/></svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom" title="Customers" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi" width="24" height="24" role="img" aria-label="Customers"><use xlink:href="#people-circle"/></svg>
            </a>
        </li>
    </ul>
    <div class="dropdown border-top">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

</body>
</html>
