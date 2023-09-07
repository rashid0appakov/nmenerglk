<?php

namespace lib\core\src\controller;

use Dompdf\Dompdf;
use lib\core\src\model\factory\RequestFactory;
use lib\core\src\model\requests\Requests;
use lib\core\vendor\Controller;

class RequestsController extends Controller {
    /**
     * @param $userType string
     * @param $name string
     */
    public function indexAction($userType, $name) {
        $factory = new \lib\core\src\model\factory\RequestFactory();
        /** @var Requests $request */
        $request = $factory->create($userType, $name);

        if($request) {

            if(isset($_GET['id']) and intval($_GET['id']) > 0) {
                $fields = $request->findById(intval($_GET['id']));
                $request->setFillFields($fields);
            }

            $request->showTemplate();
        }
    }

    /**
     * @param $userType string
     * @param $name string
     * @param $requestData array
     */
    public function saveAction($userType, $name, $requestData) {
        $factory = new RequestFactory();
        /** @var Requests $request */
        $request = $factory->create($userType, $name);

        if($request) {
            $request->save($requestData);
        }
    }
}