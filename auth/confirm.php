<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Магнитогорская СК - вход в личный кабинет");
$APPLICATION->SetPageProperty("title", "Подтверждение регистрации");
$APPLICATION->SetTitle("Подтверждение регистрации");
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
                            $APPLICATION->IncludeComponent(
                                "bitrix:system.auth.confirmation",
                                "magnit",
                                Array(
                                    "CONFIRM_CODE" => "confirm_code",
                                    "LOGIN" => "login",
                                    "USER_ID" => "confirm_user_id"
                                )
                            );
                            ?>
                        </div>
                        <div class="content__side">
                            <div class="inform-block  inform-block_blue-bg">
                                <?$APPLICATION->IncludeFile(
                                    SITE_TEMPLATE_PATH."/includes/auth/side.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>