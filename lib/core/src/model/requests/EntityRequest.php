<?php

namespace lib\core\src\model\requests;

/**
 * Юр лицо
 * Class EntityRequest
 * @package lib\core\model\requests
 */
class EntityRequest extends Requests
{

    public function __construct($name)
    {
        parent::__construct($name);
        /**
         * название заявки => id шаблона из Requests->setTemplates
         */
        $this->setRequestTypes([
            'Заявка на тех. присоединение к электрическим сетям свыше 150 кВт' => '4',
            'Заявка на тех. присоединение к электрическим сетям до 150 кВт' => '5',
        ]);
    }
}