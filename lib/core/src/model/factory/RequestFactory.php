<?php
namespace lib\core\src\model\factory;


use lib\core\src\model\requests\EntityRequest;
use lib\core\src\model\requests\IndividualEntrepreneurRequest;
use lib\core\src\model\requests\IndividualRequest;
use lib\core\src\model\requests\Requests;

class RequestFactory {
    /**
     * @param $userType
     * @return bool|Requests
     */
    public function create($userType, $name) {

        switch ($userType) {
            case 'Индивидуальный предприниматель':
                return new IndividualEntrepreneurRequest($name);
                break;
            case 'Физическое лицо':
                return new IndividualRequest($name);
                break;
            case 'Юридическое лицо':
                return new EntityRequest($name);
                break;

        }

        return false;
    }
}