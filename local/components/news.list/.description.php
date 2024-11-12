<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    'NAME' => 'Новости New список',
    'DESCRIPTION' => 'Новости New список',
    'CACHE_PATH' => 'Y',
    'SORT' => 40,
    'PATH' => [
        'ID' => 'content',
        'CHILD' => [
            'ID' => 'news',
            'NAME' => 'Новости',
            'CHILD' => [
                'ID' => 'news_task_list',
                'NAME' => 'news_task_list',
            ]
        ]
    ],
);
