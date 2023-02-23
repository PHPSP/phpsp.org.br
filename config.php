<?php

use TightenCo\Jigsaw\PageVariable;

return [
    'language' => 'pt-BR',
    'baseUrl' => 'http://localhost:3000/',
    'meetup' => [
        'baseUrl' => 'https://yp3o7jx9t2.execute-api.sa-east-1.amazonaws.com/dev/',
    ],
    'production' => false,
    'contribute_branch' => 'develop',
    'google_analytics' => [
        'id' => 'local',
    ],
    'title' => 'Grupo de desenvolvedores de PHP do estado de São Paulo',
    'contribute_prefix' => '',
    'source_code' => 'https://github.com/phpsp/phpsp.org.br/',
    'collections' => [
        'contents' => [
            'extends' => '_layouts.content',
            'section' => 'content',
            'author' => 'A Comunidade',
            'path' => function ($page) {
                return str_slug($page->getFilename());
            },
            'contribute_prefix' => '_contents/',
            'sitemap' => [
                'location' => function (PageVariable $page) {
                    // Adiciona o sufixo "/" para evitar redirecionamentos
                    return $page->getUrl() . '/';
                },
                'lastModified' => function (PageVariable $page) {
                    $date = new DateTime();
                    return $date->setTimestamp($page->createdAt);
                },
                'changeFrequency' => 'yearly',
            ],
        ],
        'posts' => [
            'extends' => '_layouts.post',
            'section' => 'post',
            'author' => 'A Comunidade',
            'path' => function ($page) {
                return 'artigos/' . str_slug($page->getFilename());
            },
            'sort' => '-createdAt',
            'contribute_prefix' => '_posts/',
            'sitemap' => [
                'location' => function (PageVariable $page) {
                    // Adiciona o sufixo "/" para evitar redirecionamentos
                    return $page->getUrl() . '/';
                },
                'lastModified' => function (PageVariable $page) {
                    $date = new DateTime();
                    return $date->setTimestamp($page->createdAt);
                },
                'changeFrequency' => 'monthly',
            ],
        ],
    ],
    'links' => [
        'github' => [
            'title' => 'GitHub',
            'img' => '/assets/images/thirdparty/GitHub-Mark-120px-plus.png',
            'url' => 'https://github.com/phpsp',
        ],
        'rss' => [
            'title' => 'RSS',
            'img' => '/assets/images/thirdparty/rss.png',
            'url' => 'https://phpsp.org.br/feed.xml',
        ],
        'twitter' => [
            'title' => 'Twitter',
            'img' => '/assets/images/thirdparty/Twitter_Social_Icon_Circle_Color.png',
            'url' => 'https://twitter.com/phpsp',
        ],
        'slack' => [
            'title' => 'Slack',
            'img' => '/assets/images/thirdparty/SlackAppIcon.png',
            'url' => 'https://bit.ly/vem-pro-slack-phpsp',
        ],
        'linkedin' => [
            'title' => 'LinkedIn',
            'img' => '/assets/images/thirdparty/In-2C-128px-TM.png',
            'url' => 'https://www.linkedin.com/company/phpsp---php-user-group-in-s-o-paulo/',
        ],
        'facebook' => [
            'title' => 'Facebook',
            'img' => '/assets/images/thirdparty/flogo_RGB_HEX-144.png',
            'url' => 'https://facebook.com/phpsp',
        ],
        'telegram' => [
            'title' => 'Telegram',
            'img' => '/assets/images/thirdparty/telegram.png',
            'url' => 'https://t.me/phpsp',
        ],
    ],
    'links_header' => [
        'mobile' => [
            'rss', 'twitter', 'slack', 'telegram',
        ],
        'desktop' => [
            'rss', 'github', 'twitter', 'slack', 'linkedin', 'facebook', 'telegram',
        ],
    ],
    'branches' => [
        'sao_paulo' => [
            'title' => 'PHPSP São Paulo',
            'description' => 'Eventos na cidade de SP',
            'link' => 'https://www.meetup.com/php-sp/events/',
        ],
        'campinas' => [
            'title' => 'PHPSP Campinas',
            'description' => 'Eventos na cidade de Campinas',
            'link' => 'https://www.meetup.com/phpsp-campinas/events/',
        ],
        'santos' => [
            'title' => 'PHPSP Santos',
            'description' => 'Eventos na cidade de Santos',
            'link' => 'https://www.meetup.com/phpsp-santos/events/',
        ],
    ],
    'events' => [
        'php-sp',
        'phpsp-campinas',
        'phpsp-santos',
    ],
    'sponsors' => [
        'azure' => [
            'title' => 'Microsoft Azure',
            'img' => '/assets/images/sponsors/azure.png',
            'url' => 'https://azure.microsoft.com/pt-br/',
        ],
        'imasters' => [
            'title' => 'iMasters',
            'img' => '/assets/images/sponsors/imasters.png',
            'url' => 'https://imasters.com.br/',
        ],
        'paypal' => [
            'title' => 'PayPal',
            'img' => '/assets/images/sponsors/paypal.png',
            'url' => 'https://paypal.com.br/',
        ],
        'locaweb' => [
            'title' => 'LocaWeb',
            'img' => '/assets/images/sponsors/locaweb.png',
            'url' => 'https://www.locaweb.com.br/',
        ],
        'phpstorm' => [
            'title' => 'PHPStorm',
            'img' => '/assets/images/sponsors/phpstorm.png',
            'url' => 'https://www.jetbrains.com/phpstorm/',
        ],
        'contaazul' => [
            'title' => 'ContaAzul',
            'img' => '/assets/images/sponsors/contaazul.png',
            'url' => 'https://contaazul.com/',
        ],
        'devnaestrada' => [
            'title' => 'Dev Na Estrada',
            'img' => '/assets/images/sponsors/devnaestrada.png',
            'url' => 'https://devnaestrada.com.br/',
        ],
    ],
    'projects' => [
        'php-the-right-way' => [
            'title' => 'PHP The Right Way - BR',
            'description' => 'Uma referência rápida de melhores práticas de PHP, renomados padrões de código e links para tutoriais competentes pela Web',
            'url' => 'https://github.com/PHPSP/php-the-right-way',
        ],
        'quero-palestrar' => [
            'title' => 'Quero Palestrar',
            'description' => 'Repositório de palestrantes e propostas de palestras para eventos de tecnologia',
            'url' => 'https://github.com/PHPSP/quero-palestrar',
        ],
        'zf2-documentation-br' => [
            'title' => 'ZF2 docs - BR',
            'description' => 'Tradução da Documentação Oficial do Zend Framework',
            'url' => 'https://github.com/PHPSP/zf2-documentation-br',
        ],
    ],
];
