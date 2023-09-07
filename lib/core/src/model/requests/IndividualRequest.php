<?php

namespace lib\core\src\model\requests;

/**
 * Физ лицо
 * Class IndividualRequest
 * @package lib\core\model\requests
 */
class IndividualRequest extends Requests
{
    public function __construct($name)
    {
        parent::__construct($name);

        /**
         * название заявки => id шаблона из Requests->setTemplates
         */
        $this->setRequestTypes([
            'Заявка на тех. присоединение к электрическим сетям для физ. лиц до 15 кВт' => '0',
            'Заявка на тех. присоединение к электрическим сетям для физ. лиц от 15 до 150 кВт' => '1',
            'Заявка на тех. присоединение к электрическим сетям свыше 150 кВт' => '2',
        ]);
    }
}