<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Подача заявки");
$APPLICATION->SetTitle("Подача заявки");
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
                            <div class="content__text">
                                Выберите интересующий тип заявки:

                            </div>
                            <ul class="orders-list">
                                <li class="orders-list__item">
                                    <a href="/" class="orders-list__link">
                                        Заявка на тех. присоединение к системе водоснабжения и водоотведения
                                    </a>
                                </li>
                                <li class="orders-list__item">
                                    <a href="/" class="orders-list__link">
                                        Заявка на тех. присоединение к электрическим сетям
                                    </a>
                                </li>
                                <li class="orders-list__item">
                                    <a href="/" class="orders-list__link">
                                        Заявка на тех. присоединение к системе теплоснабжения
                                    </a>
                                </li>
                            </ul>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>