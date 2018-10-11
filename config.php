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
    'isPost' => function ($page) {
        return isset($page->section) && $page->section === 'post';
    },
];
