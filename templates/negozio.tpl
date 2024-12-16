<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esempio negozio con pattern MVC</title>
</head>
<body>
    <h1>Esempio negozio con pattern MVC</h1>
    <p><a href="<?=$base_path?>/negozio/genere/All">Tutti i capi</a></p>
    <p><a href="<?=$base_path?>/negozio/genere/Donna">Abbigliamento femminile</a></p>
    <p><a href="<?=$base_path?>/negozio/genere/Uomo">Abbigliamento maschile</a></p>
    <h2>Lista dei prodotti: <?=$genere?></h2>
    <ul>
    <?php foreach ($prodotti as $prodotto): ?>
        <li><?=$prodotto['nome']?>: <i><?=$prodotto['descrizione']?></i></li>
    <?php endforeach;?>
    </ul>
</body>
</html>