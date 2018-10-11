<nav id="navbar" class="navbar has-shadow is-spaced is-fixed-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="{{ $page->asset_prefix }}/assets/images/phpsp/phpsp.png" alt="PHPSP">
            </a>

            <a class="navbar-item is-hidden-desktop" href="https://github.com/phpsp" target="_blank">
                <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/GitHub-Mark-120px-plus.png" title="GitHub">
            </a>

            <a class="navbar-item is-hidden-desktop" href="https://twitter.com/phpsp" target="_blank">
                <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/Twitter_Social_Icon_Circle_Color.png" title="Twitter">
            </a>

            <a class="navbar-item is-hidden-desktop" href="https://bit.ly/vemproslackphpsp" target="_blank">
                <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/SlackAppIcon.png" title="Slack">
            </a>

            <div id="navbarBurger" class="navbar-burger burger" data-target="navMenuComunidade"  onclick="document.querySelector('.navbar-menu').classList.toggle('is-active'); document.querySelector('.navbar-burger').classList.toggle('is-active');">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navMenuComunidade" class="navbar-menu">
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <span class="navbar-link">A Comunidade</span>
                    <div id="moreDropdown" class="navbar-dropdown">
                        <a class="navbar-item " href="/a-comunidade">
                          <span>
                            <strong>A Comunidade PHPSP</strong>
                            <br>
                            O que é a Comunidade PHPSP
                          </span>
                        </a>

                        <a class="navbar-item " href="/quem-e-a-comunidade">
                          <span>
                            <strong>Quem é a Comunidade PHPSP</strong>
                            <br>
                            Quem é a Comunidade PHPSP
                          </span>
                        </a>

                        <hr class="navbar-divider">

                        <a class="navbar-item " href="/codigo-de-conduta">
                          <span>
                            <strong>Código de Conduta</strong>
                            <br>
                            Codigo de conduta para a comunidade
                          </span>
                        </a>

                    </div>
                </div>

                <a class="navbar-item" href="/artigos">
                    <span>Artigos</span>
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <span class="navbar-link">Eventos</span>
                    <div id="moreDropdown" class="navbar-dropdown">
                        <a class="navbar-item" href="https://www.meetup.com/php-sp/events/" target="_blank">
                          <span>
                            <strong>PHPSP</strong>
                            <br>
                            Eventos na cidade de SP
                          </span>
                        </a>

                        <a class="navbar-item" href="https://www.meetup.com/PHPSP-Campinas/events" target="_blank">
                          <span>
                            <strong>PHPSP Campinas</strong>
                            <br>
                            Eventos na cidade de Campinas
                          </span>
                        </a>

                        <hr class="navbar-divider">

                        <a class="navbar-item " href="/codigo-de-conduta-para-eventos">
                          <span>
                            <strong>Código de Conduta para Eventos</strong>
                            <br>
                            Codigo de conduta para a eventos da comunidade
                          </span>
                        </a>

                    </div>
                </div>

                <a class="navbar-item" href="/como-contribuir">
                    <span>Como contribuir</span>
                </a>

            </div>

            <div class="navbar-end">
                <a class="navbar-item is-hidden-touch is-hidden-desktop-only" href="https://github.com/phpsp" target="_blank">
                    <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/GitHub-Mark-120px-plus.png" title="GitHub">
                </a>

                <a class="navbar-item is-hidden-touch is-hidden-desktop-only" href="https://twitter.com/phpsp" target="_blank">
                    <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/Twitter_Social_Icon_Circle_Color.png" title="Twitter">
                </a>

                <a class="navbar-item is-hidden-touch is-hidden-desktop-only" href="https://bit.ly/vemproslackphpsp" target="_blank">
                    <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/SlackAppIcon.png" title="Slack">
                </a>

                <a class="navbar-item is-hidden-touch is-hidden-desktop-only" href="https://www.linkedin.com/groups/PHPSP-Grupo-Desenvolvedores-PHP-S%C3%A3o-1808119" target="_blank">
                    <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/In-2C-128px-TM.png" title="LinkedIn">
                </a>

                <a class="navbar-item is-hidden-touch is-hidden-desktop-only" href="https://facebook.com/sao.paulo.elephants" target="_blank">
                    <img src="{{ $page->asset_prefix }}/assets/images/thirdparty/flogo_RGB_HEX-144.png" title="Facebook">
                </a>

            </div>
        </div>
    </div>
</nav>