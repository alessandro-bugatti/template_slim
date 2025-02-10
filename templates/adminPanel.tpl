<?php
/** @var $base_path
 * @var $prodotti
 */
?>
<?php $this->layout('home', ['title' => 'Negozio']) ?>

    <h1>Pannello di amministrazione</h1>
    <p>
        <a href="<?=$base_path?>/admin/prodotto" class="btn btn-primary">Aggiungi un nuovo prodotto</a>
    </p>
    <h2>Lista dei prodotti</h2>
    <ul>
    <?php foreach ($prodotti as $prodotto): ?>
        <li><?=$prodotto['nome']?>: <i><?=$prodotto['descrizione']?></i></li>
    <?php endforeach;?>
    </ul>
