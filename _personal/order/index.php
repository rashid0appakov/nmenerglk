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
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"magnit", 
	array(
		"ACTIVE_DATE_FORMAT" => "FULL",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => $_REQUEST["id"],
		"FIELD_CODE" => array(
			0 => "CREATED_BY",
			1 => "CREATED_USER_NAME",
			2 => "TIMESTAMP_X",
			3 => "DATE_CREATE",
		),
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Requests",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "comment",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
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