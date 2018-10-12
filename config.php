<?php

return [
    'baseUrl'       => 'http://localhost:3000/',
    'title'         => 'Grupo de desenvolvedores de PHP do estado de São Paulo',
    'production'    => false,
    'collections'   => [
        'contents' => [
            'extends'   =>  '_layouts.content',
            'section'   =>  'content',
            'author'    =>  'A Comunidade',
            'path'      =>  '{filename}',
            'sort'      =>  'order',
        ],
        'posts' => [
            'extends'   =>  '_layouts.post',
            'section'   =>  'post',
            'author'    =>  'A Comunidade',
            'path'      =>  'artigos/{filename}',
            'sort'      =>  '-createdAt',
        ],
    ],
    'links'         => [
        'github' => [
            'title'     =>  'GitHub',
            'img'       =>  '/assets/images/thirdparty/GitHub-Mark-120px-plus.png',
            'url'       =>  'https://github.com/phpsp',
        ],
        'twitter' => [
            'title'     =>  'Twitter',
            'img'       =>  '/assets/images/thirdparty/Twitter_Social_Icon_Circle_Color.png',
            'url'       =>  'https://twitter.com/phpsp',
        ],
        'slack' => [
            'title'     =>  'Slack',
            'img'       =>  '/assets/images/thirdparty/SlackAppIcon.png',
            'url'       =>  'https://bit.ly/vemproslackphpsp',
        ],
        'linkedin' => [
            'title'     =>  'LinkedIn',
            'img'       =>  '/assets/images/thirdparty/In-2C-128px-TM.png',
            'url'       =>  'https://www.linkedin.com/groups/PHPSP-Grupo-Desenvolvedores-PHP-S%C3%A3o-1808119',
        ],
        'facebook' => [
            'title'     =>  'Facebook',
            'img'       =>  '/assets/images/thirdparty/flogo_RGB_HEX-144.png',
            'url'       =>  'https://facebook.com/sao.paulo.elephants',
        ],
    ],
    'links_header'  => [
        'mobile' => [
            'github', 'twitter', 'slack',
        ],
        'desktop' => [
            'github', 'twitter', 'slack', 'linkedin', 'facebook',
        ],
    ],
    'isPost'        => function ($page) {
        return isset($page->section) && $page->section === 'post';
    },
];
