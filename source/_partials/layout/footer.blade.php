<footer class="footer">
    <div class="content has-text-centered">
        <div class="level is-small">
            <div class="level-item">
                <a href="https://php.net" target="_blank">
                    <figure class="image is-128x128">
                        <img src="{{ $page->asset_prefix }}/assets/images/sponsors/php.png" title="PHP.net">
                    </figure>
                </a>
            </div>
        </div>

        @include('_partials.layout.sponsors')

        <hr>
        <p>O site <strong>PHPSP.org.br</strong> foi criado pela <a href="{{ $page->source_code }}graphs/contributors" target="_blank" title="Colaboradores do Site PHPSP.org">Comunidade PHPSP</a>.</p>
        <p>O código deste site esta sob a licença <a href="http://opensource.org/licenses/mit-license.php" target="_blank" title="Licença MIT">MIT</a> e pode ser encontrado <a href="{{ $page->source_code }}" target="_blank" title="Código Fonte do Site PHPSP.org.br">aqui</a>.</p>
        <p>O conteúdo deste site esta sob a licença <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" title="Licença CC BY NC SA 4.0">CC BY NC SA 4.0</a>.</p>
    </div>
</footer>