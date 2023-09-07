<?php
//
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(0);
use lib\core\src\model\requests\Requests;
include $_SERVER['DOCUMENT_ROOT'] . '/lib/core/autoloader.php';
include $_SERVER['DOCUMENT_ROOT'] . '/lib/core/vendor/autoload.php';

if ($id > 0) {
    // global $USER;
    // $dir = $USER->GetID() . '_' . $USER->GetLogin();
    
    $rs = CIBlockElement::GetList(
        ["SORT"=>"ASC"],
        ['ID' => $id],
        false, false,
        ['ID', 'IBLOCK_ID', 'CREATED_BY']
    );
    $ar = $rs->GetNext();
    $userId = $ar['CREATED_BY'];
    $rsUser = CUser::GetByID($userId);//получаем поля пользователя
    $arUser = $rsUser->Fetch();
    $dir = $arUser['ID'] . '_' . $arUser['LOGIN'];

    $fileDir = '/upload/requests/' . $dir . '/';
    $filePdf = $fileDir . $id . '_blank_zayavki.docx';
    //$templateId = 'ur_litso.docx';
    //$template = $request->getTemplates()[$templateId];
    $helper = new \lib\core\src\helpers\RequestHelper();
    $userInfo = $helper->getUserInfo($userId);

    $arUser = $helper->getUserInfo($userId); // данные пользователя
    $userType = $helper->getValById($arUser['UF_ACC_TYPE']); // тип пользователя: юр/физ/пр.п лицо
    $factory = new \lib\core\src\model\factory\RequestFactory();
    $htmlTpl = $userInfo['UF_ACC_TYPE'];

    /** @var Requests $request */
    $request = $factory->create($userType, $ar_res['NAME']);
    $types = $request->getRequestTypes();
    $type = $types[$request->getName()];

    switch ($ar_res['NAME']) {
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
    }


    $template = $type;
    $path = $_SERVER['DOCUMENT_ROOT'] . '/lib/core/src/view/doc/';
    $file = $path . $template;
    
    if (file_exists($file)) {
        $fields = $request->findById($id);
        $request->setFillFields($fields);
        $fillFields = $request->getFillFields();
        $fields = $request->getFields();
        $fieldsFill = [];

        if (!empty($fillFields)) {
            $fieldsById = [];
            foreach ($fields as $field) {
                $fieldsById[$field['ID']] = $field;
            }
            foreach ($fillFields as $fillFieldK => $fillField) {
                if (strpos($fillFieldK, 'PROPERTY_') !== 0) continue;
                if (!$fillField) continue;

                $propId = str_replace('PROPERTY_', '', $fillFieldK);
                $propCode = $fieldsById[$propId]['CODE'];
                $fieldsFill[$propCode] = $fillField;
            }
        }

        if (!empty($fieldsFill)) {
            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $fileDir)) {
                // dir doesn't exist, make it
                mkdir($_SERVER['DOCUMENT_ROOT'] . $fileDir);
            }
            include $file;
        }
    }
}