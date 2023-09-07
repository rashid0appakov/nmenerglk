<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/core/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/core/autoloader.php';
use lib\core\src\helpers\RequestHelper;
$helper = new RequestHelper();
$userType = $helper->getValById($userInfo['UF_ACC_TYPE']); // тип пользователя: юр/физ/пр.п лицо
if($userType == 'Физическое лицо') {
    $document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/lib/core/fl_ot_15_do150.docx');
} else {
    $document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/lib/core/ur_ot_15_do150.docx');
}
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$fonts = array(
    'size' => 11,
    'name' => 'Times New Roman',
    'afterSpacing' => 0,
    'Spacing' => 0,
    'cellMargin' => 0
);
$replaceArray = [
    'MAX_POWER_CONNECT', 'MAX_BEFORE_POWER_B', 'MAX_POWER_EN_GET_DEVICE', 'SUCH_POWER_OBJECT', 'MAX_P_RANEE_P', 'MAX_P_USHE_P', 'MAX_P', 'MAX_POWER_R_DEVICE', 'MAX_POWER_EN_GET_DEVICE2'
];
foreach ($replaceArray as $value) {
    if (!isset($fieldsFill[$value])) {
        continue;
    }
    switch ($value) {
        case 'MAX_POWER_EN_GET_DEVICE':
        case 'MAX_P_RANEE_P':
        case 'MAX_P_USHE_P':
        case 'MAX_P':
            foreach ($fieldsFill[$value] as $k => $item) {
                $fieldsFill[$value][$k] = str_replace('.', ',', $item);
            }
            break;
        default:
            $fieldsFill[$value] = str_replace('.', ',', $fieldsFill[$value]);
            break;
    }
}

$styleCell = array('borderColor' =>'000000','borderBottomSize' => 4,);

//Номер заявки
$document->setValue('order_num', $order_num+1);

$document->setValue('inn', $userInfo['UF_INN']);
$document->setValue('kpp', $userInfo['UF_KPP']);
$document->setValue('phone', $userInfo['WORK_PHONE']);
$document->setValue('email', $userInfo['EMAIL']);
$document->setValue('fax', $userInfo['WORK_FAX']);
$document->setValue('date', date('d.m.Y'));

$document->setValue('rukName', $userInfo['UF_HEAD_SURNAME'] . ' ' . $userInfo['UF_HEAD_NAME'] . ' ' . $userInfo['UF_HEAD_MIDDLE']);
$document->setValue('rukTel', $userInfo['WORK_PHONE']);
$document->setValue('rukDol', $userInfo['UF_DOL_RUK']);


$document->setValue('doc', 'Паспорт');

$document->setValue('passSer', $userInfo['UF_PASSPORT_SERIAL']);
$document->setValue('passNum', $userInfo['UF_PASSPORT_NUM']);
$document->setValue('passWho', $userInfo['UF_PASSPORT_FROM']);
$document->setValue('passWhen', $userInfo['UF_PASSPORT_DATE']);
if(!$userInfo['PERSONAL_ZIP']) {
    $userInfo['PERSONAL_ZIP'] = $userInfo['WORK_ZIP'];
}
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

$document->setValue('factAddr', $factAddr);
$document->setValue('postAddr', $factAddr);

if($userInfo['UF_POSTAL_COINC'] != 1) {
    // галка, не совпадает адрес
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
$document->setValue('urAddr', $factAddr);

$document->setValue('periodFrom', $fieldsFill['TIME_SCHEME_FROM']);
$document->setValue('periodTo', $fieldsFill['TIME_SCHEME_TO']);

$document->setValue('name', $userInfo['LAST_NAME'] . ' ' . $userInfo['NAME'] . ' ' . $userInfo['SECOND_NAME']);

//$document->setValue('cSh', $fieldsFill['CONNECT_SCHEMA']);
if($fieldsFill['CONNECT_SCHEMA']) {
    $document->setValue('cSh', $fieldsFill['CONNECT_SCHEMA'] === 'По постоянной схеме' ? 'X' : '');
    $document->setValue('r1', $fieldsFill['CONNECT_SCHEMA'] !== 'По постоянной схеме' ? 'X' : '');
} else {
    $document->setValue('cSh', '');
    $document->setValue('r1', '');
}

$reasons = $fieldsFill['REQUEST_REASONS'];

if(!$reasons) {
    $reasons = array($fieldsFill['REQUEST_REASON']);
}



$reasonsAvali = [
//    'r1' => 'Подключение к электрической сети с электроснабжением',
    'r22' => 'Новое технологическое присоединение',
    'r2' => 'Увеличение максимальной мощности потребления',
    'r3' => 'Изменение точки присоединения',
    'r4' => 'Изменение схемы присоединения',
    'r5' => 'Изменение уровня напряжения',
];

if($userType == 'Физическое лицо') {
    $objectName = $fieldsFill['NAME_OBJECT_CONNECTION'];
    $objectsAvali = [
        'n1' => 'Гаражный бокс',
        'n2' => 'Индивидуальный жилой дом',
        'n3' => 'Индивидуальная баня',
        'n4' => 'Нежилое помещение',
        'n5' => 'Участок строительства ИЖД',
        'n6' => 'Участок строительства бани',
        'n7' => 'Иное',
    ];

    foreach ($objectsAvali as $k=>$oN) {
        if($oN == $objectName) {
            if($k == 'n7') {
                $document->setValue($k, $fieldsFill['ANOTHER']);
            } else {
                $document->setValue($k, 'X');
            }
        } else {
            $document->setValue($k, '');
        }
    }

    $reasonsAvali = [
        'r2' => 'Новое технологическое присоединение',
        'r3' => 'Увеличение максимальной мощности потребления',
        'r4' => 'Изменение точки присоединения',
        'r5' => 'Изменение схемы присоединения',
        'r6' => 'Изменение уровня напряжения',
    ];

}


foreach ($reasonsAvali as $k=>$rA) {
    $res = '';
    foreach ($reasons as $reason) {
        if($reason == $rA) {
            $res = 'X';
        }
    }

    $document->setValue($k, $res);
}


$document->setValue('r6', $fieldsFill['NAME_OBJECT_CONNECTION']);

$document->setValue('egr', $userInfo['UF_ORGN'] ? $userInfo['UF_ORGN'] : $userInfo['UF_GRNIP']);
$document->setValue('egrn', $userInfo['UF_ORGN'] ? $userInfo['UF_ORGN'] : $userInfo['UF_GRNIP']);

if($userType !== 'Физическое лицо' and $userType != 'Юридическое лицо') {
    // ИП
    if(!$userInfo['UF_HEAD_SURNAME']) {
        $document->setValue('userType', 'ИП ' . $userInfo['LAST_NAME'] . ' ' . $userInfo['NAME'] . ' ' . $userInfo['SECOND_NAME']);
    } else {
        $document->setValue('userType', 'ИП ' . $userInfo['UF_HEAD_SURNAME'] . ' ' . $userInfo['UF_HEAD_NAME'] . ' ' . $userInfo['UF_HEAD_MIDDLE']);
    }
} else {
    $document->setValue('userType', $helper->getValById($userInfo['UF_ORGANIZATION_TYPE']) . ' ' . $userInfo['WORK_COMPANY']);
}

$document->setValue('addrEd', $fieldsFill['ADDR_EL_DEVICE']);
$document->setValue('poiC', $fieldsFill['POINT_CONNECT_COUNT']);

//$poinCp = implode('/', $fieldsFill['MAX_P_RANEE_P']);
//$document->setValue('poinCp', $poinCp);
$section = $phpWord->createSection();
$table = $section->addTable();
foreach ($fieldsFill['MAX_P_RANEE_P'] as $k=>$toch) {
    $table->addRow();
    if($fieldsFill['BEFORE_POWER_B']) {
        $table->addCell(1000, $styleCell)->addText('Точка '.($k+1).' '.$toch, $fonts);
        $table->addCell(250, [])->addText(', кВт: ', $fonts);
        $table->addCell(1000, $styleCell)->addText($fieldsFill['BEFORE_POWER_B'].' кВ', $fonts);
    } else {
        $table->addCell(1000, $styleCell)->addText('Точка '.($k+1).' '.$toch.' кВт', $fonts);
    }
}

$document->setComplexBlock('poinCp', $table);

$document->setValue('sPo', $fieldsFill['SUCH_POWER_OBJECT'] ? $fieldsFill['SUCH_POWER_OBJECT'] : $fieldsFill['SUCH_POWER_OBJECT']);
$document->setValue('zCn', implode('/', (array)($fieldsFill['ZAYAV_CAT_NAD'] ?? [])));

$document->setValue('tDn', $fieldsFill['R_V_TECH_USLOV'] ? $fieldsFill['R_V_TECH_USLOV'] : '-' . '; ');
$document->setValue('tDd', $fieldsFill['R_V_TECH_USLOV_DATE'] ? $fieldsFill['R_V_TECH_USLOV_DATE'] : '-' . '; ');
$document->setValue('tDno', $fieldsFill['R_V_TECH_USLOV_LITS'] ? $fieldsFill['R_V_TECH_USLOV_LITS'] : '-' . '; ');

if($fieldsFill['POWER_LEVEL'] == '0,22 кВ') {
    $document->setValue('pL1', 'X');
} else {
    $document->setValue('pL1', '');
}
if($fieldsFill['POWER_LEVEL'] == '0,4 кВ') {
    $document->setValue('pL2', 'X');
} else {
    $document->setValue('pL2', '');
}
if($fieldsFill['POWER_LEVEL'] == '6,3 кВ') {
    $document->setValue('pL3', 'X');
} else {
    $document->setValue('pL3', '');
}


$document->setValue('aEd', $fieldsFill['ADDR_EL_DEVICE']);
$document->setValue('maxPc', $fieldsFill['MAX_POWER_CONNECT'] ? $fieldsFill['MAX_POWER_CONNECT'] : '-');
$document->setValue('maxPcB', $fieldsFill['MAX_POWER_CONNECT'] ? $fieldsFill['POWER_B'].' кВ' : '-');


$document->setValue('maxPcBe', $fieldsFill['MAX_BEFORE_POWER_B']);
$document->setValue('maxPcBeB', $fieldsFill['BEFORE_POWER_B'].' кВ');

if($userType == 'Физическое лицо') {

}
$document->setValue('maxPenGd', $fieldsFill['MAX_POWER_EN_GET_DEVICE'][0]);
$document->setValue('maxPenGdB', $fieldsFill['EN_GET_DEVICE_BEFORE_POWER_B'].' кВ');


if ($fieldsFill['MAP_POINT']) {
    $coordArray = explode(':', $fieldsFill['MAP_POINT']);
    $coord = $coordArray[1].','.$coordArray[0];
    $document->setImageValue('map_img', array('path' => 'https://static-maps.yandex.ru/1.x/?ll='.$coord.'&size=450,450&z=17&l=map&pt='.$coord.',pm2orgm', 'width' => 450, 'height' => 450, 'ratio' => false));
}


$document->saveAs($filePdf);