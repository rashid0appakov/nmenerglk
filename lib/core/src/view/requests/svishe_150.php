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
                Наименование энергопринимающих устройств для присоединения
            </div>
        </div>
        <div class="form__col">
            <div class="dropdown js-dropdown">
                <input type="text" name="CONNECT_DEVICE_NAME" class="form__field-input" value="" required>
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
                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
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

    <div style="background: #e9e9e9; padding: 5px;">
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Количество точек присоединения
                </div>
            </div>
            <div class="form__col">
                <input type="number" min="1" max="10" class="form__field-input required" name="POINT_CONNECT_COUNT"
                       required value="1">
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
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        при напряжении, кВ
                    </div>
                </div>
                <div class="form__col">
                    <div class="dropdown js-dropdown">
                        <input type="hidden" name="BEFORE_POWER_B" class="dropdown__input" value="0,4">
                        <div class="dropdown__title">0,4</div>
                        <div class="dropdown__list">
                            <div data-id="1" class="dropdown__item active">
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
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    при напряжении, кВ
                </div>
            </div>
            <div class="form__col">
                <div class="dropdown js-dropdown">
                    <input type="hidden" name="POWER_B" class="dropdown__input" value="0,4">
                    <div class="dropdown__title">0,4</div>
                    <div class="dropdown__list">
                        <div data-id="1" class="dropdown__item active">
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


    

<!--
Тут выводим опять столько инпутов, сколько точек, и заполняем их суммарной мощностью по каждой точке (присоединяемой и присоединенной).

Поля нередактируемые, дисейблим их.


-->
    <div style="background: #e9e9e9; padding: 5px;">
        <div class="MAX_POWER_EN_GET_DEVICE_parent">
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Максимальная мощность энергопринимающих устройств
                        (присоединяемых и ранее присоединенных), точка присоединения
                        №<span class="count_item">1</span>, кВт
                    </div>
                </div>
                <div class="form__col">
                    <input type="number" step="0.01" class="form__field-input required MAX_POWER_EN_GET_DEVICE dis" value="" name="MAX_POWER_EN_GET_DEVICE[]">
                </div>
            </div>
        </div>
    </div>

<!--
Берется значение из поля “максимальная мощность присоединяемых… при напряжениии”.

Поле нередактируемое.

-->
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                при напряжении, кВ
            </div>
        </div>
        <div class="form__col">
            <input type="text" name="EN_GET_DEVICE_BEFORE_POWER_B" class="form__field-input dis" value="0,4">
        </div>
    </div>


<!--
В нее суммируется мощность и присоединяемая и присоединенная по всем точкам.

Поле нередактируемое.

-->

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Максимальная мощность энергопринимающих устройств (присоединяемых и ранее присоединенных) общая, кВт
            </div>
        </div>
        <div class="form__col">
            <input type="number" class="form__field-input all_power_sum"  step="0.01" value="" disabled min="150.01">
            <input type="hidden" class="form__field-input all_power_sum" value="" name="MAX_POWER_EN_GET_DEVICE2">
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Количество и мощность присоединяемых к сети трансформаторов, кВА
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input"
                   name="TRNASFOR_COUNT" value="" >
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Количество и мощность генераторов
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input"
                   name="GENERATOR_COUNT" value="" >
        </div>
    </div>

    <div style="background: #e9e9e9; padding: 5px;">
        <div>
            <b>
                Заявляемые мощности по категориям надежности
            </b>
        </div>

        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Заявляемая категория энергопринимающего устройства по надежности электроснабжения
                </div>
            </div>
            <div class="form__col">

                <div class="dropdown js-dropdown">
                    <input type="hidden" name="ZAY_CAT_NAD" class="dropdown__input" value="">
                    <div class="dropdown__title"></div>
                    <div class="dropdown__list" style="display: none;">
                        <div data-id="" class="dropdown__item active"></div>
                        <div data-id="2" class="dropdown__item">
                            2
                        </div>
                        <div data-id="3" class="dropdown__item">
                            3
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div style="display: none" data-target="ZAY_CAT_NAD" data-val="2">
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        I категория, кВт
                    </div>
                </div>
                <div class="form__col">
                    <span>
                        Обеспечивается самостоятельно источниками Заявителя
                    </span>
                    <input type="hidden" class="form__field-input dis" name="NADEZNOST_DIVECE_I" value="Обеспечивается самостоятельно источниками Заявителя">
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        II категория (включая I категорию), кВт
                    </div>
                </div>
                <div class="form__col">

                    <input type="number" class="form__field-input" name="NADEZNOST_DIVECE_II" value="" >
                </div>
            </div>
        </div>

        <div style="display: none" data-target="ZAY_CAT_NAD" data-val="2,3">
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        III категория, кВт
                    </div>
                </div>
                <div class="form__col">
                    <input type="number" step="0.01" class="form__field-input" name="NADEZNOST_DIVECE_III" value="" >
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Заявляемый характер нагрузки
            </div>
        </div>
        <div class="form__col">

            <div class="dropdown js-dropdown">
                <input type="hidden" name="ZAYAV_CHAR_NAGR" class="dropdown__input" value="">
                <div class="dropdown__title"></div>
                <div class="dropdown__list" style="display: none;">
                    <div data-id="" class="dropdown__item active"></div>
                    <div data-id="2" class="dropdown__item">
                        Бытовая
                    </div>
                    <div data-id="3" class="dropdown__item">
                        Генерация электроэнергии
                    </div>
                    <div data-id="4" class="dropdown__item">
                        Производственная
                    </div>
                    <div data-id="5" class="dropdown__item">
                        Совмещенная
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Величина и обоснование величины технологического минимума
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input"
                   name="VAL_TECH_MIN" value="" >
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Необходимость наличия технологической и (или) аварийной брони
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input"
                   name="NEOB_NAL_T_A_BRON" value="" >
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Величина и обоснование технологической и аварийной брони
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input"
                   name="VAL_TECH_MIN2" value="" >
        </div>
    </div>

    <div style="background: #e9e9e9; padding: 5px;">

    <div class="form__row">
        <div class="seconfary-title form__row_title">
            Сроки проектирования и поэтапного введения в эксплуатацию объекта (в том числе по этапам и очередям), планируемое поэтапное распределение максимальной мощности
        </div>
    </div>
    <div>
        <div class="cloned_block">
            <div class="form__col">
                <div class="form__field-label">
                    <b>Этап №<span class="count_item">1</span></b>
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Срок проектирование
                    </div>
                </div>
                <div class="form__col">
                    <input type="date" class="form__field-input"
                           name="SROK_PROEKT[]" value="" >
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Срок введения
                    </div>
                </div>
                <div class="form__col">
                    <input type="date" class="form__field-input"
                           name="SROK_VVED[]" value="" >
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Макс. Мощность
                    </div>
                </div>
                <div class="form__col">
                    <input type="text"  step="0.01" class="form__field-input"
                           name="MAX_P[]" value="" >
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Категория надежности
                    </div>
                </div>
                <div class="form__col">
                    <input type="text" class="form__field-input"
                           name="ZAYAV_CAT_NAD[]" value="" >
                </div>
            </div>
        </div>

        <button type="button" class="clone_parent">Добавить этап</button>
    </div>
    </div>

    <br/>
    <br/>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Гарантирующий поставщик
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input" value="Нарьян-Марская электростанция" disabled>
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

    <div class="form__row form__row_double align-center DOC_COPY_PRAVO_SOB" >
        <div class="form__col">
            <div class="form__field-label">
                Выписка из Единого государственного реестра
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="VIPISKA_EGR">загрузить файл</span>
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
                в многоквартирных домах, копия документа,
                подтверждающего согласие организации, осуществляющей управление многоквартирным домом
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

    <div class="form__row form__row_double align-center PASSPORT_COPY" >
        <div class="form__col">
            <div class="form__field-label">
                Копия паспорта
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="PASSPORT_COPY">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center PASSPORT_COPY" >
        <div class="form__col">
            <div class="form__field-label">
                Перечень и мощность энергопринимающих устройств, которые могут быть присоединены к устройствам противоаварийной и режимной автоматики
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="PRECEHN_EN_DEVICE">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Должность
            </div>
        </div>
        <div class="form__field">
            <div class="form__field-row">
                <input disabled type="text" class="form__field-input " name="DOLZNOST" value="<?=$userInfo['WORK_POSITION']?>">
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
                    style="display: none"
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