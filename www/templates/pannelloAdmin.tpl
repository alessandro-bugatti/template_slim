<?php
/** @var $prodotti */
?>
<?php $this->layout('home', ['title' => 'Negozio']) ?>

<article>
    <header>
        <h1>Pannello di amministrazione</h1>
        <p><a href="/admin/prodotto" role="button">Aggiungi un nuovo prodotto</a></p>
    </header>

    <h2>Lista dei prodotti</h2>

    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Modifica</th>
            <th>Elimina</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($prodotti as $prodotto):?>
            <tr>
                <td><?=$prodotto['nome']?></td>
                <td><?=$prodotto['descrizione']?></td>
                <td><?=$prodotto['prezzo']?></td>
                <td><a href="/admin/prodotto/<?=$prodotto['id']?>" title="Modifica prodotto" aria-label="Modifica prodotto">✏️</a></td>
                <td><a href="/admin/prodotto/<?=$prodotto['id']?>/delete" title="Elimina prodotto" aria-label="Elimina prodotto">🗑️</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</article>
