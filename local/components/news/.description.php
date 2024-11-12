<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    'NAME' => 'Новости New',
    'DESCRIPTION' => 'Новости New',
    'CACHE_PATH' => 'Y',
    'COMPLEX' => 'Y',
    'PATH' => [
        'ID' => 'content',
        'CHILD' => [
            'ID' => 'news',
            'NAME' => 'Новости',
            'CHILD' => [
                'ID' => 'news_task',
                'NAME' => 'news_task',
            ]
        ]
    ],
);
