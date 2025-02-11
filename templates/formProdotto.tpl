<?php
/** @var $base_path
 * @var $prodotti
 */
?>
<?php $this->layout('home', ['title' => 'Negozio']) ?>

    <h1>Pannello di amministrazione</h1>
    <h2>Nuovo prodotto</h2>
<form class="form-horizontal" action="<?=$base_path?>/admin/prodotto" method="post">
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="nome">Nome</label>
        </div>
        <div class="col-9 col-sm-12">
            <input class="form-input" type="text" id="nome" placeholder="Nome" name ="nome" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="descrizione">Descrizione</label>
        </div>
        <div class="col-9 col-sm-12">
            <input class="form-input" type="text" id="descrizione" placeholder="Descrizione" name="descrizione" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="prezzo">Prezzo</label>
        </div>
        <div class="col-9 col-sm-12">
            <input class="form-input" type="number" step="0.01" id="prezzo" placeholder="Prezzo" name="prezzo" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-3 col-sm-12">
            <label class="form-label" for="genere">Genere</label>
        </div>
        <div class="col-9 col-sm-12">
        <select class="form-select" name="genere">
            <option>Donna</option>
            <option>Uomo</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-2 col-ml-auto">
        <button class="btn btn-primary" style="width:100%" type="submit">Invia</button>
        </div>
    </div>
</form>
