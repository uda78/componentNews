<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
foreach ($arResult['ITEMS'] as $news) {
?>
    <div>
        <a href="<?= $news['DETAIL_PAGE_URL'] ?>">
            <div>
                <h3><?= $news['NAME'] ?></h3>
            </div>
        </a>

        <div>
            <p>
                <?= $news['ACTIVE_FROM'] ?>
            </p>
        </div>

        <? if (!empty($news['PREVIEW_PICTURE'])): ?>
            <div>
                <img class="news_picture" src="<?= $news['PREVIEW_PICTURE'] ?>">
            </div>
        <? endif; ?>
        <div>
            <?= $news['PREVIEW_TEXT'] ?>
        </div>
    </div>

    <? // если имеются теги, то вывести их

    if (!empty($news['TAGS'])) { ?>
        <div class="tags">
            <? foreach ($news['TAGS'] as $tag) { ?>
                <a class="tag" href='<?= $arParams["SEF_FOLDER"] . "?tag=$tag" ?>'><?= trim($tag) ?></a>
            <? } ?>
        </div>
    <? } ?>
    <hr>
<?
}
?>

<? // если сделана фильтрация по тегам, то вывести ссылку в общий список
if ($arResult['FILTER_TAGS']): ?>
    <p>
        <a href="<?= $arParams['SEF_FOLDER']; ?>">Вернуться в список новостей</a>
    </p>
<? endif; ?>

<?
$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    array(
        "NAV_OBJECT" => $arResult['NAV'],
        "SEF_MODE" => "N",
    ),
    false
);
?>