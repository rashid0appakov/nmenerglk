<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Заявка на ТП");
$APPLICATION->SetTitle("Заявка на ТП");
if(!$USER->IsAuthorized())
{
	LocalRedirect('/');
}
?><div class="page">
	<div class="container">
		<div class="page__inner">
			<div class="sidebar">
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
	"bitrix:catalog.section.list", 
	"magnit", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COUNT_ELEMENTS" => "Y",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "Requests",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_FAQ",
			1 => "UF_DOC_LIST",
			2 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "magnit"
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