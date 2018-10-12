<?php
$contributeLink = $page->source_code . 'blob/' . $page->contribute_branch . '/source/' . $page->contribute_prefix . $page->getFilename() . '.' . $page->getExtension();
?>
<div class="container has-text-centered">
    <div class="notification">
        Acha que esse conteúdo possui erros ou poderia ser aperfeiçoado?
        <a href="{{ $contributeLink }}" title="Ajuste esse conteúdo!" target="_blank">Colabore!</a>
    </div>
</div>