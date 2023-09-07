<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/core/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/core/autoloader.php';
use lib\core\src\helpers\RequestHelper;

$helper = new RequestHelper();

$userType = $helper->getValById($userInfo['UF_ACC_TYPE']); // тип пользователя: юр/физ/пр.п лицо
if(!$userInfo['PERSONAL_ZIP']) {
    $userInfo['PERSONAL_ZIP'] = $userInfo['WORK_ZIP'];
}

$factAddr = 'Почтовый индекс '.$userInfo['PERSONAL_ZIP'] .
    ', Область ' . $userInfo['PERSONAL_STATE'] . ', Район ' .
    explode(',',$userInfo['PERSONAL_CITY'])[0] .
    ', Населенный пункт ' .
    trim(explode(',',$userInfo['PERSONAL_CITY'])[1]) .
    ', Улица ' .
    explode(',',$userInfo['PERSONAL_STREET'])[0] .
    ', Дом ' .
    explode(',',$userInfo["PERSONAL_STREET"])[1] .
    ', Офис / кв ' .
    explode(',',$userInfo["PERSONAL_STREET"])[2]
;



$document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/lib/core/svishe_150_ur.docx');

    if($userType == 'Физическое лицо') {
        $document->setValue('userType', '');

//    $document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/lib/core/svishe_150_fi.docx');
        $document->setValue('egr', '-');
    } elseif($userType == 'Юридическое лицо') {
        $usType = $helper->getValById($userInfo['UF_ORGANIZATION_TYPE']);
        $document->setValue('userType', $usType . ' ' . $userInfo['WORK_COMPANY']);
        $document->setValue('egr', $userInfo['UF_ORGN'] ? $userInfo['UF_ORGN'] : $userInfo['UF_GRNIP']);

        $factAddr = 'Почтовый индекс '.$userInfo['PERSONAL_ZIP'] .
            ', Область ' . $userInfo['WORK_STATE'] . ', Район ' .
            explode(',',$userInfo['WORK_CITY'])[0] .
            ', Населенный пункт ' .
            trim(explode(',',$userInfo['WORK_CITY'])[1]) .
            ', Улица ' .
            explode(',',$userInfo['WORK_STREET'])[0] .
            ', Дом ' .
            explode(',',$userInfo["WORK_STREET"])[1] .
            ', Офис / кв ' .
            explode(',',$userInfo["WORK_STREET"])[2]
        ;
        if($userInfo['UF_POSTAL_COINC'] == '0') {
            $factAddr = 'Почтовый индекс '.$userInfo['PERSONAL_ZIP'] .
                ', Область ' . $userInfo['PERSONAL_STATE'] . ', Район ' .
                explode(',',$userInfo['PERSONAL_CITY'])[0] .
                ', Населенный пункт ' .
                trim(explode(',',$userInfo['PERSONAL_CITY'])[1]) .
                ', Улица ' .
                explode(',',$userInfo['PERSONAL_STREET'])[0] .
                ', Дом ' .
                explode(',',$userInfo["PERSONAL_STREET"])[1] .
                ', Офис / кв ' .
                explode(',',$userInfo["PERSONAL_STREET"])[2]
            ;
        }
    } else {
        $document->setValue('userType', 'Индивидуальный предприниматель');
//    $document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/lib/core/svishe_150_ip.docx');
        $document->setValue('egr', $userInfo['UF_ORGN'] ? $userInfo['UF_ORGN'] : $userInfo['UF_GRNIP']);
        $factAddr = 'Почтовый индекс '.$userInfo['PERSONAL_ZIP'] .
            ', Область ' . $userInfo['WORK_STATE'] . ', Район ' .
            explode(',',$userInfo['WORK_CITY'])[0] .
            ', Населенный пункт ' .
            trim(explode(',',$userInfo['WORK_CITY'])[1]) .
            ', Улица ' .
            explode(',',$userInfo['WORK_STREET'])[0] .
            ', Дом ' .
            explode(',',$userInfo["WORK_STREET"])[1] .
            ', Офис / кв ' .
            explode(',',$userInfo["WORK_STREET"])[2]
        ;
        if($userInfo['UF_POSTAL_COINC'] == '0') {
            $factAddr = 'Почтовый индекс '.$userInfo['PERSONAL_ZIP'] .
                ', Область ' . $userInfo['PERSONAL_STATE'] . ', Район ' .
                explode(',',$userInfo['PERSONAL_CITY'])[0] .
                ', Населенный пункт ' .
                trim(explode(',',$userInfo['PERSONAL_CITY'])[1]) .
                ', Улица ' .
                explode(',',$userInfo['PERSONAL_STREET'])[0] .
                ', Дом ' .
                explode(',',$userInfo["PERSONAL_STREET"])[1] .
                ', Офис / кв ' .
                explode(',',$userInfo["PERSONAL_STREET"])[2]
            ;
        }
    }


    $document->setValue('factAddr', $factAddr);
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $fonts = array(
        'size' => 11,
        'name' => 'Times New Roman',
        'afterSpacing' => 0,
        'Spacing' => 0,
        'cellMargin' => 0
    );


    $styleCell = array(
        'borderColor' =>'000000',
//    'borderSize' => 4,
        'borderBottomSize' => 4,
//    'borderTopSize'=>1 ,
//    'borderTopColor' =>'red',
//    'borderLeftSize'=>1,
//    'borderLeftColor' =>'red',
//    'borderRightSize'=>1,
//    'borderRightColor'=>'red',
//    'borderBottomSize' =>1,
//    'borderBottomColor'=>'red'
    );


    if(!$fieldsFill['FIO'] and $userInfo['UF_HEAD_SURNAME']) {
        $fieldsFill['FIO'] = $userInfo['UF_HEAD_SURNAME'] . ' ' . $userInfo['UF_HEAD_NAME'] . ' ' . $userInfo['UF_HEAD_MIDDLE'];
    }
 
    if(!$fieldsFill['FIO']) {
        $fieldsFill['FIO'] = $userInfo['LAST_NAME'] . ' ' . $userInfo['NAME'] . ' ' . $userInfo['SECOND_NAME'];
    }

    //Номер заявки
    $document->setValue('order_num', $order_num+1);

    $document->setValue('name', $fieldsFill['FIO']);


    $document->setValue('passSer', $userInfo['UF_PASSPORT_SERIAL']);
    $document->setValue('passNum', $userInfo['UF_PASSPORT_NUM']);
    $document->setValue('passWhoWhen', $userInfo['UF_PASSPORT_DATE'] . ' ' . $userInfo['UF_PASSPORT_FROM']);


    $document->setValue('factAddr', $factAddr);
    $document->setValue('postIndex', '');
    $document->setValue('vSvaz', implode(', ', (array)($fieldsFill['REQUEST_REASONS'] ?? [])));

    $document->setValue('prositOsush', '');
    $document->setValue('fullNameEnDev', $fieldsFill['CONNECT_DEVICE_NAME']);
    $document->setValue('raspoloshen', $fieldsFill['ADDR_EL_DEVICE']);
    $document->setValue('pointCount', $fieldsFill['POINT_CONNECT_COUNT']);
    $document->setValue('opisSushSeti', $fieldsFill['POINT_CONNECT_COUNT']);

    $sum = 0;
    $tochText = '';
    foreach ($fieldsFill['MAX_POWER_EN_GET_DEVICE'] as $k=>$toch) {
        $sum += (int)$toch;
        $tochText .= 'Точка '.($k+1).' - '.$toch . ' кВт; ';
    }
    $document->setValue('m1', $sum);
$document->setValue('m1P', $tochText);
$document->setValue('m9', $fieldsFill['EN_GET_DEVICE_BEFORE_POWER_B'].' кВ');

$sum = 0;
    $tochText = '';

    $section = $phpWord->createSection();
    $table = $section->addTable();
    foreach ($fieldsFill['MAX_P_USHE_P'] as $k=>$toch) {
        $sum += (int)$toch;
        $tochText .= 'Точка '.($k+1).' - '.$toch . ' кВт - ' . $fieldsFill['POWER_B'] . '; ';

//    $table->addRow();
//    $table->addCell(1000, $styleCell)->addText('Точка '.($k+1).' '.$toch . ' кВт', $fonts);
//    $table->addCell(250, [])->addText(' - ', $fonts);
//    $table->addCell(1000, $styleCell)->addText($fieldsFill['POWER_B'], $fonts);
    }
    $document->setValue('m2', $sum);
    $document->setValue('m2k', $fieldsFill['POWER_B'].' кВ');

//    var_dump($filePdf);die;

    $document->setValue('mm2', $tochText);

    $sum = 0;
    $tochText = '';
    $section = $phpWord->createSection();
    $table = $section->addTable();
    foreach ($fieldsFill['MAX_P_RANEE_P'] as $k=>$toch) {
        $sum += (int)$toch;
        $tochText .= 'Точка '.($k+1).' - '.$toch . ' кВт - ' . $fieldsFill['BEFORE_POWER_B'] . '; ';
//    $table->addRow();
//    $table->addCell(1000, $styleCell)->addText('Точка '.($k+1).' '.$toch . ' кВт', $fonts);
//    $table->addCell(250, [])->addText(' - ', $fonts);
//    $table->addCell(1000, $styleCell)->addText($fieldsFill['BEFORE_POWER_B'], $fonts);
    }

    $document->setValue('mB', $sum);
    $document->setValue('mBk', $fieldsFill['BEFORE_POWER_B'].' кВ');
    $document->setValue('m3p', $tochText);
//$document->setComplexBlock('m3p', $table);

//$sumToch = 0;
//foreach ($fieldsFill['MAX_P_USHE_P'] as $mU) {
//    $sumToch += $mU;
//}


    $toch = '';
    foreach ($fieldsFill['MAX_P_USHE_P'] as $k=>$mU) {
        $toch .= $k . ') ' . $mU . ';';
    }

    $document->setValue('m2P', $toch);



//$sumToch = 0;
//foreach ($fieldsFill['MAX_P_RANEE_P'] as $mU) {
//    $sumToch += $mU;
//}


    $document->setValue('tansC', $fieldsFill['TRNASFOR_COUNT']);
    $document->setValue('genPowerAcount', $fieldsFill['GENERATOR_COUNT']);


    $document->setValue('c1', $fieldsFill['NADEZNOST_DIVECE_I']);
    $document->setValue('c2', $fieldsFill['NADEZNOST_DIVECE_II']);
    $document->setValue('c3', $fieldsFill['NADEZNOST_DIVECE_III']);

    $document->setValue('zayavCharNagr', $fieldsFill['ZAYAV_CHAR_NAGR']);
    $document->setValue('velAosobenostTechM', $fieldsFill['VAL_TECH_MIN']);
    $document->setValue('neobhNalTechOrAviaBron', $fieldsFill['NEOB_NAL_T_A_BRON']);
    $document->setValue('velAndObsTexhAvaBr', $fieldsFill['VAL_TECH_MIN2']);

    $styleCell = array(
        'borderColor' =>'000000',
        'borderSize' => 4,
    );
    $section = $phpWord->createSection();
    $table = $section->addTable();
    $table->addRow();
    $table->addCell(2500, $styleCell)->addText('Этап
(очередь) строительства', $fonts);
    $table->addCell(2500, $styleCell)->addText('Планируемый срок проектирования энергопринимающих устройств
(месяц, год)', $fonts);
    $table->addCell(2500, $styleCell)->addText('Планируемый срок введения энергопринимающих устройств в эксплуатацию
(месяц, год)', $fonts);
    $table->addCell(2500, $styleCell)->addText('Максимальная мощность энергопринимающих устройств
(кВт)', $fonts);
    $table->addCell(2500, $styleCell)->addText('Категория надежности энергопринимающих устройств', $fonts);

//$document->setValue('tabEtaps', $table);
    foreach ($fieldsFill['SROK_PROEKT'] as $k=>$strok) {
        $table->addRow();
        $table->addCell(2500, $styleCell)->addText($k+1, $fonts);
        $table->addCell(2500, $styleCell)->addText($strok, $fonts);
        $table->addCell(2500, $styleCell)->addText($fieldsFill['SROK_VVED'][$k], $fonts);
        $table->addCell(2500, $styleCell)->addText($fieldsFill['MAX_P'][$k], $fonts);
        $table->addCell(2500, $styleCell)->addText($fieldsFill['ZAYAV_CAT_NAD'][$k], $fonts);
    }

    $document->setComplexBlock('tabEtaps', $table);

//$document->setValue('garPostZaklDog', $fieldsFill['GP_NAME']);
    $document->setValue('garPostZaklDog', 'Нарьян-Марская электростанция');
    $docList = '';
    if($fieldsFill['DOC_COPY_PRAVO_SOB']) {
        $docList .= 'Копия документа, подтверждающая право собственности; ';
    }
    if($fieldsFill['VIPISKA_EGR']) {
        $docList .= 'Выписка из Единого государственного реестра; ';
    }
    if($fieldsFill['PLAN_DEVICE']) {
        $docList .= 'План расположения энергопринимающих устройств; ';
    }
    if($fieldsFill['COPY_DOC_SOGL_KV']) {
        $docList .= 'Копия документа, подтверждающего согласие организации, осуществляющей управление многоквартирным домом; ';
    }
    if($fieldsFill['PASSPORT_COPY']) {
        $docList .= 'Копия паспорта;';
    }
    $document->setValue('docList', $docList);

    if($userType == 'Физическое лицо') {
        $document->setValue('rukDol', '');
    } else {
        $document->setValue('rukDol', $userInfo['UF_DOL_RUK']);
    }

    $document->setValue('day', date('d'));
    $document->setValue('month', date('m'));
    $document->setValue('year_sh', date('y'));
    $document->setValue('rukTel', $userInfo['WORK_PHONE']);
    $document->setValue('rukName', $fieldsFill['FIO']);

    if ($fieldsFill['MAP_POINT']) {
        $coordArray = explode(':', $fieldsFill['MAP_POINT']);
        $coord = $coordArray[1].','.$coordArray[0];
        $document->setImageValue('map_img', array('path' => 'https://static-maps.yandex.ru/1.x/?ll='.$coord.'&size=450,450&z=17&l=map&pt='.$coord.',pm2orgm', 'width' => 450, 'height' => 450, 'ratio' => false));
    }

    $document->saveAs($filePdf);


