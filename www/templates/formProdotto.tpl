<?php
/** @var $prodotto
 * @var $upload_max_file_size
 */
?>
<?php $this->layout('home', ['title' => 'Gestione prodotto']) ?>

<article>
    <header>
        <h1>Pannello di amministrazione</h1>
        <h2><?=isset($prodotto['id']) ? 'Modifica prodotto' : 'Nuovo prodotto'?></h2>
    </header>

    <form enctype="multipart/form-data" action="/admin/prodotto<?=isset($prodotto['id']) ? '/'.$prodotto['id'] : ''?>" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?=$upload_max_file_size?>">

        <label for="nome">
            Nome
            <input type="text" id="nome" placeholder="Nome" name="nome" required value="<?=$prodotto['nome'] ?? ''?>">
        </label>

        <label for="descrizione">
            Descrizione
            <input type="text" id="descrizione" placeholder="Descrizione" name="descrizione" required value="<?=$prodotto['descrizione'] ?? ''?>">
        </label>

        <label for="prezzo">
            Prezzo
            <input type="number" step="0.01" id="prezzo" placeholder="Prezzo" name="prezzo" required value="<?=$prodotto['prezzo'] ?? ''?>">
        </label>

        <label for="genere">
            Genere
            <select id="genere" name="genere">
                <?php if (!isset($prodotto['genere'])):?>
                    <option>Donna</option>
                    <option>Uomo</option>
                <?php else: ?>
                    <option <?=($prodotto['genere'] == 'Donna') ? 'selected' : ''?>>Donna</option>
                    <option <?=($prodotto['genere'] == 'Uomo') ? 'selected' : ''?>>Uomo</option>
                <?php endif; ?>
            </select>
        </label>

        <label for="immagine">
            Immagine
            <input type="file" id="immagine" name="immagine">
        </label>

        <button type="submit">Invia</button>
    </form>
</article>
