

<div class="form__row">
    <div class="form__col form__col_full">
        <div class="seconfary-title form__row_title">
            Документы
        </div>
    </div>
</div>

<div class="form__row DOGOVOR_EN_KU_PRO" style="display: none">
    <div class="form__col form__col_full">
        <div class="form__field">
            <div class="form__field-label">
                Договор энергоснабжения (купли-продажи (поставки) электрической энергии (мощности)
            </div>
            <div class="form__field-row">
                <div class="upload-files">
                    <div class="upload-files__fields"></div>
                    <div class="upload-files__items"></div>
                    <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOGOVOR_EN_KU_PRO">загрузить файл</span>
                </div>
            </div>
        </div>
    </div>
</div>


<?if($userInfo['UF_ACC_TYPE'] === '1'): // индивидуальный п. ?>
    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="form__field">
                <div class="form__field-label">
                    Регистрационное свидетельство, копия паспорта.
                </div>
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="REG_SVID_PAS_COPY">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?elseif($userInfo['UF_ACC_TYPE'] === '2'):// физ лицо?>
    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="form__field">
                <div class="form__field-label">
                    Копия паспорта
                </div>
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="PASPORT_COPY">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?else: // юр лицо?>
    <div class="form__row">
        <div class="form__col form__col_full">
            <div class="form__field">
                <div class="form__field-label">
                    Документы, подтверждающие правовой статус: учредительные документы организации; свидетельство, подтверждающее внесение организации в единый реестр ЕГРЮЛ; свидетельство ИНН; документы, удостоверяющие полномочия заявителя;
                    доверенности (при наличии).
                </div>
                <div class="form__field-row">
                    <div class="upload-files">
                        <div class="upload-files__fields"></div>
                        <div class="upload-files__items"></div>
                        <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOC_POS_PRAV_STATUS">загрузить файл</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>

<div class="form__row">
    <div class="form__col form__col_full">
        <div class="form__field">
            <div class="form__field-label">
                План расположения энергопринимающих устройств, которые необходимо присоединить к электрическим сетям сетевой организации (выкопировка в масштабе, позволяющем определить расстояние от границ земельного участка заявителя до объектов электросетевого хозяйства).

            </div>
            <div class="form__field-row">
                <div class="upload-files">
                    <div class="upload-files__fields"></div>
                    <div class="upload-files__items"></div>
                    <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOC_PLAN">загрузить файл</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form__row mt-20">
    <div class="form__col form__col_full">
        <div class="form__field">
            <div class="form__field-label">
                Копия документа, подтверждающего право собственности или иное предусмотренное законом основание на объект капитального строительства и (или) земельный участок, на котором расположены (будут располагаться) объекты заявителя, либо право собственности или иное предусмотренное законом основание на энергопринимающие устройства.


            </div>
            <div class="form__field-row">
                <div class="upload-files">
                    <div class="upload-files__fields"></div>
                    <div class="upload-files__items"></div>
                    <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOC_COPY_PRAVO">загрузить файл</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form__row mt-20">
    <div class="form__col form__col_full">
        <label class="form__radio">
            <input type="checkbox" class="form__radio-hidden" name="CONNECT_DEVICE_COOP" value="Осуществляется присоединение устройств, принадлежащих потребительскому кооперативу (гаражно-строительному, гаражному кооперативу) либо его членам">
            <span class="form__radio-input"></span>
            <span class="form__radio-value">
                        Осуществляется присоединение устройств, принадлежащих потребительскому кооперативу (гаражно-строительному, гаражному кооперативу) либо его членам
                    </span>
        </label>
    </div>
</div>
<div class="form__row mt-20">
    <div class="form__col form__col_full">
        <label class="form__radio">
            <input type="checkbox" class="form__radio-hidden" name="CONNECT_DEVICE_OBJECT" value="Осуществляется присоединение устройств, принадлежащих потребительскому кооперативу (гаражно-строительному, гаражному кооперативу) либо его членам">
            <span class="form__radio-input"></span>
            <span class="form__radio-value">
                        Осуществляется присоединение устройств на объекте / земельном участке, правоустанавливающие документы которого подразумевают долевую / совместную собственность

                    </span>
        </label>
    </div>
</div>
<div class="form__row mt-20">
    <div class="form__col form__col_full">
        <div class="form__field">
            <div class="form__field-label">
                Доверенность или иные документы, подтверждающие полномочия представителя заявителя, подающего и получающего документы (в том числе подтверждающие полномочия выдавшего доверенность лица), в случае если заявка подается в сетевую организацию представителем заявителя.
            </div>
            <div class="form__field-row">
                <div class="upload-files">
                    <div class="upload-files__fields"></div>
                    <div class="upload-files__items"></div>
                    <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOC_DOV_UP_Z">загрузить файл</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form__row mt-20">
    <div class="form__col form__col_full">
        <div class="form__field">
            <div class="form__field-label">
                Перечень энергопринимающих устройств
            </div>
            <div class="form__field-row">
                <div class="upload-files">
                    <div class="upload-files__fields"></div>
                    <div class="upload-files__items"></div>
                    <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="PERECHEN_ENERG_DEVICE">загрузить файл</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form__row mt-20">
    <div class="form__col form__col_full">
        <div class="form__field">
            <div class="form__field-label">
                Дополнительные материалы, которые вы считаете необходимыми
            </div>
            <div class="form__field-row">
                <div class="upload-files">
                    <div class="upload-files__fields"></div>
                    <div class="upload-files__items"></div>
                    <span class="btn btn_white btn_upload js-upload-with-sign" style="margin-top:0px;" data-name="DOP_MATERIALS_N">загрузить файл</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="render_pdf_html" style="display: none"></div>