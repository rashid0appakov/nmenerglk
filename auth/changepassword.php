<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Магнитогорская СК - вход в личный кабинет");
$APPLICATION->SetPageProperty("title", "Смена пароля");
$APPLICATION->SetTitle("Смена пароля");
?>
	<div class="page">
        <div class="container">
            <div class="page__inner">
                <div class="content">
                    <div class="content__title">
                        <?=$APPLICATION->ShowTitle();?>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "magnit", Array(
                    	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    		"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    		"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                    	),
                    	false
                    );?>
                    <div class="content__body">
                        <div class="content__side">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.auth.changepasswd", "magnit", Array(
                                "AUTH_AUTH_URL" => "/auth/",    // Страница для авторизации
                                    "AUTH_REGISTER_URL" => "/register/",    // Страница для регистрации
                                    "COMPONENT_TEMPLATE" => ".default"
                                ),
                                false
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>