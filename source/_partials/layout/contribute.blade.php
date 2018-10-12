<?php
$contributeLink = 'https://github.com/herdphp/phpsp.org.br/blob/develop/source/' . $page->contribute_prefix . $page->getFilename() . '.' . $page->getExtension();
?>
<div class="container has-text-centered">
    <div class="notification">
        Acha que esse conteúdo possui erros ou poderia ser aperfeiçoado?
        <a href="{{ $contributeLink }}" title="Ajuste esse conteúdo!" target="_blank">Colabore!</a>
    </div>
</div>