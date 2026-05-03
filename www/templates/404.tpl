<?php
/** @var $error
 * @var $assets_base_url
 */
?>
<?php $this->layout('home', ['title' => 'Pagina non trovata']) ?>

<article>
    <header>
        <h1>Oops, qualcosa è andato storto :-/</h1>
        <p>La pagina richiesta non è disponibile.</p>
    </header>

    <p>
        <img src="<?=$assets_base_url?>/404.png" alt="Illustrazione di errore 404">
    </p>
</article>
<!--<p>Errore: <?=$error?></p>-->

