<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Мои заявки");
$APPLICATION->SetTitle("Мои заявки");
if(!CUser::IsAuthorized())
{
	LocalRedirect('/');
}

?>
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
							$isAdmin = false;
							$arFilter = array("ID" => $USER->GetID());
							$arParams["SELECT"] = array("UF_IS_ADMIN");
							$arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
							if($ar_res = $arRes->GetNext())
							{
								if($ar_res['UF_IS_ADMIN'] == 1)
								{
									$isAdmin = true;
								}
							}
							if(!$isAdmin)
							{
								global $arrNewsListFilter;
						   		$arrNewsListFilter["CREATED_BY"] = $USER->GetID();
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
		"SET_LAST_MODIFIED" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
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