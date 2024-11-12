<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
    "app:news.list",
    "",
    array(
        "IBLOCK_CODE" => $arParams["IBLOCK_CODE"],
        "PAGE_SIZE" => $arParams["PAGE_SIZE"],
        "SEF_FOLDER" => $arParams["SEF_FOLDER"],
    )
);
