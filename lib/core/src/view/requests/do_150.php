<?
include __DIR__ . '/../base/index.php';
?>
<form class="form form_request" method="post" action="" enctype="multipart/form-data" id="city_zayvka_form">
    <? include __DIR__ . '/top_form/' . $data['topForm']; ?>

    <script>
        $(function () {

            $(".form_request").validate();
            jQuery.extend(jQuery.validator.messages, {
                required: "Это поле необходимо заполнить.",
                max: jQuery.validator.format("Это поле должно быть меньше {0}."),
                min: jQuery.validator.format("Это поле должно быть больше {0}.")
            });

            $('[name="MAX_POWER_CONNECT_D_P[]"]').first().rules("add", {
                required: true,
                messages: {
                    required: "Это поле необходимо заполнить.",
                    min: "Суммарная мощность энергопринимающих устройств не может превышать максимальную мощность энергопринимающих устройств (присоединяемых и ранее присоединенных)",
                }
            });

            $('body').on('keyup mouseup', '[name="DEVICE_POWER[]"]', function () {
                let sum = 0;
                $("[name=\"DEVICE_POWER[]\"]").each(function (i,e) {
                    sum += parseInt($(e).val());
                });
                if(sum > 0) {
                    $('[name="MAX_POWER_CONNECT_D_P[]"]').first().attr('min', sum);
                } else {
                    $('[name="MAX_POWER_CONNECT_D_P[]"]').first().attr('min', 0);
                }
            });
        })
    </script>

    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Вид присоединения
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Тип (схема присоединения)
            </div>
        </div>
        <div class="form__col">
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden" name="TYPE_S_P" value="Временное присоединение" checked="">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Временное присоединение
                </span>
            </label>
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden" name="TYPE_S_P" value="Присоединение по постоянной схеме">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Присоединение по постоянной схеме
                </span>
            </label>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Причина присоединения
            </div>
        </div>
        <div class="form__col">
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden" name="CAUSE_P" value="Увеличение объема максимальной мощности" checked="">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Увеличение объема максимальной мощности
                </span>
            </label>
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden" name="CAUSE_P" value="Новое строительство">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Новое строительство
                </span>
            </label>

        </div>
    </div>






    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Тип энергопринимающих устройств
            </div>
        </div>
    </div>

    <div class="js-repeater" data-limit="10">
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Наименование объекта (например, кафе, нежилое помещение, жилое помещение)
                </div>
            </div>
            <div class="form__col">
                <input type="text" class="form__field-input" placeholder="" name="OBJ_NAME[]" value="">
            </div>
        </div>
        <div class="form__row form__row_double align-center">
            <div class="form__col">
                <div class="form__field-label">
                    Характер нагрузки (вид экономической деятельности заявителя, при наличии)
                </div>
            </div>
            <div class="form__col">
                <input type="text" class="form__field-input" placeholder="" name="CHAR_VID[]" value="">
            </div>
        </div>
        <div class="js-repeater-item">
            <div class="js-repeater-remove"></div>

            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Наименование устройства
                    </div>
                </div>
                <div class="form__col">
                    <div class="dropdown js-dropdown">
                        <input type="hidden" name="DEVICE_NAME[]" class="dropdown__input" value="1">
                        <div class="dropdown__title">Не выбрано</div>
                        <div class="dropdown__list">
                            <div data-id="1" class="dropdown__item active">
                                Не выбрано
                            </div>
                            <div data-id="2" class="dropdown__item">
                                Бытовые приборы
                            </div>
                            <div data-id="3" class="dropdown__item">
                                Освещение
                            </div>
                            <div data-id="4" class="dropdown__item">
                                Насосное оборудование
                            </div>
                            <div data-id="5" class="dropdown__item">
                                Отопительные приборы
                            </div>
                            <div data-id="6" class="dropdown__item">
                                Прочее оборудование
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Мощность устройства
                    </div>
                </div>
                <div class="form__col">
                    <input type="number" class="form__field-input" name="DEVICE_POWER[]"
                           placeholder="кВт" value="" min="0" step="0.00001">
                </div>
            </div>
        </div>
        <div class="js-repeater-btn btn btn_blue">Добавить энергопринимающее устройство</div>
    </div>



    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Месторасположение энергопринимающих устройств
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Тип местности
            </div>
        </div>
        <div class="form__col">
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden" name="TYPE_TERRAIN" value="Городская" checked="">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Городская
                </span>
            </label>
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden" name="TYPE_TERRAIN" value="Сельская">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Сельская
                </span>
            </label>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Местоположение устройства
            </div>
        </div>
        <div class="form__col">
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden js-control-editable" data-control="adres"  name="DEVICE_LOCATION" value="Совпадает с адресом регистрации" checked="">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Совпадает с адресом регистрации
                </span>
            </label>
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden js-control-editable" data-control="adres"  name="DEVICE_LOCATION" value="Совпадает с фактическим адресом">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Совпадает с фактическим адресом
                </span>
            </label>
            <label class="form__radio">
                <input type="radio" class="form__radio-hidden js-control-editable"  data-control="adres" data-edit="true" name="DEVICE_LOCATION" value="Не совпавдает ни с одним из адресов заявителя">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    Не совпавдает ни с одним из адресов заявителя
                </span>
            </label>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Кадастровый номер земельного участка
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input required" name="KADASTR_NUM" value="" required="">
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Адрес
            </div>
        </div>
        <div class="form__col">
            <textarea name="ADDR" class="textarea required"  data-addr1="<?=$factAddr?>" data-addr2="<?=$factAddr2?>" data-controller="adres" disabled></textarea>
        </div>
    </div>


    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Точки присоединения
            </div>
        </div>
    </div>

    <div class="js-repeater" data-limit="10">
        <div class="js-repeater-item">
            <div class="js-repeater-remove"></div>
            <div class="form__row">
                <div class="form__col form__col_full">
                    <div class="seconfary-title">
                        Точка <span class="js-repeater-counter">1</span>
                    </div>
                </div>
            </div>

            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Описание
                    </div>
                </div>
                <div class="form__col">
                    <input type="text" class="form__field-input" name="CONNECT_POINT[]" value=""></textarea>
                </div>
            </div>

            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Максимальная мощность присоединяемых энергопринимающих устройств в точке, кВт
                    </div>
                    </div>
                <div class="form__col">
                    <div class="form__field">

                        <div class="form__field-row">
                            <input type="number" class="form__field-input" name="MAX_POWER_CONNECT_D_P[]" value="" min="0" step="0.00001">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        при напряжении, кВ
                    </div>
                </div>
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-row">
                            <div class="dropdown js-dropdown">
                                <input type="hidden" name="CONNECT_POINT_KV[]" class="dropdown__input" value="0,22">
                                <div class="dropdown__title">0,22</div>
                                <div class="dropdown__list">
                                    <div data-id="1" class="dropdown__item active">
                                        0,22
                                    </div>
                                    <div data-id="2" class="dropdown__item">
                                        0,4
                                    </div>
                                    <div data-id="3" class="dropdown__item">
                                        6
                                    </div>
                                    <div data-id="4" class="dropdown__item">
                                        10
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Максимальная мощность ранее присоединенных в данной точке присоединения энергопринимающих устройств составляет
                    </div>
                </div>
                <div class="form__col">
                    <div class="form__field">

                        <div class="form__field-row">
                            <input type="number" class="form__field-input" name="MAX_POWER_BEFORE[]" value="" min="0" step="0.00001">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        при напряжении, кВ
                    </div>
                </div>
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-row">
                            <div class="dropdown js-dropdown">
                                <input type="hidden" name="MAX_POWER_BEFORE_N[]" class="dropdown__input" value="0,22">
                                <div class="dropdown__title">0,22</div>
                                <div class="dropdown__list">
                                    <div data-id="1" class="dropdown__item active">
                                        0,22
                                    </div>
                                    <div data-id="2" class="dropdown__item">
                                        0,4
                                    </div>
                                    <div data-id="3" class="dropdown__item">
                                        6
                                    </div>
                                    <div data-id="4" class="dropdown__item">
                                        10
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="js-repeater-btn btn btn_blue">Добавить точку присоединения</div>
    </div>

    <div class="form__row form__row_double align-center mt-20">
        <div class="form__col">
            <div class="form__field-label">
                Количество присоединяемых к сети трансформаторов
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="TRANSFORM_COUNT" value="2" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Мощность присоединяемых к сети трансформаторов, кВА
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="TRANSFORM_COUNT_POWER" value="200" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Количество присоединяемых к сети генераторов
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="GENERATOR_COUNT" value="2" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Мощность присоединяемых к сети генераторов, кВА
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="GENERATOR_POWER" value="200" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Заявляемая категория надежности энергопринимающих устройств, I категория, кВт
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="NADEZNOST_DIVECE_I" value="30" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">

            <div class="form__field-label">
                Заявляемая категория надежности энергопринимающих устройств, II категория, кВт
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="NADEZNOST_DIVECE_II" value="20" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">

            <div class="form__field-label">
                Заявляемая категория надежности энергопринимающих устройств, III категория, кВт
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="number" class="form__field-input" name="NADEZNOST_DIVECE_III" value="40" min="0" step="1">
                </div>
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">

            <div class="form__field-label">
                Величина и обоснование величины технологического минимума (для генераторов)
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="text" class="form__field-input" name="TECH_MINIMU_GENERATOR" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Необходимость наличия технологической и (или) аварийной брони
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="text" class="form__field-input" name="AVAR_BLOCK" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Величина и обоснование технологической и аварийной брони
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="text" class="form__field-input" name="AVAR_BRONA" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Заявляемый характер нагрузки (для генераторов – возможная скорость набора или снижения нагрузки) и наличие нагрузок, искажающих форму кривой электрического
                тока и вызывающих несимметрию напряжения в точках присоединения
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="text" class="form__field-input" name="CHARAK_NAGRUZ_GENERATOR" value="">
                </div>
            </div>
        </div>
    </div>


    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Сроки проектирования и поэтапного введения в эксплуатацию объекта (в том числе по этапам и очередям):
            </div>
        </div>
    </div>

    <div class="js-repeater" data-limit="5">
        <div class="js-repeater-item">
            <div class="js-repeater-remove"></div>
            <div class="form__row">
                <div class="form__col form__col_full">
                    <div class="seconfary-title">
                        Этап <span class="js-repeater-counter">1</span>
                    </div>
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Планируемый срок проектирования энергопринимающего устройства (месяц, год)
                    </div>
                </div>
                <div class="form__col">
                    <input type="date" class="form__field-input required" name="SROK_PROEKT[]" value="" required="">
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Планируемый срок введения энергопринимающего устройства в эксплуатацию(месяц, год)
                    </div>
                </div>
                <div class="form__col">
                    <input type="date" class="form__field-input required" name="SROK_VVEDENIYA[]" value="" required="">
                </div>
            </div>
            <div class="form__row form__row_double align-center">
                <div class="form__col">
                    <div class="form__field-label">
                        Максимальная мощность энергопринимающего устройства (кВт)

                    </div>
                </div>
                <div class="form__col">
                    <input type="number" class="form__field-input" name="MAX_POWER_R_DEVICE[]" value="" min="150" step="0.00001">
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
                        <input type="hidden" name="RELIABILITY_CAT[]" class="dropdown__input" value="Не выбрано">
                        <div class="dropdown__title">Не выбрано</div>
                        <div class="dropdown__list">
                            <div data-id="Не выбрано" class="dropdown__item active">
                                Не выбрано
                            </div>
                            <div data-id="1" class="dropdown__item ">
                                1
                            </div>
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
        </div>
        <div class="js-repeater-btn btn btn_blue">Добавить этап(очередь) строительства</div>
    </div>


    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Порядок расчета и условия рассрочки внесения платы за технологическое присоединение по договору осуществляются по:
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <input type="radio" class="form__radio-hidden" name="POR_RAS_US_R_V_OPLAT" value="вариант 1" checked="">
        </div>
        <div class="form__col">
            <label class="form__radio align-start">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    <b>вариант 1</b>, при котором: <br>
                    <small>
                        15 процентов платы за технологическое присоединение вносятся в течение 15 дней со дня заключения договора;<br>
                        30 процентов платы за технологическое присоединение вносятся в течение 60 дней со дня заключения договора, но не позже дня фактического присоединения;<br>
                        45 процентов платы за технологическое присоединение вносятся в течение 15 дней со дня фактического присоединения;<br>
                        10 процентов платы за технологическое присоединение вносятся в течение 15 дней со дня подписания акта об осуществлении технологического присоединения;

                    </small>
                </span>
            </label>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <input type="radio" class="form__radio-hidden" name="POR_RAS_US_R_V_OPLAT" value="вариант 2">

        </div>
        <div class="form__col">
            <label class="form__radio align-start">
                <span class="form__radio-input"></span>
                <span class="form__radio-value">
                    <b>вариант 2</b>, при котором: <br>
                    <small>
                        авансовый платеж вносится в размере 5 процентов размера платы за технологическое присоединение;
осуществляется беспроцентная рассрочка платежа в размере 95 процентов платы за технологическое присоединение с условием ежеквартального внесения платы равными долями от общей суммы рассрочки на период до 3 лет со дня подписания сторонами акта об осуществлении технологического присоединения.
                    </small>
                </span>
            </label>
        </div>
    </div>


    <div class="form__row form__row_double align-center">
        <div class="form__col">

            <div class="form__field-label">
                Оплата
            </div>
        </div>
        <div class="form__col">
            <div class="form__field">
                <div class="form__field-row">
                    <input type="text" class="form__field-input" name="PAY_VAR" value="">
                </div>
            </div>
        </div>
    </div>


    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Гарантирующий поставщик (энергосбытовая организация), с которым планируется заключение договора электроснабжения (купли-продажи электрической энергии (мощности)
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Наименование ГП (ЭСО)
            </div>
        </div>
        <div class="form__col">
            <div class="dropdown js-dropdown">
                <input type="hidden" name="GP_NAME" class="dropdown__input" value="1">
                <div class="dropdown__title">Не выбрано</div>
                <div class="dropdown__list">
                    <div data-id="1" class="dropdown__item active">
                        Не выбрано
                    </div>
                    <div data-id="2" class="dropdown__item">
                        АО "ТОСК"
                    </div>
                    <div data-id="3" class="dropdown__item">
                        ПАО "ТЭСК"
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form__row">
        <div class="inform-block inform-block_autoheight">
            Договор энергоснабжения или купли/продажи электрической энергии (можности) с выбранным гарантирующим поставщиком (энергосбытовой компанией) заключается до завершения процедуры технологического присоединения.
        </div>
    </div>

    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="seconfary-title form__row_title">
                Договор, обеспечивающий продажу электроэнергии (мощности) на розничном рынке (при наличии)
            </div>
        </div>
    </div>

    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
                Вид договора
            </div>
        </div>
        <div class="form__col">
            <div class="dropdown js-dropdown">
                <input type="hidden" name="TYPE_CONTRACT" class="dropdown__input" value="1">
                <div class="dropdown__title">Не выбрано</div>
                <div class="dropdown__list">
                    <div data-id="1" class="dropdown__item active">
                        Не выбрано
                    </div>
                    <div data-id="2" class="dropdown__item">
                        Договор купли-продажи электроэнергии
                    </div>
                    <div data-id="3" class="dropdown__item">
                        Договор энергоснабжения
                    </div>
                    <div data-id="4" class="dropdown__item">
                        Иной вид договора
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
               Дата договора энергоснабжения
            </div>
        </div>
        <div class="form__col">
            <input type="date" class="form__field-input" name="DATE_DOG_ENER" value="">
        </div>
    </div>
    <div class="form__row form__row_double align-center">
        <div class="form__col">
            <div class="form__field-label">
               Номер договора энергоснабжения
            </div>
        </div>
        <div class="form__col">
            <input type="text" class="form__field-input" name="NUM_DOGOV_EN" value="">
        </div>
    </div>


    <?
    include NEW_DIR . '/bottom/files_container.php';
    include NEW_DIR . '/bottom/files.php';
    include NEW_DIR . '/bottom/agry.php';
    ?>
    <div class="form__row">
            <div class="form__buttons form__buttons_reg">
                <input type="button" name="send_form_request" class="btn btn_blue btn_submit btn_personal form__submit" value="Отправить заявку">

                <input type="button" name="send_form_request" data-with-ds
                        class="btn btn_white btn_submit btn_personal form__submit" value="Подписать ЭЦП и отправить заявку">
            </div>
  </div>
    <div class="form__row">
        <select id="cert_list">

        </select>
    </div>
</form>