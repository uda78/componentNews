<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div>
    <div>
        <?= $arResult["DETAIL_TEXT"] ?>
    </div>

    <div>
        <p>
            <?= $arResult["ACTIVE_FROM"] ?>
        </p>
    </div>

    <? if (!empty($arResult['DETAIL_PICTURE'])): ?>
        <div class="img_news_picture">
            <img class="news_picture" src="<?= $arResult['DETAIL_PICTURE'] ?>">
        </div>
    <? endif; ?>

    <div>
        <a href="<?= $arParams['SEF_FOLDER']; ?>">Вернуться в список новостей</a>
    </div>

</div>