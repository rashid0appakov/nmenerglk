<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Обратная связь");
$APPLICATION->SetTitle("Обратная связь");
if(!$USER->IsAuthorized())
{
	LocalRedirect('/');
}
?>
<style>
    .form__field-label {
        font-weight: bold;
    }
</style>
	<div class="page">
        <div class="container">
            <div class="page__inner">
                <div class="sidebar">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "magnit", Array(
                	"ROOT_MENU_TYPE" => "leftfirst",	// Тип меню для первого уровня
                		"MAX_LEVEL" => "1",	// Уровень вложенности меню
                		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
                		"CACHE_SELECTED_ITEMS" => "N",
                		"MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                		"COMPONENT_TEMPLATE" => ".default",
                		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                		"DELAY" => "N",	// Откладывать выполнение шаблона меню
                		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                	),
                	false
                );?>
                </div>
                <div class="content">
                    <div class="content__title">
                       <?=$APPLICATION->ShowTitle()?>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "magnit", Array(
                        "PATH" => "",   // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                            "SITE_ID" => "s1",  // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                            "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                        ),
                        false
                    );?>
                    <div class="content__body">
                       <div class="content__text">
                        
                           <?$APPLICATION->IncludeComponent(
                            	"bitrix:form.result.new", 
                            	"feedback", 
                            	array(
                            		"CACHE_TIME" => "3600",
                            		"CACHE_TYPE" => "N",
                            		"CHAIN_ITEM_LINK" => "",
                            		"CHAIN_ITEM_TEXT" => "",
                            		"EDIT_URL" => "",
                            		"IGNORE_CUSTOM_TEMPLATE" => "N",
                            		"LIST_URL" => "",
                            		"SEF_MODE" => "N",
                            		"SUCCESS_URL" => "",
                            		"USE_EXTENDED_ERRORS" => "N",
                            		"WEB_FORM_ID" => "1",
                            		"COMPONENT_TEMPLATE" => "feedback",
                            		"VARIABLE_ALIASES" => array(
                            			"WEB_FORM_ID" => "WEB_FORM_ID",
                            			"RESULT_ID" => "RESULT_ID",
                            		)
                            	),
                            	false
                            );?>
                            
                            <?
                            /*
                           <?$APPLICATION->IncludeComponent(
                            	"bitrix:iblock.element.add.form", 
                            	".default", 
                            	array(
                            		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                            		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                            		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
                            		"CUSTOM_TITLE_DETAIL_TEXT" => "",
                            		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
                            		"CUSTOM_TITLE_NAME" => "",
                            		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                            		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
                            		"CUSTOM_TITLE_TAGS" => "",
                            		"DEFAULT_INPUT_SIZE" => "30",
                            		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                            		"ELEMENT_ASSOC" => "CREATED_BY",
                            		"GROUPS" => array(
                            		),
                            		"IBLOCK_ID" => "1",
                            		"IBLOCK_TYPE" => "news",
                            		"LEVEL_LAST" => "Y",
                            		"LIST_URL" => "",
                            		"MAX_FILE_SIZE" => "0",
                            		"MAX_LEVELS" => "100000",
                            		"MAX_USER_ENTRIES" => "100000",
                            		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                            		"PROPERTY_CODES" => array(
                            			0 => "NAME",
                            			1 => "TAGS",
                            			2 => "DATE_ACTIVE_FROM",
                            		),
                            		"PROPERTY_CODES_REQUIRED" => array(
                            		),
                            		"RESIZE_IMAGES" => "N",
                            		"SEF_MODE" => "N",
                            		"STATUS" => "ANY",
                            		"STATUS_NEW" => "N",
                            		"USER_MESSAGE_ADD" => "",
                            		"USER_MESSAGE_EDIT" => "",
                            		"USE_CAPTCHA" => "N",
                            		"COMPONENT_TEMPLATE" => ".default"
                            	),
                            	false
                            );?>
                            */
                            ?>
                       </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>