<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Мои заявки");
$APPLICATION->SetTitle("Мои заявки");
if(!$USER->IsAuthorized())
{
	LocalRedirect('/');
}
?>
    <style>
        .prs_filter { margin-bottom: 27px; }
        .prs_filter_items_mb { margin-bottom: 8px; }
        .prs_filter_items label { display: block; color: #1a1a1a; font-size: 14px; margin-bottom: 8px; }
        .prs_filter_items input { width: 100%; display: block; margin-top: 4px; }
        .prs_filter_title { color: #1a1a1a; font-size: 14px; margin-bottom: 4px; }
        .prs_filter_btns { padding-top: 20px; }
        .prs_btn_clear { display: inline-block; text-transform: uppercase; font-size: 12px; background-color: transparent; border: 2px solid #ff0000; color: #ff0000; text-align: center; padding: 10px 16px; margin-right: 9%; -webkit-transition: all .25s; -o-transition: all .25s; transition: all .25s; font-weight: bold; text-decoration: none !important; }
        .prs_btn_sub { display: inline-block; text-transform: uppercase; font-size: 12px; background-color: #ff0000; border: 2px solid #ff0000; color: #fff; text-align: center; padding: 10px; -webkit-transition: all .25s; -o-transition: all .25s; transition: all .25s; font-weight: bold; min-width: 154px; cursor: pointer; }
        .prs_btn_sub:hover { background-color: transparent; color: #ff0000; }
        .prs_btn_clear:hover { background-color: #ff0000; color: #ffffff; }
        .prs_filter .dropdown__title_reg { background-color: #d2d2d6; border: 2px solid #d2d2d6; }
        .prs_filter .dropdown__item { font-size: 16px; }
        @media (min-width: 992px) {
            .prs_filter { font-size: 0; }
            .prs_filter_items { display: inline-block; width: 50%; vertical-align: top; padding-right: 44px; }
            .prs_filter_items_mb { margin-bottom: 0; }
        }
    </style>
<div class="page">
	<div class="container">
		<div class="page__inner">
			<div class="sidebar">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu", 
					"admin", 
					array(
						"ALLOW_MULTI_SELECT" => "N",
						"CACHE_SELECTED_ITEMS" => "N",
						"CHILD_MENU_TYPE" => "left",
						"COMPONENT_TEMPLATE" => "admin",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE" => "admin_left",
						"USE_EXT" => "N"
					),
					false
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"magnit",
					Array(
						"ALLOW_MULTI_SELECT" => "N",
						"CACHE_SELECTED_ITEMS" => "N",
						"CHILD_MENU_TYPE" => "left",
						"COMPONENT_TEMPLATE" => ".default",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => "",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE" => "leftfirst",
						"USE_EXT" => "N"
					)
				);?>
			</div>
			<div class="content">
				<div class="content__title">
					 <?=$APPLICATION->ShowTitle()?>
				</div>
				 <?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"magnit",
					Array(
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0"
					)
				);?>
				<div class="content__body">
					<div class="content__side">
                        <?
                        $uriREQ = explode('?', $_SERVER["REQUEST_URI"])[0];
                        $statusArr = [];
                        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_SECTION_ID");
                        $arFilter = Array("IBLOCK_ID" => 5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

                        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                        while($ob = $res->GetNextElement()){
                            $statusArr[$ob->fields["ID"]] = $ob->fields["NAME"];
                        }

                        $filialArray = [];
                        $tree = CIBlockSection::GetTreeList(
                            $arFilter = Array('IBLOCK_ID' => 3, 'DEPTH_LEVEL' => 1),
                            $arSelect = Array()
                        );
                        while($section = $tree->GetNext()) {
                            $filialArray[$section["ID"]] = $section["NAME"];
                        }
                        ksort($filialArray);
                        $isAdmin = false;
                        $arFilter = array("ID" => $USER->GetID());
                        $arParams["SELECT"] = array("UF_IS_ADMIN");
                        $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
                        global $arrNewsListFilter;
                        $arrNewsListFilter = [];
                        if($ar_res = $arRes->GetNext()) {
                            if($ar_res['UF_IS_ADMIN'] == 1)
                            {
                                $isAdmin = true;

                                $_GET["f_number"] ? $filterNUMBER = $_GET["f_number"] : $filterNUMBER = "" ;
                                $_GET["f_name"] ? $filterNAME = $_GET["f_name"] : $filterNAME = "" ;
                                $_GET["inn"] ? $filterInn = $_GET["inn"] : $filterInn = "" ;
                                $_GET["status"] ? $filterStatus = $_GET["status"] : $filterStatus = "" ;


                                if($filterNUMBER != "") {
                                    $arrNewsListFilter["PROPERTY_ZAYAVKA_NUM"] = $filterNUMBER;
                                }

                                if($filterStatus != "") {

                                    $elementsID = Array();

                                    if(CModule::IncludeModule("iblock"))
                                    {
                                        $res = CIBlockElement::GetList(Array(),
                                            Array("IBLOCK_ID" => 3, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_status" => $filterStatus)
                                            , false, false, Array("ID"));

                                        while($ob = $res->GetNextElement()){

                                            array_push($elementsID, $ob->fields["ID"]);
                                        }
                                    }

                                    $arrNewsListFilter["ID"] = $elementsID;
                                }
                                if($filterInn != "") {
                                    $usersID = Array();
                                    // ищем похожего пользователя
                                    $filter = Array("UF_INN" => "%" . $filterInn . "%",);
                                    $rsUsers = CUser::GetList(($by = "ID"), ($order = "asc"), $filter); // выбираем пользователей

                                    while($arUser = $rsUsers->Fetch()) {
                                        array_push($usersID, $arUser['ID']);
                                    }

                                    $arrNewsListFilter["CREATED_BY"] = $usersID;
                                }
                                if($filterNAME != "") {

                                    $usersID = Array();

                                    // ищем похожего пользователя
                                    $GLOBALS["FILTER_logic"] = "or";
                                    $filter = Array
                                    (
                                        "NAME" => "%" . $filterNAME . "%",
                                        "WORK_COMPANY" => "%" . $filterNAME . "%",
//                                            "SECOND_NAME" => "%" . $filterNAME . "%",
                                        "LAST_NAME" => "%" . $filterNAME . "%",

                                    );
                                    $rsUsers = CUser::GetList(($by = "ID"), ($order = "asc"), $filter); // выбираем пользователей


                                    while($arUser = $rsUsers->Fetch()) {
                                        array_push($usersID, $arUser['ID']);
                                    }

                                    $arrNewsListFilter["CREATED_BY"] = $usersID;
                                }
                            }
                        }

                        if(!$isAdmin)
                        {
                            $arrNewsListFilter["CREATED_BY"] = $USER->GetID();
                        }
                        if($isAdmin) {


                        ?>
                        <div class="prs_filter">
                            <form action="<? echo $uriREQ; ?>" method="GET">
                                <div class="prs_filter_items prs_filter_items_mb">
                                    <label for="f_number">Номер заявки
                                        <input type="text" class="form__field-input" name="f_number" value="<? if($_GET["f_number"]){ echo $_GET["f_number"]; } ?>" id="f_number">
                                    </label>

                                    <label for="f_number">ИНН
                                        <input type="text" class="form__field-input" name="inn" value="<? if($_GET["inn"]){ echo $_GET["inn"]; } ?>" id="inn">
                                    </label>
                                </div>

                                <div class="prs_filter_items">


                                    <p class="prs_filter_title">Наименование заявителя</p>
                                    <label for="f_name">
                                        <input class="form__field-input" type="text" name="f_name" value="<? if($_GET["f_name"]){ echo $_GET["f_name"]; } ?>" id="f_name">
                                    </label>


                                    <p class="prs_filter_title">Статус заявки</p>
                                    <div class="dropdown js-dropdown">
                                        <input type="hidden" id="acc_type" name="status" class="dropdown__input js-toggle-form"
                                               data-name="<? if($_GET["status"]){ echo $statusArr[$_GET["status"]]; } ?>"
                                               value="<? if($_GET["status"]){ echo $_GET["status"]; } ?>">

                                        <div class="dropdown__title dropdown__title_reg"><? if($_GET["status"]){ echo $statusArr[$_GET["status"]]; } ?></div>
                                        <div class="dropdown__list" style="display: none;">
                                            <div data-id="" class="acc_type dropdown__item "></div>
                                            <? foreach ($statusArr as $key => $value) { ?>
                                                <div data-id="<? echo $key; ?>" class="acc_type dropdown__item <? if($_GET["status"] == $key){ echo 'active'; } ?>"><? echo $value; ?></div>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="prs_filter_items">
                                    <div class="prs_filter_btns">
                                        <a href="<? echo $uriREQ; ?>" class="prs_btn_clear">очистить</a>
                                        <button class="prs_btn_sub">применить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
						<?
                        }



                        $_user_ID = $USER->GetID();
                        $user = CUser::GetByID($_user_ID);
                        $arUser = $user->Fetch();

                        $_is_GP = false;
                        if($arUser ["UF_IS_GP"] == 1) {

                            $_id_status_for_GP = Array();
                            $_IBLOCK_STATUS = 5;
                            $_alert_gp = ''; // "Да"
                            $_status_id = '';

                            $zayavkas = CIBlockElement::GetList(array("SORT"=>"ASC"), array('ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' =>  $_IBLOCK_STATUS), false, false,
                                Array("NAME", "ID", "PROPERTY_alert_gp")
                            );

                            while($new_zayavkas = $zayavkas->GetNextElement())
                            {
                                $ar_res_2 = $new_zayavkas->GetFields();

                                $_alert_gp = $ar_res_2["PROPERTY_ALERT_GP_VALUE"]; // получили значение чекбокса ГП
                                if($_alert_gp == 'Да') {
                                    array_push($_id_status_for_GP, $ar_res_2["ID"]);
                                }
                            }

                            $arrNewsListFilter['PROPERTY_status'] = $_id_status_for_GP;
                        }


						?>
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"magnit", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.y g:i A",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"FIELD_CODE" => array(
			0 => "DATE_CREATE",
			1 => "CREATED_BY",
			2 => "CREATED_USER_NAME",
			3 => "TIMESTAMP_X",
			4 => "",
		),
		"FILTER_NAME" => "arrNewsListFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Requests",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"PAGER_TITLE" => "Заявки",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "status",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ID",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "magnit",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>