<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

?>
<div class="page">
	<div class="container">
		<div class="page__inner">
			<?$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH."/includes/404.php",
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
</div>

<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>