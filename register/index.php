<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");

if(!empty($_POST)) {
//    $_POST['PERSONAL_ZIP'] = '1111111';
//    var_dump('<pre>',$_POST,'</pre>');
//    die;
}
?>
<style>.asdsad > b {display:none;}</style>
	<div class="page">
        <div class="container">
            <div class="page__inner">

                <div class="sidebar">

                </div>
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
                            <?$APPLICATION->IncludeComponent(
								"bitrix:main.register", 
								"magnit", 
								array(
									"AUTH" => "Y",
									"REQUIRED_FIELDS" => array(
										0 => "EMAIL",
										
									),
									"SET_TITLE" => "Y",
									"SHOW_FIELDS" => array(
										0 => "EMAIL",
										1 => "TITLE",
										2 => "NAME",
										3 => "SECOND_NAME",
										4 => "LAST_NAME",
										5 => "WORK_COMPANY",
										6 => "WORK_PHONE",
									),
									"SUCCESS_PAGE" => "/register/success-reg.php",
									"USER_PROPERTY" => array(
										0 => "UF_ACC_TYPE",
										1 => "UF_IS_HEAD",
										2 => "UF_HEAD_SURNAME",
										3 => "UF_HEAD_NAME",
										4 => "UF_HEAD_MIDDLE",
										5 => "UF_INN",
										6 => "UF_GRNIP",
										7 => "UF_SNILS",
										8 => "UF_ORGANIZATION_TYPE",
										9 => "UF_ORGN",
										10 => "UF_MOBILE_PHONE",
										11 => "UF_ACTION_TYPE",
										12 => "UF_ACTION_TYPE_2",
										13 => "UF_MAIL_ME",
									),
									"USER_PROPERTY_NAME" => "",
									"USE_BACKURL" => "Y",
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