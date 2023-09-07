<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if(CModule::IncludeModule("iblock"))
{
    $statuses = null;
    $rsSection = CIBlockSection::GetList(
        array('SORT' => 'ASC'),
        array('IBLOCK_ID' => 3, 'ID' => 12),
        false,
        array('NAME', 'UF_STATUSES', 'UF_EMAIL_TITLE'),
        false
    );
    if($arSection = $rsSection->GetNext())
    {
        echo print_r($arSection['UF_EMAIL_TITLE']);
        $arFeedForm['SECTION_NAME'] = $arSection['NAME']; //тип заявки
        $statuses = $arSection['UF_STATUSES'];
    }
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>