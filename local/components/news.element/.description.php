<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    'NAME' => 'Новости New детальная',
    'DESCRIPTION' => 'Новости New детальная',
    'PATH' => [
        'ID' => 'content',
        'CHILD' => [
            'ID' => 'news',
            'NAME' => 'Новости',
            'CHILD' => [
                'ID' => 'news_task_detail',
                'NAME' => 'news_task_detail',
            ]
        ]
    ],
);
