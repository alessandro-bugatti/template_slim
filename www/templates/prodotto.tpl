<?php
/** @var $prodotto */
?>
<?php $this->layout('home', ['title' => $prodotto['nome'] ?? 'Negozio']) ?>

<article>
    <header>
        <h1>Esempio negozio con pattern MVC</h1>
        <h2><?=$prodotto['nome']?></h2>
        <p><strong>Prezzo:</strong> <?=$prodotto['prezzo']?> €</p>
    </header>

    <p>
        <img src="/images/<?=$prodotto['image']?>" alt="<?=$prodotto['nome']?>">
    </p>

    <p><?=$prodotto['descrizione']?></p>

    <footer>
        <a href="/negozio">Torna al negozio</a>
    </footer>
</article>
