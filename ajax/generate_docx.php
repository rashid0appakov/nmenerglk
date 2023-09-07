<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/core/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/core/vendor/autoload.php';

CModule::IncludeModule('iblock');

$hash        = null;
$knownFields = [];
$properties  = \CIBlockProperty::GetList([], ["ACTIVE" => "Y", "IBLOCK_ID" => REQUEST_BLOCK_ID]);
while ($prop_fields = $properties->GetNext()) {
    $knownFields[] = $prop_fields['CODE'];
}

global $USER;
$userId = $USER->GetID();

$fields = array_filter($_REQUEST);
$hash   = md5('salt1' . serialize(array_intersect_key($fields, array_fill_keys($knownFields, null))) . 'salt2');

if (!$_REQUEST['REQUEST_TYPE_SECTION_ID']) {
    http_response_code(400);
    throw new RuntimeException('Request type must be specified.');
}
$res = CIBlockSection::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => 3, 'ID' => $_REQUEST['REQUEST_TYPE_SECTION_ID']],
    false,
    ['NAME', 'UF_STATUSES'],
    false
);
if ($ar_res = $res->GetNext()) {
    $RequestTypeTitle = $ar_res['NAME'];
} else {
    http_response_code(404);
    throw new RuntimeException('Request type was not found.');
}


$rsUser   = CUser::GetByID($userId); //получаем поля пользователя
$userInfo = $arUser = $rsUser->Fetch();
$dir      = $arUser['ID'] . '_' . $arUser['LOGIN'];
$fileDir = '/requests/' . $dir . '/';
//$filePdf = $fileDir . $id . '_blank_zayavki.docx';
$filePdf  = tempnam(sys_get_temp_dir(), 'blank_zayavki.docx');
$helper   = new \lib\core\src\helpers\RequestHelper();
$userType = $helper->getValById($arUser['UF_ACC_TYPE']); // тип пользователя: юр/физ/пр.п лицо
$factory  = new \lib\core\src\model\factory\RequestFactory();
$htmlTpl  = $userInfo['UF_ACC_TYPE'];
/** @var \lib\core\src\model\requests\Requests $request */
$request = $factory->create($userType, $RequestTypeTitle);
$types   = $request->getRequestTypes();
$type    = $types[$request->getName()];

switch ($RequestTypeTitle) {
    case 'Заявка на тех. присоединение к электрическим сетям свыше 150 кВт':
        $type = 'svishe_150.php';
        break;
    case 'Заявка на тех. присоединение к электрическим сетям до 150 кВт':
        $type = 'ul_ot_15_do150.php';
        break;
    case 'Заявка на тех. присоединение к электрическим сетям для физ. лиц до 15 кВт':
        $type = '01_fl_do_15.php';
        break;
    case 'Заявка на тех. присоединение к электрическим сетям для физ. лиц от 15 до 150 кВт':
        $type = 'fl_ot_15_do150.php';
        break;
    default:
        http_response_code(404);
        throw new RuntimeException('Unknown request type.');
}

$template = $type;
$path     = $_SERVER['DOCUMENT_ROOT'] . '/lib/core/src/view/doc/';
$file     = $path . $template;

if (!file_exists($file)) {
    http_response_code(500);
    throw new RuntimeException('Template was not found.');
}

$fieldsFill = $fields;
if (empty($fieldsFill)) {
    http_response_code(400);
    throw new RuntimeException('Empty fields.');
}

$arFilter = Array(
    "IBLOCK_ID"=> 3,
    "ACTIVE"=>"Y",
);
$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array('nTopCount' => 2), Array("ID", "PROPERTY_ZAYAVKA_NUM"));
while($ar_fields = $res->GetNext())
{
    $order_num = $ar_fields["PROPERTY_ZAYAVKA_NUM_VALUE"] + 1;
}

include $file;
if (!file_exists($filePdf)) {
    http_response_code(500);
    throw new RuntimeException('File was not generated.');
}

$fileId = CFile::SaveFile(
    [
        "name"     => 'Бланк заявки.docx',
        "size"     => filesize($filePdf),
        "tmp_name" => $filePdf,
        "type"     => mime_content_type($filePdf),
    ],
    $fileDir
);
if (!file_exists($filePdf)) {
    http_response_code(500);
    throw new RuntimeException('File was not saved.');
}
$hash2 = md5(sprintf('salt1%ssalt2', md5_file($filePdf)));
if (!$hash2) {
    http_response_code(500);
    throw new RuntimeException('File handle failed.');
}

echo json_encode([
                     'key'  => $hash,
                     'hash' => $hash2,
                     'name' => 'Бланк заявки.docx',
                     'url'  => CFile::GetPath($fileId),
                     'id'   => $fileId,
                 ]);
