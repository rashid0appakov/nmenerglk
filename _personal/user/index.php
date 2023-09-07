<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Мои данные");
$APPLICATION->SetTitle("Мои данные");
if(!CUser::IsAuthorized())
{
	LocalRedirect('/');
}
?>
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
                        <div class="content__side">
                            <?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"magnit", 
	array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_ACC_TYPE",
			1 => "UF_IS_HEAD",
			2 => "UF_ORGANIZATION_TYPE",
			3 => "UF_ORG_TYPE_NAME",
			4 => "UF_HEAD_SURNAME",
			5 => "UF_HEAD_NAME",
			6 => "UF_HEAD_MIDDLE",
			7 => "UF_INN",
			8 => "UF_GRNIP",
			9 => "UF_SNILS",
			10 => "UF_ORGN",
			11 => "UF_POSTAL_COINC",
			12 => "UF_MAIL_ME",
            13 => "UF_PASSPORT_SERIAL",
            14 => "UF_PASSPORT_NUM",
            15 => "UF_PASSPORT_DATE",
            16 => "UF_PASSPORT_FROM",
            17 => "UF_ACTION_TYPE",
            18 => "UF_ACTION_TYPE_2",
		),
		"USER_PROPERTY_NAME" => "",
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
	<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>