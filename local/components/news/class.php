<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use App\Debug;
use Bitrix\Main\Loader;
use \Bitrix\Iblock\IblockTable;

class News extends CBitrixComponent
{
    public function executeComponent()
    {
        Loader::includeModule('iblock');

        if (empty($this->arParams["SEF_FOLDER"])) {
            $code = $this->arParams["IBLOCK_CODE"];
            $iblockId = IblockTable::getList(['filter' => ['CODE' => $code]])->fetch()["ID"];
            $dbResult = CIBlock::GetByID($iblockId)->GetNext();

            if (!empty($dbResult)) {
                $this->arParams["SEF_URL_TEMPLATES"]["element"] = $dbResult["DETAIL_PAGE_URL"];
                $this->arParams["SEF_FOLDER"] = $dbResult["LIST_PAGE_URL"];
            }
        }

        $arDefaultUrlTemplates404 = [
            "element" => "#ELEMENT_CODE#/",
        ];

        $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates(
            $arDefaultUrlTemplates404,
            $this->arParams["SEF_URL_TEMPLATES"]
        );

        $engine = new CComponentEngine($this);

        $arVariables = [];

        $componentPage = $engine->guessComponentPath(
            $this->arParams["SEF_FOLDER"],
            $arUrlTemplates,
            $arVariables
        );

        if ($componentPage == FALSE) {
            $componentPage = 'list';
        }

        $this->arResult = [
            "VARIABLES" => $arVariables,
        ];

        $this->IncludeComponentTemplate($componentPage);
    }
}
