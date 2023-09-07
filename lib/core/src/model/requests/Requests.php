<?php

namespace lib\core\src\model\requests;

use lib\core\src\helpers\RequestHelper;
use lib\core\src\model\Model;

abstract class Requests extends Model
{
    /**
     * Requests constructor.
     * @param $name
     */
    public function __construct($name)
    {

        parent::__construct();

        $this->setName($name);

        $this->setTemplates(
            [
                '0' => '01_fl_do_15.php',
                '1' => 'fl_ot_15_do150.php',
                '2' => 'svishe_150.php',
                '3' => 'ur_ot_15_do150.php',
                '4' => 'ur_svishe_150.php',
                '5' => 'ur_do_150.php',
            ]
        );
    }

    public $fillFields;

    public static function incoming_files($files = null, $recursion = false)
    {
        $has_array = false;
        $result = [];
        foreach ($files ?? $_FILES as $input => $infoArr) {
            $filesByInput = [];
            foreach ($infoArr as $key => $valueArr) {
                if (is_array($valueArr)) { // file input "multiple"
                    $has_array = true;
                    foreach ($valueArr as $i => $value) {
                        $filesByInput[$i][$key] = $value;
                    }
                } else { // -> string, normal file input
                    $filesByInput[] = $infoArr;
                    break;
                }
            }
            $result[$input] = array_filter($filesByInput, fn($file) => !isset($file['error']) || !$file['error'] || is_array($file['error']));
        }
        if ($has_array && $recursion) {
            foreach ($result as $key => $files) {
                $result[$key] = self::incoming_files($files, $recursion);
            }
        }
        return $result;
    }

    /**
     * @param $data
     */
    public function save($data)
    {
        $post = $data['POST'];
        $files = self::incoming_files();
        $fields = $this->getFields();
        $el = new \CIBlockElement;
        unset($post['send_form_request']);
        unset($post['privacy_politic']);
        $props = [];
        foreach ($post as $postCode => $postItem) {
            if (!isset($fields[$postCode])) {
                continue;
            }
            if ($fields[$postCode]['PROPERTY_TYPE'] === 'F' && $postCode !== 'docs') {
                continue;
            }
            if (!$postItem) {
                continue;
            }

            $props[$fields[$postCode]['ID']] = is_array($postItem) ? $postItem : trim($postItem);
        }
        foreach ($files as $fileCode => $file) {
            if (!isset($fields[$fileCode])) continue;
            if (!is_array($file)) {
                $file = [$file];
            }
            if (!isset($props[$fields[$fileCode]['ID']])) {
                $props[$fields[$fileCode]['ID']] = [];
            }
            $props[$fields[$fileCode]['ID']] = array_merge($props[$fields[$fileCode]['ID']], $file);
        }

        if (isset($_POST['send_form_request_epc'])) {
            $props['36'] = 'Y'; // С ЭЦП ?
        }
        $props['9'] = '940'; // статус на рассмотрении

        global $USER;
        $arLoadProductArray = array(
            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
            "IBLOCK_SECTION_ID" => $_REQUEST['SECTION_ID'], // элемент лежит в корне раздела
            "IBLOCK_ID" => REQUEST_BLOCK_ID, // id инфоблока
            "PROPERTY_VALUES" => $props, // поля
            "NAME" => "Заявка на ТП", // название потои меняется в init.php
            "ACTIVE" => "Y",            // активен
        );

        if ($newId = $el->Add($arLoadProductArray)) {
            LocalRedirect('/personal/order/?id=' . $newId);
            exit();
        }
    }

    /**
     * @return mixed
     */
    public function getFillFields()
    {
        return $this->fillFields;
    }

    /**
     * @param mixed $fillFields
     */
    public function setFillFields($fillFields)
    {
        $this->fillFields = $fillFields;
    }

    /**
     * include $template by id in $templates
     */
    public function showTemplate()
    {
        $types = $this->getRequestTypes();
        if (isset($types[$this->getName()])) {
            $templateId = $types[$this->getName()];


            $template = $this->getTemplates()[$templateId];
//            var_dump($template);

            $helper = new RequestHelper();
            $userInfo = $helper->getUserInfo();
            $fields = $this->getFields();
            $fillFields = $this->getFillFields();


            /**
             * tpl - string
             * data - array
             */
            $this->viewTemplate(
                __DIR__ . '/../../view/requests/' . $template,
                [
                    'topForm' => $this->getUserTopForm($userInfo),
                    'userInfo' => $userInfo,
                    'fields' => $fields,
                    'helper' => $helper,
                    'fillFields' => $fillFields
                ]
            );
        }
    }

    private function getUserTopForm($userInfo)
    {
        switch ($userInfo['UF_ACC_TYPE']) {
            case 1:
                return 'zayzvitel_ip.php';
                break;
            case 2:
                return 'zayzvitel_fi.php';
                break;
            case 3:
                return 'zayzvitel_ur.php';
                break;
        }
    }

    /** @var string */
    public $userType;

    /** @var array */
    public $requestTypes = [];
    /**
     * @var array шаблоны запросов
     * template id => template file
     */
    public $templates;

    /**
     * @return array
     */
    public function getRequestTypes()
    {
        return $this->requestTypes;
    }

    /**
     * @param array $requestTypes
     */
    public function setRequestTypes($requestTypes)
    {
        $this->requestTypes = $requestTypes;
    }

    /**
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @param array $templates
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;
    }
}