<?php
namespace lib\core\src\helpers;


use lib\core\src\controller\RequestsController;
use lib\core\src\model\factory\RequestFactory;
use lib\core\src\model\requests\Requests;

class RequestHelper
{
    /** @var $types array */
    public $types = [];
    /** @var $sections array */
    public $sections = [];
    public $sectionCurrent = [];

    /**
     * маршрутизатор по Requests
     */
    public function routeFunction() {
        $arUser = $this->getUserInfo(); // данные пользователя
        $userType = $this->getValById($arUser['UF_ACC_TYPE']); // тип пользователя: юр/физ/пр.п лицо

        if(!isset($_REQUEST["SECTION_ID"])) {
            $this->setAvailableTypes($userType);
        } else {
            if(!empty($_POST) and (isset($_POST['iblock_submit']))) {
                // Сохраняем данные saveAction
                $requestController = new RequestsController();
                $requestController->saveAction($userType, $this->getSectionCurrent()['NAME'], ['POST' => $_POST, 'FILES' => $_FILES]);
            } else {
                // Выводим форму запроса если нет $_REQUEST["type"]
                $requestController = new RequestsController();
                $requestController->indexAction($userType, $this->getSectionCurrent()['NAME']);
            }
        }
    }

    public function setTypes($types) {
        return $this->types = $types;
    }
    public function getTypes() {
        return $this->types;
    }
    public function setSectionCurrent($sectionCurrent) {
        return $this->sectionCurrent = $sectionCurrent;
    }
    public function getSectionCurrent() {
        return $this->sectionCurrent;
    }

    private function setAvailableTypes($userType) {
        $types = [];
        $factory = new RequestFactory();
        foreach ($this->sections as $section) {
            $request = $factory->create($userType, $section['NAME']);
            if(isset($request->getRequestTypes()[$section['NAME']])) {
                $types[$section['ID']] = $section['NAME'];
            }
        }

        $this->setTypes($types);
    }

    /**
     * @return array
     */
    public function getUserInfo($id = false) {
        if (!$id) {
            global $USER;
            $id = $USER->GetID();
        }
        $data = \CUser::GetList(($by="ID"), ($order="ASC"),
            array(
                'ID' => $id,
                'ACTIVE' => 'Y'
            ),
            array("SELECT"=>array("UF_*"))
        );

        $userInfo = $data->Fetch();

//        $userInfo['PERSONAL_STREET'] = 'ул. ' . $userInfo['PERSONAL_STREET'];
//        $streetArr = explode(',', $userInfo['PERSONAL_STREET']);
//        if(count($streetArr) > 2) {
//
//            $streetArr[1]  = ' дом' . $streetArr[1];
//            $streetArr[2]  = ' корпус ' . $streetArr[2];
//            $streetArr[3]  = ' квартира/офис ' . $streetArr[3];
//
//            $userInfo['PERSONAL_STREET'] = implode(',', $streetArr);
//        }

        return $userInfo;
    }

    /**
     * @param integer $id
     * @return bool|string|integer
     */
    public function getValById($id) {
        $vals = \CUserFieldEnum::GetList(array(), array("ID" => $id));
        if($val = $vals->GetNext()) {
            return $val["VALUE"];
        }
        return false;
    }
}