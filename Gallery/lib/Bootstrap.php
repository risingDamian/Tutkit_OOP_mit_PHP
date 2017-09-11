<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 11.09.17
 * Time: 15:30
 */

class Bootstrap
{
    // /upload => upload
    private $_controller = "";

    // /upload/save => save
    private $_action = "";

    // /image/delete/id/1 => id/1
    private $_params = array();

    public function __construct()
    {
        $this->_parseRequest();
    }

    private function _parseRequest() {
        // /upload/save/ => /upload/save
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // /index/view/id/1/filter/name
        @list($controller, $action, $params) = explode('/', $path, 3);

        // Controller länge größer als 0? Dann nutze $controller sonst : nehme 'index'
        // http://localhost/ => http://localhost/index/index
        $controller = (strlen($controller) > 0) ? $controller : 'index';
        $this->setController($controller);

        // action?
        $action = (strlen($action) > 0) ? $action : 'index';
        $this->setAction($action);

        // parameter?
        if (isset($params)) {
            $this->setParams($params);
        }

    }

    private function setController($controller) {
        // \Controller\Upload
        $ctrl = sprintf("\\Controller\\%s", ucfirst(strtolower($controller)));

        if(!class_exists($this->_controller)) {
            throw new InvalidArgumentException(
                "Controller unbekannt: $ctrl"
            );
        }
        $this->_controller = $ctrl;
    }

    private function setAction($action) {
        // welche Methode in Klasse xyz?
        
        // /upload/save/
        // \Controller\Upload::saveAction()

        $actionMethod = sprintf("%sAction", strtolower($action));
        $reflection = new ReflectionClass($this->_controller);

        if (!$reflection->hasMethod($actionMethod)) {
            throw new InvalidArgumentException(
                "$this->_controller hat keine Action: $action"
            );
        }
        $this->_action = $actionMethod;
    }

    private function setParams($params) {
        //TODO Parameter verarbeiten
    }

    public function run () {

        // TODO: ausführen
    }
}