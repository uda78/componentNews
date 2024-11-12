<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>
<? $APPLICATION->IncludeComponent(
	"app:news",
	"",
	array(
		"IBLOCK_CODE" => "news",
		"IBLOCK_TYPE" => "news",
		"PAGE_SIZE" => "2",
		"SEF_FOLDER" => "/news/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("element" => "#ELEMENT_CODE#/")
	)
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>