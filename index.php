<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Нарьян-Марская электростанция - вход в личный кабинет");
$APPLICATION->SetPageProperty("title", "Нарьян-Марская электростанция - вход в личный кабинет");
$APPLICATION->SetTitle("Нарьян-Марская электростанция - личный кабинет");
?>
    <div class="page">
        <div class="container">
            <div class="page__inner">
                <div class="content">
                    <div class="content__title">
                        Вход в личный кабинет
                    </div>
                    <ul class="breadcrumbs" itemprop="http://schema.org/breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumbs__item" id="bx_breadcrumb_0" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            
                            <a class="breadcrumbs__link" href="/" title="Главная" itemprop="item">
                                Главная
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="breadcrumbs__item">
                             | 
                            Вход в личный кабинет
                        </li>
                    </ul>
                    <?
                    /*
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "magnit", Array(
                        "PATH" => "",   // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                            "SITE_ID" => "s1",  // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                            "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                        ),
                        false
                    );?>
                    */
                    ?>
                    <div class="content__body">
                        <div class="content__side">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.auth.form", 
                                "magnit", 
                                array(
                                    "AUTH_FORGOT_PASSWORD_URL" => "/auth/forgotpassword.php",
                                    "AUTH_REGISTER_URL" => "/register/",
                                    "AUTH_SUCCESS_URL" => "/personal/",
                                    "COMPONENT_TEMPLATE" => "magnit"
                                ),
                                false
                            );?>
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