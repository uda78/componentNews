<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\Iblock;

class NewsElement extends CBitrixComponent
{
    public function executeComponent()
    {
        $code = $this->arParams['IBLOCK_CODE'];
        $iblockId = IblockTable::getList(['filter' => ['CODE' => $code]])->fetch()["ID"];
        $entity = Iblock::wakeUp($iblockId)->getEntityDataClass();

        $this->arResult = $entity::getList([
            'select' => [
                "ID",
                "NAME",
                "DETAIL_TEXT",
                "DETAIL_PICTURE",
                "ACTIVE_FROM",
                "CODE"
            ],
            'filter' => [
                'IBLOCK_ID' => $iblockId,
                'CODE' => $this->arParams['ELEMENT_CODE']
            ],
        ])->fetch();

        if (empty($this->arResult)) {
            header('Location: ' . $this->arParams['SEF_FOLDER']);
        }

        $this->arResult['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($this->arResult['DETAIL_PAGE_URL'],  $this->arResult,  false,  'E');
        $this->arResult['DETAIL_PICTURE'] = CFile::GetPath($this->arResult["DETAIL_PICTURE"]);

        $dateTime = new Bitrix\Main\Type\DateTime($this->arResult['ACTIVE_FROM']);
        $this->arResult['ACTIVE_FROM'] = $dateTime->format('d.m.Y');

        $this->IncludeComponentTemplate();
    }
}
