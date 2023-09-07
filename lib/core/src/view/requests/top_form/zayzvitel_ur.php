<div class="form__row">
    <div class="form__col form__col_full">
        <div class="seconfary-title form__row_title">
            Данные заявителя
        </div>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Тип организационно-правовой формы
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$helper->getValById($userInfo['UF_ORGANIZATION_TYPE'])?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Полное наименование заявителя
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['WORK_COMPANY']?>" disabled>
    </div>
</div>

<?
//$factAddr = $userInfo['WORK_ZIP'] . ', ' . $userInfo['PERSONAL_CITY'] . ', ' .
//    $userInfo['PERSONAL_STATE'] . ', ' .
//    $userInfo['PERSONAL_STREET'];
$factAddr = [];
$factAddr['z'] = $userInfo['WORK_ZIP'];
$factAddr['p_c'] = $userInfo['PERSONAL_CITY'];
$factAddr['p_state'] = $userInfo['PERSONAL_STATE'];
$factAddr['p_street'] = explode(',',$userInfo['PERSONAL_STREET'])[0];
$factAddr['office'] = explode(',',$userInfo['PERSONAL_STREET'])[1];
$factAddr['kv'] = explode(',',$userInfo['PERSONAL_STREET'])[2];
$factAddr['WORK_CITY_2'] = $userInfo['PERSONAL_CITY'];


//$urAddr = $userInfo['PERSONAL_ZIP'] . ', ' . $userInfo['WORK_STATE'] . ', ' . $userInfo['WORK_CITY'] . ', ' .
//    $userInfo['WORK_STREET'];
$urAddr = [];
$urAddr['z'] = $userInfo['PERSONAL_ZIP'];
$urAddr['p_c'] = explode(',',$userInfo['WORK_CITY'])[0];
$urAddr['p_state'] = $userInfo['WORK_STATE'];
//$urAddr['p_street'] = $userInfo['WORK_STREET'];
$urAddr['p_street'] = explode(',',$userInfo['WORK_STREET'])[0];
$urAddr['office'] = explode(',',$userInfo['WORK_STREET'])[1];
$urAddr['kv'] = explode(',',$userInfo['WORK_STREET'])[2];
//$urAddr['WORK_CITY_2'] = explode(',',$userInfo['PERSONAL_CITY_2'])[1];
$urAddr['WORK_CITY_2'] = explode(',',trim($userInfo['WORK_CITY']))[1];
if($userInfo['UF_POSTAL_COINC'] == '1') {
    $factAddr = $urAddr;
}
?>
<div class="form__row">
    <div class="form__col form__col_full">
        <div class="seconfary-title form__row_title">
            Юридический адрес
        </div>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Почтовый индекс
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['z']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Область (регион)
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['p_state']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Район
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['p_c']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Населенный пункт
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['WORK_CITY_2']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Улица
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['p_street']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Дом
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['office']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Офис / кв
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$urAddr['kv']?>" disabled>
    </div>
</div>

<div class="form__row">
    <div class="form__col form__col_full">
        <div class="seconfary-title form__row_title">
            Почтовый адрес заявителя
        </div>
    </div>
</div>



<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Почтовый индекс
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$factAddr['z']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Область (регион)
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$factAddr['p_state']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Район
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$factAddr['p_c'])[0]?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Населенный пункт
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=trim($factAddr['WORK_CITY_2'])?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Улица
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$factAddr['p_street']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Дом
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$factAddr['office']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Офис / кв
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$factAddr['kv']?>" disabled>
    </div>
</div>

<br/>
<br/>

<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            ОГРН / ЕГРН
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=($userInfo['UF_ORGN'])?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            ИНН
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['UF_INN']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            КПП
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['UF_KPP']?>" disabled>
    </div>
</div>

<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Телефон
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['WORK_PHONE']?>" disabled>
    </div>
</div>

<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            EMAIL
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['EMAIL']?>" disabled>
    </div>
</div>

<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Факс
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['WORK_FAX']?>" disabled>
    </div>
</div>

<!--<div class="form__row">-->
<!--    <div class="form__field">-->
<!--        <label class="form-politics ">-->
<!--            <input style="display: block;opacity: 0;" required type="checkbox" class="form-politics__hidden privacy_politic" name="privacy_politic" value="Y"-->
<!--                   checked="">-->
<!--            <span class="form-politics__input"></span>-->
<!--            <span class="form-politics__text">-->
<!--                Даю согласие оператору на обработку моих персональных данных-->
<!--                </span>-->
<!--        </label>-->
<!--        <div class="politics_error_msg"><span class="">Необходимо согласиться на обработку персональных данных</span></div>-->
<!--    </div>-->
<!--</div>-->

<?=bitrix_sessid_post()?>