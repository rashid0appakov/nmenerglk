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
            Категория заявителя
        </div>
    </div>
    <div class="form__col">
        <div class="dropdown js-dropdown">
            <input type="hidden" class="dropdown__input" value="1" disabled>
            <div class="dropdown__title">Физическое лицо</div>
            <div class="dropdown__list">
                <div data-id="1" class="dropdown__item active">
                    Физическое лицо
                </div>
                <div data-id="2" class="dropdown__item">
                    Юридическое лицо
                </div>
                <div data-id="3" class="dropdown__item">
                    Индивидуальный предприниматель
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Фамилия
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['LAST_NAME']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Имя
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['NAME']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Отчество
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['SECOND_NAME']?>" disabled>
    </div>
</div>

<div class="form__row">
    <div class="form__col form__col_full">
        <div class="seconfary-title form__row_title">
            Паспортные данные
        </div>
    </div>
</div>
<!--
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Сканированная копия паспорта
        </div>
    </div>
    <div class="form__col">
        <div class="upload-files" style="padding-top: 0px;">
            <div class="upload-files__fields"></div>
            <div class="upload-files__items"></div>
            <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="PROPERTY[2]">загрузить файл</span>
        </div>
    </div>
</div>
-->
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Наименование документа
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['UF_DOC_NAME']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Серия
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['UF_PASSPORT_SERIAL']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Номер
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['UF_PASSPORT_NUM']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Дата выдачи
        </div>
    </div>
    <div class="form__col">
        <input type="date" class="form__field-input required" value="<?=$userInfo['UF_PASSPORT_DATE']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Кем выдан
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input required" value="<?=$userInfo['UF_PASSPORT_FROM']?>" disabled>
    </div>
</div>
<?
//if($userInfo['PERSONAL_ZIP']) {
//    $userInfo = $userInfo['PERSONAL_ZIP'] . ', ' . $userInfo['PERSONAL_CITY'] . ', ' . $userInfo['PERSONAL_STATE'] . ', ' . $userInfo['PERSONAL_STREET'];
//}
//else {
//    $userInfo = $userInfo['WORK_ZIP'] . ', ' . $userInfo['WORK_STATE'] . ', ' . $userInfo['WORK_CITY'] . ', ' . $userInfo['WORK_STREET'];
//}
//$userInfo2 = $userInfo;
?>

<div class="form__row">
    <div class="form__col form__col_full">
        <div class="seconfary-title form__row_title">
            Зарегистрирован
        </div>
    </div>
</div>

<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Индекс
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$userInfo['WORK_ZIP']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Область (регион)
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$userInfo['WORK_STATE']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Район
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$userInfo['WORK_CITY'])[0]?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Населенный пункт
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=trim(explode(',',$userInfo['WORK_CITY'])[1])?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Улица
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$userInfo["WORK_STREET"])[0]?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Дом
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=trim(explode(',',$userInfo["WORK_STREET"])[1])?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Офис / кв
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=trim(explode(',',$userInfo["WORK_STREET"])[2])?>" disabled>
    </div>
</div>

<?
if($userInfo["UF_POSTAL_COINC"] === '1') {
    $userInfo['PERSONAL_STATE'] = $userInfo['WORK_STATE'];
    $userInfo['PERSONAL_CITY'] = $userInfo['WORK_CITY'];
    $userInfo['PERSONAL_STREET'] = $userInfo['WORK_STREET'];
    $userInfo['PERSONAL_ZIP'] = $userInfo['WORK_ZIP'];
}
?>
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
            Индекс
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$userInfo['PERSONAL_ZIP']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Область (регион)
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=$userInfo['PERSONAL_STATE']?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Район
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$userInfo['PERSONAL_CITY'])[0]?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Населенный пункт
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=trim(explode(',',$userInfo['PERSONAL_CITY'])[1])?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Улица
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$userInfo['PERSONAL_STREET'])[0]?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Дом
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$userInfo["PERSONAL_STREET"])[1]?>" disabled>
    </div>
</div>
<div class="form__row form__row_double align-center">
    <div class="form__col">
        <div class="form__field-label">
            Офис / кв
        </div>
    </div>
    <div class="form__col">
        <input type="text" class="form__field-input" value="<?=explode(',',$userInfo["PERSONAL_STREET"])[2]?>" disabled>
    </div>
</div>


<br/>
<br/>
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