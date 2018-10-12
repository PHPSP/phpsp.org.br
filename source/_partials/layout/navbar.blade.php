<nav id="navbar" class="navbar has-shadow is-spaced is-fixed-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="{{ $page->asset_prefix }}/assets/images/phpsp/phpsp.png" title="PHPSP" alt="PHPSP">
            </a>

            @foreach( $page->links_header['mobile'] as $link)
                <a class="navbar-item is-hidden-desktop" href="{{ $page->links[$link]['url'] }}" target="_blank">
                    <img src="{{ $page->asset_prefix }}{{ $page->links[$link]['img'] }}"
                         title="{{ $page->links[$link]['title'] }}" alt="{{ $page->links[$link]['title'] }}">
                </a>
            @endforeach

            <div id="navbarBurger" class="navbar-burger burger" data-target="navMenuComunidade"
                 onclick="document.querySelector('.navbar-menu').classList.toggle('is-active'); document.querySelector('.navbar-burger').classList.toggle('is-active');">
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
                            <strong>PHPSP São Paulo</strong>
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

                {{--<a class="navbar-item" href="/como-contribuir">--}}
                    {{--<span>Como contribuir</span>--}}
                {{--</a>--}}

                <div class="navbar-item has-dropdown is-hoverable">
                    <span class="navbar-link">Como Contribuir</span>
                    <div id="moreDropdown" class="navbar-dropdown">
                        <a class="navbar-item" href="/como-contribuir">
                            <span>
                                <strong>Como contribuir?</strong>
                                <br>
                                Que contribuir com a comunidade PHP e não sabe como? Saiba mais!
                              </span>
                        </a>

                        <hr class="navbar-divider">

                        <p class="navbar-item"><strong>Projetos apoiados pelo PHPSP:</strong></p>

                        @foreach ($page->projects as $project)
                            <a class="navbar-item is-white-space-normal" href="{{ $project->url }}" target="_blank">
                              <span>
                                <strong>{{ $project->title }}</strong>
                                <br>
                                {{ $project->description }}
                              </span>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="navbar-end">
                @foreach( $page->links_header['desktop'] as $link)
                    <a class="navbar-item is-hidden-touch is-hidden-desktop-only"
                       href="{{ $page->links[$link]['url'] }}" target="_blank">
                        <img src="{{ $page->asset_prefix }}{{ $page->links[$link]['img'] }}"
                             title="{{ $page->links[$link]['title'] }}" alt="{{ $page->links[$link]['title'] }}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>