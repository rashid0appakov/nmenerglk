<?
include __DIR__ . '/../base/index.php';
?>
<form class="form form_request" method="post" action="" enctype="multipart/form-data" id="city_zayvka_form">
    <? include __DIR__ . '/top_form/' . $data['topForm']; ?>


    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Основное
            </div>
        </div>
    </div>


    <!--   REQUEST_REASONS -->
    <div>
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Схема электроснабжения
                </div>
            </div>
            <div class="form__col">
                <div class="dropdown js-dropdown">
                    <input type="hidden" name="CONNECT_SCHEMA" class="dropdown__input"
                           value="">
                    <div class="dropdown__title"> </div>
                    <div class="dropdown__list">
                        <div data-id="0" class="dropdown__item active"></div>
                        <div data-id="1" class="dropdown__item">
                            По временной схеме
                        </div>
                        <div data-id="2" class="dropdown__item">
                            По постоянной схеме
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--   CONNECT_SCHEMA -->
        <div>
            <div class="form__row form__row_double align-center js_show_if" style="display: none" data-target="CONNECT_SCHEMA" data-val="2">
                <div class="form__col">
                    <div class="form__field-label">
                        По временной схеме на период: с
                        <br/>
                        <i>
                            (укажите дату из правоустанавливающих документов)
                        </i>
                    </div>
                </div>
                <div class="form__col">
                    <input type="date" class="form__field-input" name="TIME_SCHEME_FROM" value="">
                </div>
            </div>

            <div class="form__row form__row_double align-center js_show_if" style="display: none" data-target="CONNECT_SCHEMA" data-val="2">
                <div class="form__col">
                    <div class="form__field-label">
                        По временной схеме на период: по
                        <br/>
                        <i>
                            (укажите дату из правоустанавливающих документов)
                        </i>
                    </div>
                </div>
                <div class="form__col">
                    <input type="date" class="form__field-input" name="TIME_SCHEME_TO" value="">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Причины подачи заявки на технологическое присоединение к электрической сети
            </div>
        </div>
        <div class="form__col">
            <p>
                <input class="checkbox_f" type="checkbox" name="REQUEST_REASONS[]" data-id="2" value="Новое технологическое присоединение">
                <span>Новое технологическое присоединение</span>
            </p>
            <p>
                <input class="checkbox_f" type="checkbox" name="REQUEST_REASONS[]" data-id="3" value="Увеличение максимальной мощности потребления">
                <span>Увеличение максимальной мощности потребления</span>
            </p>
            <p>
                <input class="checkbox_f" type="checkbox" name="REQUEST_REASONS[]" data-id="4" value="Изменение точки присоединения">
                <span>Изменение точки присоединения</span>
            </p>
            <p>
                <input class="checkbox_f" type="checkbox" name="REQUEST_REASONS[]" data-id="5" value="Изменение схемы присоединения">
                <span>Изменение схемы присоединения</span>
            </p>
            <p>
                <input class="checkbox_f" type="checkbox" name="REQUEST_REASONS[]" data-id="6" value="Изменение уровня напряжения">
                <span>Изменение уровня напряжения</span>
            </p>
        </div>
    </div>


    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Наименование присоединяемого объекта
            </div>
        </div>
        <div class="form__col">
            <div class="dropdown js-dropdown">
                <input type="hidden" name="NAME_OBJECT_CONNECTION" class="dropdown__input" value="">
                <div class="dropdown__title"></div>
                <div class="dropdown__list">
                    <div data-id="0" class="dropdown__item active">
                    </div>
                    <div data-id="1" class="dropdown__item ">
                        Гаражный бокс
                    </div>
                    <div data-id="2" class="dropdown__item">
                        Индивидуальный жилой дом
                    </div>
                    <div data-id="3" class="dropdown__item">
                        Индивидуальная баня
                    </div>
                    <div data-id="4" class="dropdown__item">
                        Нежилое помещение
                    </div>
                    <div data-id="5" class="dropdown__item">
                        Участок строительства ИЖД
                    </div>
                    <div data-id="6" class="dropdown__item">
                        Участок строительства бани
                    </div>
                    <div data-id="7" class="dropdown__item">
                        Иное
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--   NAME_OBJECT_CONNECTION -->
    <div>
        <div class="form__row form__row_double align-center js_show_if" style="display: none" data-target="NAME_OBJECT_CONNECTION" data-val="8">
            <div class="form__col">
                <div class="form__field-label">
                    Иное
                </div>
            </div>
            <div class="form__col">
                <?
                // TODO: required_if_visible
                ?>
                <input type="text" class="form__field-input required_if_visible" name="ANOTHER" value="">
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Адрес расположения присоединяемого объекта
            </div>
        </div>
        <div class="form__col">
            <textarea class="form__field-input required" name="ADDR_EL_DEVICE" required></textarea>
        </div>
    </div>

    <div class="form__row align-center">

        <div class="form__row">
            <div class="form__field-label">
                Точка на карте
            </div>
        </div>
        <div class="form__row">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="hidden" class="form__field-input required" name="MAP_POINT" value="" required>
                    <div id="map" style="width: 100%; height:500px"></div>
                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                    <script>
                        ymaps.ready(function(){
                            if ($('div').is('#map')) {
                                var myMap = new ymaps.Map("map", {
                                    center: [67.6240282357, 53.052949414],
                                    zoom: 12,
                                    controls: ['zoomControl']
                                });
                                myMap.events.add('click', function (e) {
                                    if (!myMap.balloon.isOpen()) {
                                        var coords = e.get('coords');
                                        $('[name="MAP_POINT"]').val(coords[0].toPrecision(6) + ':' + coords[1].toPrecision(6));
                                        myMap.balloon.open(coords, {
                                            contentHeader:'Точка выбрана!',
                                            contentBody:'<p>Координаты точки: ' + [
                                                coords[0].toPrecision(6),
                                                coords[1].toPrecision(6)
                                            ].join(', ') + '</p>',
                                            contentFooter:'<sup>Спасибо!</sup>'
                                        });
                                    } else {
                                        myMap.balloon.close();
                                    }
                                });
                                myMap.events.add('contextmenu', function (e) {myMap.hint.open(e.get('coords'), 'Кто-то щелкнул правой кнопкой');});
                                myMap.events.add('balloonopen', function (e) {myMap.hint.close();});
                            };
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <div style="background: #e9e9e9; padding: 5px;" >
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Количество точек присоединения
                </div>
            </div>
            <div class="form__col">
                <div class="dropdown js-dropdown">
                    <input type="hidden" name="POINT_CONNECT_COUNT" class="dropdown__input" value="1">
                    <div class="dropdown__title">1</div>
                    <div class="dropdown__list">
                        <div data-id="1" class="dropdown__item active">
                            1
                        </div>
                        <div data-id="2" class="dropdown__item">
                            2
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hide_reason_new" style="display: none">
            <div>
                <b>Максимальная мощность ранее присоединенных энергопринимающих устройств по точкам,
                    кВт</b>
            </div>
            <div class="form__row form__row_double align-center cloned_block2">
                <div class="form__col">
                    <div class="form__field-label">
                        Точка присоединения № <span class="count_item">1</span>, кВт
                    </div>
                </div>
                <div class="form__col">
                    <input type="number" step="0.01" class="form__field-input" name="MAX_P_RANEE_P[]" value="">
                </div>
            </div>

            <div class="cloned_block_ins">
            </div>
        </div>

        <div class="form__row form__row_double align-center hide_reason_new" style="display: none">
            <div class="form__col">
                <div class="form__field-label">
                    при напряжении, кВ
                </div>
            </div>
            <div class="form__col">
                <div class="dropdown js-dropdown EN_GET_DEVICE_BEFORE_POWER_B">
                    <input type="hidden" name="BEFORE_POWER_B" class="dropdown__input" value="0,22">
                    <div class="dropdown__title">0,22</div>
                    <div class="dropdown__list">
                        <div data-id="0" class="dropdown__item active">
                            0,22
                        </div>
                        <div data-id="1" class="dropdown__item">
                            0,4
                        </div>
                        <div data-id="2" class="dropdown__item">
                            6,3
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="background: #e9e9e9; padding: 5px;">
            <div>
                <b>
                    Максимальная мощность присоединяемых энергопринимающих устройств точка присоединения №<span class="count_item_2">1</span>, кВт
                </b>
            </div>
            <div class="form__row form__row_double align-center cloned_block2">
                <div class="form__col">
                    <div class="form__field-label">
                        Точка присоединения № <span class="count_item">1</span>, кВт
                    </div>
                </div>
                <div class="form__col">
                    <input type="number" step="0.01" class="form__field-input required" name="MAX_P_USHE_P[]" required value="">
                </div>
            </div>

            <div class="cloned_block_ins">
            </div>
        </div>


        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    при напряжении, кВ
                </div>
            </div>
            <div class="form__col">
                <div class="dropdown js-dropdown POWER_LEVEL_POWER_B">
                    <input type="hidden" name="POWER_B" class="dropdown__input" value="0,22">
                    <div class="dropdown__title">0,22</div>
                    <div class="dropdown__list">
                        <div data-id="0" class="dropdown__item active">
                            0,22
                        </div>
                        <div data-id="1" class="dropdown__item">
                            0,4
                        </div>
                        <div data-id="2" class="dropdown__item">
                            6,3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Максимальная мощность энергопринимающих устройств (присоединяемых и ранее присоединенных) общая, кВт
            </div>
        </div>
        <div class="form__col">
            <input type="number" class="form__field-input all_power_sum"  step="0.01" value="" disabled max="150">
            <input type="hidden" class="form__field-input all_power_sum" value="" name="MAX_POWER_EN_GET_DEVICE2" data-type="do150">
        </div>
    </div>


    <div class="hide_reason_new" style="display: none">
        <div class="form__row">
            <div class="form__col form__col_full">
                <div class="seconfary-title form__row_title">
                    Реквизиты договора энергоснабжения
                </div>
            </div>
        </div>
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Дата договора
                </div>
            </div>
            <div class="form__col">
                <input type="date" class="form__field-input required" name="REQU_DOGOVOR[]" value="">
            </div>
        </div>
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Номер договора
                </div>
            </div>
            <div class="form__col">
                <input type="text" class="form__field-input required" name="REQU_DOGOVOR[]" value="">
            </div>
        </div>
        <br/>
        <br/>
    </div>


    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Уровень напряжения
            </div>
        </div>
        <div class="form__col">
            <div class="dropdown js-dropdown POWER_LEVEL">
                <input type="hidden" name="POWER_LEVEL" class="dropdown__input" value="0,22 кВ">
                <div class="dropdown__title">0,22 кВ</div>
                <div class="dropdown__list">
                    <div data-id="1" class="dropdown__item active">
                        0,22 кВ
                    </div>
                    <div data-id="2" class="dropdown__item">
                        0,4 кВ
                    </div>
                    <div data-id="3" class="dropdown__item">
                        6,3 кВ
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Категория надежности
            </div>
        </div>
        <div class="form__col">
            <div class="dropdown js-dropdown">
                <input type="hidden" name="ZAYAV_CAT_NAD[]" class="dropdown__input" value="III">
                <div class="dropdown__title">III</div>
                <div class="dropdown__list">
                    <div data-id="III" class="dropdown__item active">
                        III
                    </div>
                    <div data-id="II" class="dropdown__item">
                        II
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center hide_reason_new" style="display: none">
        <!--        Это поле отображается только если причина обращения 3,4,5,6
        -->
        <div class="form__col">
            <div class="form__field-label">
                Ранее выданные Технические условия №
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="text" class="form__field-input " name="R_V_TECH_USLOV" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center hide_reason_new" style="display: none">
        <!--
        Это поле отображается только если причина обращения 3,4,5,6
        -->
        <div class="form__col">
            <div class="form__field-label">
                Дата выдачи технических условий
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">

                <div class="form__field-row">
                    <input type="date" class="form__field-input " name="R_V_TECH_USLOV_DATE" value="">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Документы
            </div>
        </div>
    </div>

    <? include __DIR__ . '/bottom/files_container.php'; ?>

    <div class="form__row form__row_double align-center DOC_COPY_PRAVO_SOB" >
        <div class="form__col">
            <div class="form__field-label">
                Копия документа, подтверждающая право собственности
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOC_COPY_PRAVO_SOB">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="form__row form__row_double align-center PASSPORT_COPY" >
        <div class="form__col">
            <div class="form__field-label">
                Для юридических лиц - выписка из Единого государственного реестра юридических лиц, для индивидуальных предпринимателей - выписка из Единого государственного реестра индивидуальных предпринимателей
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="EGR_EGRIP_FILE">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center PLAN_DEVICE" >
        <div class="form__col">
            <div class="form__field-label">
                План расположения энергопринимающих устройств
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="PLAN_DEVICE">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center PASSPORT_COPY" >
        <div class="form__col">
            <div class="form__field-label">
                В случае технологического присоединения энергопринимающих устройств,
                в многоквартирных домах, копия документа, подтверждающего согласие организации, осуществляющей управление многоквартирным домом
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="COPY_DOC_SOGL_KV">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                ФИО
            </div>
        </div>
        <div class="form__field">
            <div class="form__field-row">
                <input type="text" class="form__field-input " name="FIO" value="<?=$userInfo['LAST_NAME']?> <?=$userInfo['NAME']?> <?=$userInfo['SECOND_NAME']?>">
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Дата
            </div>
        </div>
        <div class="form__field">
            <div class="form__field-row">
                <input type="date" class="form__field-input " name="R_V_TECH_USLOV_DATE" value="<?=date('Y-m-d')?>" disabled>
            </div>
        </div>
    </div>

    <?
    //        include __DIR__ . '/bottom/files.php';
    include __DIR__ . '/bottom/agry.php';
    ?>
    <div class="form__row">
        <div class="form__buttons form__buttons_reg">
            <input type="button"
                   name="send_form_request"
                   class="btn btn_blue btn_submit btn_personal form__submit"
                   style="display: none;"
                   value="Отправить заявку">
            <input type="button" name="send_form_request" data-with-ds
                   class="btn btn_white btn_submit btn_personal form__submit" value="Подписать ЭЦП и отправить заявку">
        </div>
    </div>
    <div class="form__row">
        <select id="cert_list">

        </select>
    </div>
</form>
</div>