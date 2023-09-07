<?
/** @var array $data */
$userInfo = $data['userInfo'];
$fields = $data['fields'];

$helper = $data['helper'];
$fillFields = $data['fillFields'];
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
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js" defer></script>
<script>
    $(function () {

        $('.clone_parent').click(function () {
            let clonedParent = $(this).parent().find('.cloned_block').clone(),
            count = parseFloat($(this).parent().find('.count_item').length);
            if(count < 10) {
                clonedParent.find('.count_item').text(count+1);
                clonedParent.find('.count_item_2').text(count+1);
                clonedParent.find('input[type="date"]').attr({min: null, max: null});
                $(this).before(clonedParent.html());
            }
        });

        var clonedMax = $('.MAX_POWER_EN_GET_DEVICE_parent').clone();
        $('[name="POINT_CONNECT_COUNT"]').change(function () {
            let int = $(this).val(), str2 = '';

            if(int === '1') {
                // $('[name="ZAYAV_CAT_NAD[]"]').val('III');$('[name="ZAYAV_CAT_NAD[]"]').parent().find('.dropdown__title').text('III');
                $('[name="ZAYAV_CAT_NAD[]"]').parent().find('.dropdown__item[data-id="III"]').trigger('click');
                
            } else if(int === '2') {
                // $('[name="ZAYAV_CAT_NAD[]"]').val('II');$('[name="ZAYAV_CAT_NAD[]"]').parent().find('.dropdown__title').text('II');
                $('[name="ZAYAV_CAT_NAD[]"]').parent().find('.dropdown__item[data-id="II"]').trigger('click');
            }

            $('.cloned_block2').each(function () {
                let cloned = $(this).clone(), str = '';
                for(i=0;i<int-1;i++) {
                    cloned.find('.count_item').text(i+2);
                    cloned.find('.count_item_2').text(i+2);
                    str+= "<div class='form__row form__row_double align-center'>"+cloned.html()+"</div>";
                }
                $(this).parent().find('.cloned_block_ins').last().html(str);
            });

            for(i=0;i<int;i++) {
                clonedMax.find('input').val();
                clonedMax.find('.count_item').text(i+1);
                clonedMax.find('.count_item_2').text(i+1);
                str2+= "<div class='form__row form__row_double align-center'>"+clonedMax.html()+"</div>";
            }
            $('.MAX_POWER_EN_GET_DEVICE_parent').html(str2);
        });

        $('.dropdown__list .dropdown__item').each(function () {
            let str = $(this).text();
            $(this).attr('data-id', $.trim(str));
        });
        $('.js-dropdown').each(function () {
            let str = $(this).find('.dropdown__item.active').text();
            $(this).find('.dropdown__input').val($.trim(str));
        });

        <?/*  ограничение полей с типом "date"*/?>
        $('body').on('change', 'input[type="date"]', function (){
            let $this = $(this);
            let timeValue = new Date($this.val());
            $this.attr('data-value',timeValue.getTime());

            switch($this.attr('name')){
                case 'SROK_VVED[]':
                    $this.closest('.form__row').prev().find('input[name="SROK_PROEKT[]"]').attr('max', $this.val());
                    break;
                case 'SROK_PROEKT[]':
                    $this.closest('.form__row').next().find('input[name="SROK_VVED[]"]').attr('min', $this.val());
                break;

                case 'TIME_SCHEME_FROM':
                    $('input[name="TIME_SCHEME_TO"]').attr('min', $this.val());
                    break;
                case 'TIME_SCHEME_TO':
                    $('input[name="TIME_SCHEME_FROM"]').attr('max', $this.val());
                    break;
                default:
                    break;
            }
        });

        $('body').on('change','[name="MAX_P_RANEE_P[]"],[name="MAX_P_USHE_P[]"]', function () {
            let p1={},p2={},all=0,all2=0;

            $('[name="MAX_P_RANEE_P[]"]').each(function (i,e) {
                p1[i] = $(e).val();
                if ($(e).val()) {
                    all2 += parseFloat($(e).val())
                };
            });
            let dropdown = $('[name="BEFORE_POWER_B"]').parent();
            if (all2 <= 7) {
                dropdown.find('.dropdown__item[data-id="0,22"]').show();  
            } else {
                dropdown.find('.dropdown__item[data-id="0,4"]').trigger('click');
                dropdown.find('.dropdown__item[data-id="0,22"]').hide();
            }

            $('[name="MAX_P_USHE_P[]"]').each(function (i,e) {
                p2[i] = $(e).val();
                if ($(e).val()) {
                    all2 += parseFloat($(e).val())
                };
            });
            $('.MAX_POWER_EN_GET_DEVICE').each(function (i,e) {
                if(p1[i] && p2[i]) {
                    all+=parseFloat(p1[i]) + parseFloat(p2[i]);
                    $(e).val((parseFloat(p1[i]) + parseFloat(p2[i])));
                } else if(p1[i]) {
                    all+=parseFloat(p1[i]);
                    $(e).val((parseFloat(p1[i])));
                } else if(p2[i]) {
                    all+=parseFloat(p2[i]);
                    $(e).val((parseFloat(p2[i])));
                }
                //.toFixed(2)
            });
           
            if (all > 0 ) {
                $('.all_power_sum').val(all.toFixed(2)); 
            } else {
                $('.all_power_sum').val(parseFloat(all2).toFixed(2));
            }
            $('[name="MAX_POWER_EN_GET_DEVICE2"]').trigger('change');
        });
        $('[name="POWER_B"]').change(function () {
            $('.EN_GET_DEVICE_BEFORE_POWER_B .dropdown__item[data-id="'+$(this).val()+'"]').trigger('click');
             $('[name="EN_GET_DEVICE_BEFORE_POWER_B"]').val($(this).val());
        });
        $('.MAX_POWER_EN_GET_DEVICE').change(function () {
            let val = parseFloat($(this).val());
            if(val <= 7) {
                $('.EN_GET_DEVICE_BEFORE_POWER_B .dropdown__item[data-id="0,22"]').show();
            } else {
                $('.EN_GET_DEVICE_BEFORE_POWER_B .dropdown__item[data-id="0,22"]').hide();
                $('.EN_GET_DEVICE_BEFORE_POWER_B .dropdown__title').trigger('click');
            }
        });

        $('[name="MAX_POWER_EN_GET_DEVICE2"]').change(function () {
            let val = parseFloat($(this).val());
            if(val <= 7) {
                $('.POWER_LEVEL .dropdown__item[data-id="0,22 кВ"], .POWER_LEVEL_POWER_B .dropdown__item[data-id="0,22"]').show();  
            } else {
                $('.POWER_LEVEL .dropdown__item[data-id="0,4 кВ"], .POWER_LEVEL_POWER_B .dropdown__item[data-id="0,4"]').trigger('click');
                $('.POWER_LEVEL .dropdown__item[data-id="0,22 кВ"], .POWER_LEVEL_POWER_B .dropdown__item[data-id="0,22"]').hide();
            }
        });

        const check_power = function () {
            let has_increasing = false;
            $('[name="REQUEST_REASONS[]"]:checked').each((_, el) => {
                if ($(el).data('id') == 3) {
                    has_increasing = true;
                }
            })
            let val = parseFloat($('[name="MAX_POWER_CONNECT"]').val() || 0);
            let max_power_before = 0;
            if (has_increasing) {
                max_power_before = parseFloat($('[name="MAX_BEFORE_POWER_B"]').val() || 0);
            }
            if((val + max_power_before) <= 7) {
                $('.MAX_POWER_CONNECT .dropdown__item[data-id="0,22"]').show();
            } else {
                $('.MAX_POWER_CONNECT .dropdown__item[data-id="0,22"]').hide();
                $('.MAX_POWER_CONNECT .dropdown__title').text('0,4');
                $('[name="POWER_B"]').val('0,4').trigger('change');
            }

            if($('[name="MAX_BEFORE_POWER_B"]').val()) {
                $('.MAX_POWER_EN_GET_DEVICE').val((parseFloat($('[name="MAX_BEFORE_POWER_B"]').val()) + val).toFixed(2)).trigger('change');
            } else {
                $('.MAX_POWER_EN_GET_DEVICE').val(val).trigger('change');
            }
        };

        $('[name="MAX_BEFORE_POWER_B"]').change(function () {
            let val = parseFloat($(this).val());
            if($('[name="MAX_POWER_CONNECT"]').val()) {
                $('.MAX_POWER_EN_GET_DEVICE').val((parseFloat($('[name="MAX_POWER_CONNECT"]').val()) + val).toFixed(2)).trigger('change');
            } else {
                $('.MAX_POWER_EN_GET_DEVICE').val(val).trigger('change');
            }
        });

        $('[name="MAX_POWER_CONNECT"]').change(check_power);
        $('[name="MAX_BEFORE_POWER_B"]').change(check_power);

        $('.form__field-input').change(function () {
            let val = $(this).val(),
                name = $(this).attr('name'),
                target = $('[data-target="'+name+'"]');
            if(target.length > 0) {
                target.hide();
                if(parseFloat(val) > 0) {
                    target.show();
                }
            }
        });

        $('[name="REQUEST_REASON"]').change(function () {
            if($(this).val() === 'Новое технологическое присоединение') {
                $('.hide_reason_new').hide();
                $('[name="MAX_P_RANEE_P[]"], [name="REQU_DOGOVOR[]"]').prop('required', false).val('').trigger('change');
            } else {
                $('.hide_reason_new').show();
                $('[name="MAX_P_RANEE_P[]"], [name="REQU_DOGOVOR[]"]').prop('required', true);
            }
        });

        $('[name="REQUEST_REASONS[]"]').change(function () {

            if($(this).data('id') === 2 && this.checked) {
                $('[name="REQUEST_REASONS[]"]').not(this).attr('disabled','disabled').prop("checked", false);
                $('.hide_reason_new').hide();
                $('[name="MAX_P_RANEE_P[]"], [name="REQU_DOGOVOR[]"]').prop('required', false).val('').trigger('change');
            } else if(!this.checked && $(this).data('id') === 2) {
                $('[name="REQUEST_REASONS[]"]').removeAttr('disabled');
                $('.hide_reason_new').hide();
                $('[name="MAX_P_RANEE_P[]"], [name="REQU_DOGOVOR[]"]').prop('required', false).val('').trigger('change');
            }else if(!this.checked) {
                $('.hide_reason_new').hide();
            }else{
                $('.hide_reason_new').show();
                $('[name="MAX_P_RANEE_P[]"], [name="REQU_DOGOVOR[]"]').prop('required', true);
            }
        });

        $('.dropdown__input').change(function () {
            let list = $(this).parent().find('.dropdown__item'),
                val = $(this).val(),
                name = $(this).attr('name'),
                target = $('[data-target="'+name+'"]');
            if(list.length > 0) {
                list.each(function (i) {
                    if(val === $(this).data('id')) {
                        val = i+1;
                    }
                });

                if(target.length > 0) {
                    target.hide();
                    target.each(function () {
                        var string = $(this).data('val').toString();
                        var arr = string.split(",");

                        for (i=0;i<arr.length;i++) {
                            if(val == arr[i]) {
                                $(this).show();
                            }
                        }

                    })
                }
            }
        });
        
        const validator = function (e) {
            let error = false;
            let errorText = false;
            if($('[name="REQUEST_REASONS[]"]').length > 0) {
                if($('[name="REQUEST_REASONS[]"]:checked').length === 0) {
                    $('[name="REQUEST_REASONS[]"]').parent().parent().addClass('invalid');
                    if (!errorText) {
                        errorText = 'Выберите хотя бы одну причину подачи заявки!';
                    }
                    error = true;
                }
            }

            if($('[name="NAME_OBJECT_CONNECTION"]').length > 0) {
                if($('[name="NAME_OBJECT_CONNECTION"]').val() === '') {
                    $('[name="NAME_OBJECT_CONNECTION"]').addClass('invalid');
                    if (!errorText) {
                        errorText = 'Укажите наименование присоединяемого объекта!';
                    }
                    error = true;
                }
            }

            if($('[name="ADDR_EL_DEVICE"').length > 0) {
                if($('[name="ADDR_EL_DEVICE"]').val() === '') {
                    $('[name="ADDR_EL_DEVICE"]').parent().addClass('invalid');
                    if (!errorText) {
                        errorText = 'Укажите адрес расположения присоединяемого объекта!';
                    }
                    error = true;
                }
            }

            if($('[name="MAP_POINT"').length > 0) {
                if($('[name="MAP_POINT"]').val() === '') {
                    $('[name="MAP_POINT"]').parent().addClass('invalid');
                    if (!errorText) {
                        errorText = 'Выберите точку на карте!';
                    }
                    error = true;
                }
            }
            if($('[name="CONNECT_SCHEMA"]').length > 0) {
                if($('[name="CONNECT_SCHEMA"]').val() === '') {
                    $('[name="CONNECT_SCHEMA"]').parent().addClass('invalid');
                    if (!errorText) {
                        errorText = 'Выберите схему подключения!';
                    }
                    error = true;
                }
            }

            let $timeShemeFrom = $('[name="TIME_SCHEME_FROM"]');
            let $timeShemeTo = $('[name="TIME_SCHEME_TO"]');
            let $timeShemeFromOK = false;
            let $timeShemeToOK = false;
            if($timeShemeFrom.length > 0) {
                if($timeShemeFrom.is(':visible')) {
                    if($timeShemeFrom.val() === '') {
                        $timeShemeFrom.addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите дату!';
                        }
                        error = true;
                    }else{
                         $timeShemeFromOK = true;
                    }
                } else {
                    $timeShemeFrom.val('');
                }
            }
            
            if($timeShemeTo.length > 0) {
                if($timeShemeTo.is(':visible')) {
                    if($timeShemeTo.val() === '') {
                        $timeShemeTo.addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите дату!';
                        }
                        error = true;
                    }else{
                        $timeShemeToOK = true;
                    }
                } else {
                    $timeShemeTo.val('');
                }
            }

            <?/* валидация полей с датами, если одна не может быть позднее другой*/?>
            if ($timeShemeFromOK && $timeShemeToOK) {

                let timeValueFrom = $timeShemeFrom.attr('data-value');
                let timeValueTo = $timeShemeTo.attr('data-value');
             
                if (timeValueFrom > timeValueTo) {
                    $timeShemeTo.addClass('invalid');
                    if (!errorText) {
                        errorText = 'Дата начала периода не может быть позднее даты окончания периода!';
                    }
                    error = true;
                }
            }

            
            if($('[name="MAX_POWER_EN_GET_DEVICE2"]').length > 0) {
                if ($('[name="MAX_POWER_EN_GET_DEVICE2"]').attr('data-type') != 'do150') {
                    if(parseFloat($('[name="MAX_POWER_EN_GET_DEVICE2"]').val()) < 150.01) {
                        $('[name="MAX_POWER_EN_GET_DEVICE2"]').prev().addClass('invalid');
                        if (!errorText) {
                            errorText = 'Мощность должна быть более 150 кВт!';
                        }
                        error = true;
                    }
                } else {
                    if(parseFloat($('[name="MAX_POWER_EN_GET_DEVICE2"]').val()) > 150) {
                        $('[name="MAX_POWER_EN_GET_DEVICE2"]').prev().addClass('invalid');

                        if (!errorText) {
                            errorText = 'Мощность должна быть менее 150 кВт!';
                        }
                        error = true;
                    }
                }
            }
            

            if($('[name="ANOTHER"').length > 0) {
                if($('[name="ANOTHER"]').is(':visible')) {
                    if($('[name="ANOTHER"]').val() === '') {
                        $('[name="ANOTHER"]:visible').addClass('invalid');
                        if (!errorText) {
                            errorText = 'Заполните поле "Иное"!';
                        }
                        error = true;
                    }
                }
            }
            if($('[name="ZAY_CAT_NAD"]').length > 0) {
                if($('[name="ZAY_CAT_NAD"]').val() === '') {
                    $('[name="ZAY_CAT_NAD"]').parent('.js-dropdown').addClass('invalid');
                    if (!errorText) {
                        errorText = 'Выберите категорию!';
                    }
                    error = true;
                }
            }

            if($('[name="R_V_TECH_USLOV_LITS"').length > 0) {
                if($('[name="R_V_TECH_USLOV_LITS"]').is(':visible')) {
                    if($('[name="R_V_TECH_USLOV_LITS"]').val() === '') {
                        $('[name="R_V_TECH_USLOV_LITS"]:visible').addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите номер лицевого счета!';
                        }
                        error = true;
                    }
                }
            }

            if($('[name="MAX_POWER_CONNECT"').length > 0) {
                if($('[name="MAX_POWER_CONNECT"]').is(':visible')) {
                    if($('[name="MAX_POWER_CONNECT"]').val() === '') {
                        $('[name="MAX_POWER_CONNECT"]:visible').addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите присоединемую мощность!';
                        }
                        error = true;
                    }
                }
            }

            if($('[name="MAX_P_USHE_P[]"').length > 0) {
                if($('[name="MAX_P_USHE_P[]"]').is(':visible')) {
                    $('[name="MAX_P_USHE_P[]"]').each(function(i, e) {
                        if($(e).val() === '') {
                            $(e).parent().addClass('invalid');
                            if (!errorText) {
                                errorText = 'Укажите мощность!';
                            }
                            error = true;
                        }
                    });
                }
            }
            if($('[name="MAX_BEFORE_POWER_B"').length > 0) {
                if($('[name="MAX_BEFORE_POWER_B"]').is(':visible')) {
                    if($('[name="MAX_BEFORE_POWER_B"]').val() === '') {
                        $('[name="MAX_BEFORE_POWER_B"]:visible').addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите мощность!';
                        }
                        error = true;
                    }
                }
            }

            if($('[name="NADEZNOST_DIVECE_II"').length > 0) {
                if($('[name="NADEZNOST_DIVECE_II"]').is(':visible')) {
                    if($('[name="NADEZNOST_DIVECE_II"]').val() === '') {
                        $('[name="NADEZNOST_DIVECE_II"]:visible').addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите мощность!';
                        }
                        error = true;
                    }
                }
            }

            if($('[name="ZAYAV_CHAR_NAGR"').length > 0) {
                if($('[name="ZAYAV_CHAR_NAGR"]').val() === '') {
                    $('[name="ZAYAV_CHAR_NAGR"]:visible').addClass('invalid');

                    if (!errorText) {
                        errorText = 'Укажите характер нагрузки!';
                    }
                    error = true;
                }
            }

            if($('[name="NADEZNOST_DIVECE_III"').length > 0) {
                if($('[name="NADEZNOST_DIVECE_III"]').is(':visible')) {
                    if($('[name="NADEZNOST_DIVECE_III"]').val() === '') {
                        $('[name="NADEZNOST_DIVECE_III"]').addClass('invalid');
                        if (!errorText) {
                            errorText = 'Укажите мощность!';
                        }
                        error = true;
                    } else {
                        if (!parseFloat($('[name="NADEZNOST_DIVECE_II"').val())){
                            $('[name="NADEZNOST_DIVECE_II"').val(0);
                        }

                        if(parseFloat($('.all_power_sum:visible').val()) !==
                            (parseFloat($('[name="NADEZNOST_DIVECE_III"').val()) +
                            parseFloat($('[name="NADEZNOST_DIVECE_II"').val()))
                        ) {
                            $('[name="NADEZNOST_DIVECE_III"').addClass('invalid');
                            if (!errorText) {
                                errorText = 'Суммарная мощность отличается от ранее указанной максимальной мощности!';
                            }
                            error = true;
                        }
                    }
                }
            }

            <?/* валидация полей с датами по введению и проектированию, если одна не может быть позднее другой*/?>
            let $srokVvedenia = $('[name="SROK_VVED[]"]');
            let $srokProekta = $('[name="SROK_PROEKT[]"]');

            if ($srokProekta.length > 0) {
                $srokProekta.each(function(index, srokProektaItem){
                    if ($(srokProektaItem).val() !== '') {

                        let srokVvedeniaItem = $(this).closest('.form__row').next().find('input[name="SROK_VVED[]"]');
                        if (srokVvedeniaItem.val() !== '') {

                            let timeValueFrom = srokProektaItem.attr('data-value');
                            let timeValueTo = srokVvedeniaItem.attr('data-value');

                            if (timeValueFrom > timeValueTo) {
                                srokProektaItem.addClass('invalid');
                                if (!errorText) {
                                    errorText = 'Срок проектирования не может быть позднее срока введения!';
                                }
                                error = true;
                            }
                        }
                    }
                })
            }
            console.log('error', error);
            if (error) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                alert(errorText);
                $('html, body').animate({
                    scrollTop: $('.invalid').first().parent().offset().top
                }, 500);
                return false;
            }
            return true;
        }
        document.querySelectorAll('form').forEach((el) => el.addEventListener('validate', validator, {
            once: false,
            capture: true,
            passive: false,
        }));

        <?//   удаление класса invalid при клике на инпут?>
       
        city_zayvka_form.addEventListener('click', function(event){
            let invalid = event.target.closest('.invalid');
            if (!invalid) return;

            invalid.classList.remove('invalid');
        });
        city_zayvka_form.addEventListener('click', function(event){
            let mosh1 = event.target.closest('[name="MAX_P_USHE_P[]"]');
            let mosh2 = event.target.closest('[name="MAX_P_RANEE_P[]"]');
            if (!mosh1 && !mosh2) return;
            
            city_zayvka_form.querySelector('[name="MAX_POWER_EN_GET_DEVICE2"]').parentNode.classList.remove('invalid');
        });

        $('.checkbox_f').change(function () {
            let id = $(this).data('id'),
                name = $(this).attr('name'),
                target = $('[data-target="'+name+'"]');

            if(this.checked) {
                if(target.length > 0) {

                    target.hide();
                    target.each(function () {
                        var string = $(this).data('val').toString();

                        var arr = string.split(",");
                        for (i=0;i<arr.length;i++) {

                            if($('.checkbox_f[data-id="'+arr[i]+'"]').prop("checked") === true) {
                                $(this).show();
                            }

                            if(id == arr[i]) {
                                $(this).show();
                            }
                        }

                    })
                }
            } else {
                if(target.length > 0) {
                    target.hide();
                    target.each(function () {
                        var string = $(this).data('val').toString();
                        var arr = string.split(",");
                        for (i=0;i<arr.length;i++) {
                            if($('.checkbox_f[data-id="'+arr[i]+'"]').prop("checked") === true) {
                                $(this).show();
                            }
                        }

                    })
                }
            }
        })
    })
</script>
<style type="text/css">
    .dis {
        opacity: 0.7;
        pointer-events: none;
    }
</style>
    <div class="content__side">
    <p>
        Уважаемый заявитель! Для подачи заявки на технологическое присоединение к электрическим сетям вам необходимо
        пройти несколько шагов.
    </p>
