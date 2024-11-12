<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

Loader::includeModule('iblock');

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arFilterInfoBlocks = array('ACTIVE' => 'Y');
$arOrderInfoBlocks = array('SORT' => 'ASC');

if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilterInfoBlocks['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}

$rsIBlock = CIBlock::GetList($arOrderInfoBlocks, $arFilterInfoBlocks);

$arInfoBlocks = array();
while ($obIBlock = $rsIBlock->Fetch()) {
    $arInfoBlocks[$obIBlock['CODE']] = '[' . $obIBlock['CODE'] . '] ' . $obIBlock['NAME'];
}

$arComponentParameters = [
    "PARAMETERS" => [
        'IBLOCK_TYPE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Выберите тип инфоблока',
            'TYPE' => 'LIST',
            'VALUES' => $arIBlockType,
            'REFRESH' => 'Y',
            'MULTIPLE' => 'N',
        ],
        'IBLOCK_CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Выберите родительский инфоблок',
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
            'REFRESH' => 'Y',
            "DEFAULT" => '',
            "ADDITIONAL_VALUES" => "Y",
        ],
        'PAGE_SIZE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Количество записей на странице',
            'TYPE' => 'STRING',
            "DEFAULT" => 3,
        ],
        "SEF_MODE" => [
            "element" => [
                "NAME" => 'Детальная страница',
                "DEFAULT" => "#ELEMENT_CODE#/",
            ]
        ],
    ]
];
