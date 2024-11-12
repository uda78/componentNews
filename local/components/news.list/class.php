<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\Iblock;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Type\DateTime;

class NewsList extends CBitrixComponent
{
    public function executeComponent()
    {
        $nav = new PageNavigation('nav-news');
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['PAGE_SIZE'])
            ->initFromUri();

        // получаем параметры из URL
        $request = Application::getInstance()->getContext()->getRequest();
        $uri = new Uri($request->getRequestUri());
        parse_str($uri->getQuery(), $arUrlParams);

        // определяем фильтрацию, чтобы можно было вернуться в общий список
        $this->arResult['FILTER_TAGS'] = false;
        $filter = ['ACTIVE' => 'Y'];

        $code = $this->arParams['IBLOCK_CODE'];
        $iblockId = IblockTable::getList(['filter' => ['CODE' => $code]])->fetch()["ID"];
        $entity = Iblock::wakeUp($iblockId)->getEntityDataClass();

        if (!empty($arUrlParams['tag'])) {
            $filter['TAGS'] = '%' . $arUrlParams['tag'] . '%';
            $this->arResult['FILTER_TAGS'] = true;
        }

        $dbElements = $entity::getList([
            'order' => ['ACTIVE_FROM' => 'DESC'],
            'filter' => $filter,
            'select' => [
                'ID',
                'CODE',
                'NAME',
                'ACTIVE_FROM',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL',
                'TAGS',
            ],
            'count_total' => true,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
        ]);

        $count = $dbElements->getCount();

        if (!$count) {
            ShowNote('Нет новостей');
        }

        foreach ($dbElements->fetchAll() as $arItem) {
            $dateTime = new DateTime($arItem['ACTIVE_FROM']);
            $arItem['ACTIVE_FROM'] = $dateTime->format('d.m.Y');
            $arItem['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'],  $arItem,  false,  'E');
            if (!empty($arItem['TAGS'])) {
                $arItem['TAGS'] = explode(", ", $arItem['TAGS']);
            }
            $arItem['PREVIEW_PICTURE'] = CFile::GetPath($arItem['PREVIEW_PICTURE']);
            $this->arResult['ITEMS'][] = $arItem;
        }

        $nav->setRecordCount($dbElements->getCount());
        $this->arResult['NAV'] = $nav;

        $this->IncludeComponentTemplate();
    }
}
