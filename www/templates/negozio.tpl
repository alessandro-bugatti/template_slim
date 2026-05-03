<?php
/** @var $genere
 * @var $prodotti
 */
?>
<?php $this->layout('home', ['title' => 'Negozio']) ?>

<article>
    <header>
        <h1>Esempio negozio con pattern MVC</h1>
        <h2>Lista dei prodotti: <?=$genere?></h2>
    </header>

    <ul>
        <?php foreach ($prodotti as $prodotto): ?>
            <li>
                <a href="/negozio/prodotto/<?=$prodotto['id']?>"><?=$prodotto['nome']?></a>
                <small><?=$prodotto['descrizione']?></small>
            </li>
        <?php endforeach;?>
    </ul>
</article>
