<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
    "app:news.element",
    "",
    array(
        "IBLOCK_CODE" => $arParams["IBLOCK_CODE"],
        "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
        "SEF_FOLDER" => $arParams["SEF_FOLDER"],
    )
);
