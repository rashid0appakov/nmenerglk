<?php

AddEventHandler("main", "OnBeforeUserLogin", Array("CUserEx", "OnBeforeUserLogin"));
AddEventHandler("main", "OnBeforeUserRegister", Array("CUserEx", "OnBeforeUserRegister"));
AddEventHandler("main", "OnAfterUserRegister", Array("CUserEx", "OnAfterUserRegisterHandler"));
class CUserEx
{
    public static function OnBeforeUserLogin($arFields)
    {
        $filter = Array("=EMAIL" => $arFields["LOGIN"]);
        $rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter);
        if($user = $rsUsers->GetNext())
            $arFields["LOGIN"] = $user["LOGIN"];
        //else $arFields["LOGIN"] = "";
    }
    public static function OnBeforeUserRegister($arFields)
    {
        $arFields["LOGIN"] = $arFields["EMAIL"];
        $arFields["CONFIRM_PASSWORD"] = $arFields["PASSWORD"];
    }
    public static function OnAfterUserRegisterHandler(&$arFields)
    {
        $post = $_POST;
        $personal = [];
        foreach ($post['REGISTER'] as $k=>$reg) {
            if(strpos($k, 'WORK_') !== false OR strpos($k, 'PERSONAL_') !== false) {
                $personal[$k] = $reg;
            }
        }

        $id = $arFields['USER_ID'];
        $user = new CUser;
        ($user->Update($id, $personal));
    }
}


AddEventHandler('iblock', 'OnAfterIBlockElementAdd', 'IBFeedForm');

function IBFeedForm(&$arFields)
{
    $SITE_ID = 's1';
    $IBLOCK_ID = 3; // заявки
    $EVEN_TYPE = 'REQUEST_ADDED';

    if ($arFields['IBLOCK_ID'] == $IBLOCK_ID)
    {
        $user = CUser::GetByID($arFields['MODIFIED_BY']);
        $arUser = $user->Fetch();

        $arFeedForm = array(
            "ADD_AUTOR" => $arUser['NAME'].' '.$arUser['LAST_NAME'], // Autor name
            "ADD_DATE" => $arFields['DATE_ACTIVE_FROM'], //create date
            "ADD_WORK_COMPANY" => $arUser['WORK_COMPANY'],
            "REQUEST_URL" => "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=".$arFields['IBLOCK_ID']."&type=Requests&ID=".$arFields['ID'],
            "ADMIN_REQUEST_URL" => "/personal/order/?id=".$arFields['ID']
        );

        $rsAccType = CUserFieldEnum::GetList(array(), array(
            "ID" => $arUser['UF_ACC_TYPE'],
        ));
        if($arAccType = $rsAccType->GetNext())
        {
            $arFeedForm['ADD_AUTOR_ACC_TYPE'] = $arAccType["VALUE"]; //тип аккаунта автора
        }

        $blockID = $arFields['IBLOCK_ID'];
        $sectionId = $arFields['IBLOCK_SECTION'][0];
        if(CModule::IncludeModule("iblock"))
        {
            $statuses = null;
            $rsSection = CIBlockSection::GetList(
                array('SORT' => 'ASC'),
                array('IBLOCK_ID' => $blockID, 'ID' => $sectionId),
                false,
                array('NAME', 'UF_STATUSES', 'UF_EMAIL_TITLE'),
                false
            );
            if($arSection = $rsSection->GetNext())
            {
                $arFeedForm['SECTION_NAME'] = $arSection['NAME']; //тип заявки
                $arFeedForm['EMAIL_TITLE'] = $arSection['UF_EMAIL_TITLE']; //тип заявки
                $statuses = $arSection['UF_STATUSES'];
            }

            // получить номер заявки
            $arFilter = Array(
                "IBLOCK_ID"=> 3,
                "ACTIVE"=>"Y",
            );
            $res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array('nTopCount' => 2), Array("ID", "PROPERTY_ZAYAVKA_NUM"));
            while($ar_fields = $res->GetNext())
            {
                $arFeedForm['ADD_ID'] = $ar_fields["PROPERTY_ZAYAVKA_NUM_VALUE"] + 1;
            }
        }

        $arFilter = Array(
            Array(
                "ACTIVE" => "Y",
                Array(
                    "UF_IS_ADMIN"=>1,
                    "!UF_IS_GP"=>1
                )
            )
        );

        $res = Bitrix\Main\UserTable::getList(Array(
            "select"=>Array("ID","EMAIL"),
            "filter"=>$arFilter,
        ));

        $emails = '';
        while ($arRes = $res->fetch()) {
            $arFilter = Array('IBLOCK_ID'=>$blockID, 'GLOBAL_ACTIVE'=>'Y', "ID" => $sectionId, 'PERMISSIONS_BY' => $arRes['ID']);
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);

            while($ar_result = $db_list->GetNext())
            {
                if($emails != '')
                {
                    $emails .= ', ';
                }
                if ($arFeedForm['ADD_AUTOR_ACC_TYPE'] === 'Индивидуальный предприниматель' || $arFeedForm['ADD_AUTOR_ACC_TYPE'] === 'Юридическое лицо'){
                    if ($arRes['EMAIL'] === 'tpfl@nm-energy.ru'){
                        $new_email = '';
                    }else{
                        $new_email = $arRes['EMAIL'];
                    }
                }else{
                    if ($arRes['EMAIL'] === 'tpul@nm-energy.ru'){
                        $new_email = '';
                    }else{
                        $new_email = $arRes['EMAIL'];
                    }
                }
                $emails .= $new_email;
            }
        }

        $arFeedForm['EMAILS_TO'] = $emails;

        CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );

        $arSelect = Array("NAME", "ID");
        $arFilter = Array(
            "IBLOCK_ID" => 5,
            "ACTIVE_DATE"=>"Y",
            "ACTIVE"=>"Y",
            'IBLOCK_SECTION_ID' => $statuses,
            'PROPERTY_BEGIN_VALUE' => "Да"
        );
        $res = CIBlockElement::GetList(
            array('SORT' => 'ASC'),
            $arFilter,
            false,
            Array(),
            $arSelect
        );

        $PROP = array(
            'comment' => $arFields['PROPERTY_VALUES'][1]['VALUE']['TEXT']
        );
        if($ar_res = $res->GetNext())
        {
            $PROP["status"] = $ar_res["ID"];
        }

        // Добавляем нумерацию заявок
        if(!CModule::IncludeModule("iblock")) {
            CModule::IncludeModule("iblock");
        }
        $last_num = 1;

        $arFilter = Array(
            "IBLOCK_ID"=> 3,
            "ACTIVE"=>"Y",
        );
        $res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array('nTopCount' => 2), Array("ID", "PROPERTY_ZAYAVKA_NUM"));
        while($ar_fields = $res->GetNext())
        {
            $last_num = $ar_fields["PROPERTY_ZAYAVKA_NUM_VALUE"] + 1;
        }

        $arLoadProductArray = Array(
//      "NAME"    => 'Заявка на ТП № '.$arFields['ID'],
            "NAME"    => 'Заявка на ТП № '.$last_num,
//            "PROPERTY_VALUES"=> $PROP,
        );

        $el = new CIBlockElement;
        $res = $el->Update($arFields['ID'], $arLoadProductArray);

        CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array('ZAYAVKA_NUM' => $last_num));

        // Дата последней смены статуса
        $date_change_status = date('d.m.Y H:i') . '|' . $PROP["status"]; // Пишем дату создания и ИД статуса
        CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array('DATE_STATUS' => $date_change_status));
    }

    IBNewMessage($arFields);
}

function IBNewMessage($arFields)
{
    $SITE_ID = 's1';
    $IBLOCK_ID = 4; // Сообщения
    $by = "NAME";
    $order = "desc";

    if ($arFields['IBLOCK_ID'] == $IBLOCK_ID)
    {
        $blockID = 3;
        $elementID = $_GET['id'];
        $sectionId = $arFields['IBLOCK_SECTION'][0];
        $res = CIBlockElement::GetByID($elementID);
        if($ar_res = $res->GetNext())
        {
            $sectionId = $ar_res['IBLOCK_SECTION_ID'];
        }

        // Проверяем изменился ли статус - если ДА, то меняем дату
        $resStat = CIBlockElement::GetProperty($blockID, $elementID, array("sort" => "asc"),Array("CODE"=> "status"));
        if($ar_res_STAT = $resStat->GetNext())
        {
            // Статус установленный
            $thisStatus = $ar_res_STAT["VALUE"];
        }

        $resStat = CIBlockElement::GetProperty($blockID, $elementID, array("sort" => "asc"),Array("CODE"=> "DATE_STATUS"));
        if($ar_res_STAT = $resStat->GetNext())
        {
            // Статус установленный
            $oldStatus = explode('|',$ar_res_STAT["VALUE"])[1];

            if($oldStatus != $thisStatus) { // Если статусы не совпадают, переписываем - Дата последней смены статуса
                $date_change_status = date('d.m.Y H:i') . '|' . $thisStatus; // Пишем дату создания и ИД статуса
                CIBlockElement::SetPropertyValuesEx($elementID, false, array('DATE_STATUS' => $date_change_status));
            }
        }


        $user = CUser::GetByID($arFields['MODIFIED_BY']);
        $arUser = $user->Fetch();

        // получить номер заявки - новый
        $db_props = CIBlockElement::GetProperty($blockID, $arFields['PROPERTY_VALUES'][5], "sort", "asc", Array("CODE"=>"ZAYAVKA_NUM"));
        if($ar_props = $db_props->Fetch())
        {
            $zayavka_new_ID = $ar_props['VALUE'];
        }
        // получить ид статуса заявки - новый
        $db_props = CIBlockElement::GetProperty($blockID, $arFields['PROPERTY_VALUES'][5], "sort", "asc", Array("CODE"=>"status"));
        if($ar_props = $db_props->Fetch())
        {
            $statusId = $ar_props['VALUE'];
        }
        // получить статус заявки - новый
        $db_props = CIBlockElement::GetList([], ['IBLOCK_ID' =>5, 'ID' => $statusId], false, false, ['NAME', 'IBLOCK_ID']);
        if($ar_props = $db_props->Fetch())
        {
            $status = 'Текущий статус заявки: '.$ar_props['NAME'];
        }

        $arFeedForm = array(
//       "ADD_ID" => $arFields['PROPERTY_VALUES'][5], // Autor name
            "ADD_ID" => $zayavka_new_ID, // Autor name
            "STATUS" => $status, 
            "ADD_DATE" => $arFields['DATE_ACTIVE_FROM'], //create date
            "LK_URL" => "/personal/order/?id=".$arFields['PROPERTY_VALUES'][5],
            "EMAIL_FROM" => $arUser['EMAIL']
        );

        $STATUS_USER = 0; // это Заявитель

        if($arUser['UF_IS_ADMIN'] == 1 AND $arUser['UF_IS_GP'] != 1) { // это СО
            $STATUS_USER = 1;
        } elseif ($arUser['UF_IS_ADMIN'] == 1 AND $arUser['UF_IS_GP'] == 1) { // это ГП
            $STATUS_USER = 2;
        }

        switch ($STATUS_USER) {
            case 0: // это Заявитель
                $EVEN_TYPE = 'NEW_MESSAGE_IN_REQUEST';
                $arFilter = Array(
                    Array(
                        "ACTIVE" => "Y",
                        Array(
                            "UF_IS_ADMIN"=>1,
                            "!UF_IS_GP"=>1
                        )
                    )
                );

                $res = Bitrix\Main\UserTable::getList(Array(
                    "select"=>Array("ID","EMAIL"),
                    "filter"=>$arFilter,
                ));

                CModule::IncludeModule("iblock");
                $emails = '';
                while ($arRes = $res->fetch()) {
                    $arFilter = Array('IBLOCK_ID'=>$blockID, 'GLOBAL_ACTIVE'=>'Y', "ID" => $sectionId, 'PERMISSIONS_BY' => $arRes['ID']);
                    $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);

                    while($ar_result = $db_list->GetNext())
                    {
                        if($emails != '')
                        {
                            $emails .= ', ';
                        }
                        $emails .= $arRes['EMAIL'];
                    }
                }
                $arFeedForm['EMAILS_TO'] = $emails;
                $_ID_FOR_GP = $arFields['PROPERTY_VALUES'][5];

                CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );
                MessageForGP($_ID_FOR_GP, $SITE_ID, $arFeedForm, $EVEN_TYPE);

                break;
            case 1: // это СО
                $res = CIBlockElement::GetByID($arFields['PROPERTY_VALUES'][5]);
                if($ar_res = $res->GetNext())
                {
                    $arFields = $ar_res;
                }
                $user = CUser::GetByID($arFields['CREATED_BY']);
                $arUser = $user->Fetch();
                $EVEN_TYPE = 'USERS_NEW_MESSAGE_IN_REQUEST';
                $arFeedForm['EMAIL_TO'] = $arUser['EMAIL'];

                $_ID_FOR_GP = $arFields['ID'];

                CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );
                MessageForGP($_ID_FOR_GP, $SITE_ID, $arFeedForm, $EVEN_TYPE);

                break;
            case 2: // это ГП
                $EVEN_TYPE = 'NEW_MESSAGE_IN_REQUEST_FROM_GP';
                $arFilter = Array(
                    Array(
                        "ACTIVE" => "Y",
                        Array(
                            "UF_IS_ADMIN"=>1,
                            "!UF_IS_GP"=>1
                        )
                    )
                );

                $res = Bitrix\Main\UserTable::getList(Array(
                    "select"=>Array("ID","EMAIL"),
                    "filter"=>$arFilter,
                ));

                CModule::IncludeModule("iblock");
                $emails = '';
                while ($arRes = $res->fetch()) {
                    $arFilter = Array('IBLOCK_ID'=>$blockID, 'GLOBAL_ACTIVE'=>'Y', "ID" => $sectionId, 'PERMISSIONS_BY' => $arRes['ID']);
                    $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);

                    while($ar_result = $db_list->GetNext())
                    {
                        if($emails != '')
                        {
                            $emails .= ', ';
                        }
                        $emails .= $arRes['EMAIL'];
                    }
                }
                $arFeedForm['EMAILS_TO'] = $emails;

                CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );

                // письмо ушло для СО, теперь отправим еще Заявителю

                $res = CIBlockElement::GetByID($arFields['PROPERTY_VALUES'][5]);
                if($ar_res = $res->GetNext())
                {
                    $arFields = $ar_res;
                }
                $user = CUser::GetByID($arFields['CREATED_BY']);
                $arUser = $user->Fetch();
                $EVEN_TYPE = 'NEW_MESSAGE_IN_REQUEST_FROM_GP';
                $arFeedForm['EMAILS_TO'] = $arUser['EMAIL'];

                CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );
                break;
        }

//       CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm );
//       MessageForGP($_ID_FOR_GP, $SITE_ID, $arFeedForm, $EVEN_TYPE);
    }
}

// test
function MessageForGP($_elem_ID, $SITE_ID, $arFeedForm, $EVEN_TYPE) { // ид заявки

    $_IBLOCK_ZAYV = 3; // заявки

    CModule::IncludeModule('iblock');

// Делаем поиск статуса по нашей заявке
    $zayavka = CIBlockElement::GetList(array('id' => $_elem_ID,"SORT"=>"ASC"), array('ACTIVE' => 'Y', 'IBLOCK_ID' =>  $_IBLOCK_ZAYV, 'ID' => $_elem_ID), false, false,
        Array("NAME", "ID", "PROPERTY_status", "IBLOCK_SECTION_ID")
    );

    while($new_zayavka = $zayavka->GetNextElement())
    {
        $ar_res = $new_zayavka->GetFields();
        $_status_value = $ar_res["PROPERTY_STATUS_VALUE"]; // получили ИД статуса - 511
    }

// Делаем проверку статуса на чекбокс - отправить ГП
    $_IBLOCK_STATUS = 5;
    $_alert_gp = ''; // "Да"
    $_status_id = '';

    $zayavkas = CIBlockElement::GetList(array('id' => $_status_value,"SORT"=>"ASC"), array('ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' =>  $_IBLOCK_STATUS, 'ID' => $_status_value), false, false,
        Array("NAME", "ID", "PROPERTY_alert_gp")
    );

    while($new_zayavkas = $zayavkas->GetNextElement())
    {
        $ar_res_2 = $new_zayavkas->GetFields();

        $_alert_gp = $ar_res_2["PROPERTY_ALERT_GP_VALUE"]; // получили значение чекбокса ГП
        $_status_id = $ar_res_2["ID"]; // получили ИД статуса - 511
        $_section_id_zayvaka = $ar_res["IBLOCK_SECTION_ID"]; // получили ИД раздела - 12
    }

    if($_alert_gp == "Да" OR $_status_id == 511) { // Если чекбокс - ДА или статус Ожидание действия ГП
        // получаем пользоватеей группы ГП
//        $filter = Array("GROUPS_ID" => Array(14)); // ID - 14 - Гарантирующий поставщик
//        $rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
        $by = "NAME";
        $order = "desc";

        $emailsGP = '';
        $arFilter = Array(
            Array(
                "ACTIVE" => "Y",
                Array(
                    "UF_IS_GP"=>1
                )
            )
        );

        $res = Bitrix\Main\UserTable::getList(Array(
            "select"=>Array("ID","EMAIL"),
            "filter"=>$arFilter,
        ));

        while ($arRes = $res->fetch()) {
            $arFilter = Array('IBLOCK_ID' => $_IBLOCK_ZAYV, 'GLOBAL_ACTIVE' => 'Y', "ID" => $_section_id_zayvaka, 'PERMISSIONS_BY' => $arRes['ID']);
            $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, false);

            while ($ar_result = $db_list->GetNext()) {
                if ($emailsGP != '') {
                    $emailsGP .= ', ';
                }
                $emailsGP .= $arRes['EMAIL'];
            }
        }
        $arFeedForm['EMAILS_TO'] = $emailsGP; // запишем почту ГП

        // проверим $EVEN_TYPE и переприсвоим на свой для ГП
        $EVEN_TYPE_GP = '';
        switch ($EVEN_TYPE) {
            case 'USERS_NEW_MESSAGE_IN_REQUEST': // если писал админ
                $EVEN_TYPE_GP = 'NEW_MESSAGE_IN_REQUEST_FOR_GP';
                break;
            case 'NEW_MESSAGE_IN_REQUEST':
                $EVEN_TYPE_GP = 'USERS_NEW_MESSAGE_IN_REQUEST_FOR_GP';
                break;
        }

        CEvent::Send($EVEN_TYPE_GP, $SITE_ID, $arFeedForm );
    }
}

// function custom_mail($to, $subject, $message, $additional_headers='', $additional_parameters='')
// {
// 	//AddMessage2Log(
// 	//	'To: '.$to.PHP_EOL.
// 	//	'Subject: '.$subject.PHP_EOL.
// 	//	'Message: '.$message.PHP_EOL.
// 	//	'Headers: '.$additional_headers.PHP_EOL.
// 	//	'Params: '.$additional_parameters.PHP_EOL
// 	//);
// 	$emailFrom = COption::GetOptionString('main','email_from');
// 	$headers = "From: " . $emailFrom . "\r\n";
// 	$headers .= "Reply-To: ". $emailFrom . "\r\n";
// 	$headers .= "CC: info@site.ru\r\n";
// 	$headers .= "MIME-Version: 1.0\r\n";
// 	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// 	mail($to, $subject, $message, $headers);
// 	mail($copy, $subject, $message, $headers);
// }

\Bitrix\Main\EventManager::getInstance()->addEventHandler('main', 'OnBeforePhpMail', function(\Bitrix\Main\Event $event) {
    $object  = $event->getParameter('arguments');
    $headers = $object->additional_headers;
    $eol = \Bitrix\Main\Mail\Mail::getMailEol();
    $headers = explode($eol, $headers);
    foreach ($headers as $i => $headerItem) {
        [$header, $value] = explode(':', $headerItem, 2);
        if ($header === 'To') {
            $value = trim($value);
            if (stripos($value, $object->to) !== false) {
                $object->to = $value;
            } else {
                $object->to .= ',' . $value;
            }
            unset($headers[$i]);
            break;
        }
    } 
    $object->additional_headers = implode($eol, $headers);
});

function custom_mail($to, $subject, $message, $additional_headers, $additional_parameters, $context)
{
    $additional_headers .= 'From: noreply@nm-energlk.ru' . "\r\n";
//    $additional_headers .= 'Return-Path: noreply@nm-energlk.ru' . "\r\n";
//    $additional_headers .= 'Reply-To: noreply@nm-energlk.ru' . "\r\n";
    $mailer       = new \PHPMailer\PHPMailer\PHPMailer();
    $dkim_headers = $mailer->DKIM_Add($additional_headers, $subject, $message);

    $additional_headers = \PHPMailer\PHPMailer\PHPMailer::stripTrailingWSP($additional_headers)
        . \PHPMailer\PHPMailer\PHPMailer::CRLF
        . \PHPMailer\PHPMailer\PHPMailer::normalizeBreaks($dkim_headers);

    $mailer = new \Bitrix\Main\Mail\Smtp\Mailer();

    //Send using SMTP
    $mailer->isSMTP();
//    $mailer->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_LOWLEVEL;
    $mailer->Host       = 'smtp.timeweb.ru';                                           //Set the SMTP server to send through
    $mailer->SMTPAuth   = true;                                                        //Enable SMTP authentication
    $mailer->Username   = 'noreply@nm-energlk.ru';                                     //SMTP username
    $mailer->Password   = '1cyeuPB5';                                                  //SMTP password
    $mailer->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mailer->Port       = 465;                                                         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $success = $mailer->sendMailBySmtp($to, $subject, $message, $additional_headers, $additional_parameters);
//    $success = mail($to, $subject, $message, $additional_headers, $additional_parameters);
    return $success;
}

