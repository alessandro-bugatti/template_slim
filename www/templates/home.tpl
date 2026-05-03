<?php
/**  @var $title
 *   @var $user
 */ ?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
    <title><?=$this->e($title ?? 'Negozio')?></title>
    <style>
        body > header,
        body > main {
            max-width: 960px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        nav ul:last-child li,
        table td:last-child,
        table td:nth-last-child(2),
        table th:last-child,
        table th:nth-last-child(2) {
            white-space: nowrap;
        }

        article img {
            width: 100%;
            height: auto;
        }

        form button[type="submit"],
        form input[type="submit"] {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><strong>Negozio</strong></li>
        </ul>
        <ul>
            <li><a href="/negozio">Tutti i capi</a></li>
            <li><a href="/negozio/genere/Uomo">Uomo</a></li>
            <li><a href="/negozio/genere/Donna">Donna</a></li>
            <?php if ($user !== null):?>
                <li><a href="/logout">Logout</a></li>
            <?php else:?>
                <li><a href="/login">Login</a></li>
            <?php endif;?>
            <li><a href="/admin">Amministrazione</a></li>
        </ul>
    </nav>
</header>
<main>
    <?=$this->section('content')?>
</main>
</body>
</html>
