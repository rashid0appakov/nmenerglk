<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("МСК - Регистрация");
?>
	<div class="page">
        <div class="container">
            <div class="page__inner">
                <div class="content">
                    <div class="content__title">
                        Забыли пароль?
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
                            <?$APPLICATION->IncludeComponent(
                            	"bitrix:main.auth.forgotpasswd", 
                            	"magnit", 
                            	array(
                            		"AUTH_AUTH_URL" => "/",
                            		"AUTH_REGISTER_URL" => "",
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