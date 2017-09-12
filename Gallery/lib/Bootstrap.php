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

    // Bekommt URL Eingabe, splittet & speichert diese in Controler, Action und Parameter Angaben
    private function _parseRequest() {
        // Speichert eingegebene URL und trimmt diese /upload/save/ => /upload/save
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Separieren auf 2(Platzhalter weil Url Pfad verschachtelt)+3 Eingaben Controller [/index] Action [/view] Parameter [/id/1/filter/name]
        @list($ordner, $pfad, $controller, $action, $params) = explode('/', $path, 5);

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

    // Umwandeln der URL Eingabe, sodass die jew. Klasse gefunden werden kann & Überprüfen, ob die Klasse vorhanden ist
    private function setController($controller) {
        // \Controller\Upload
        $ctrl = sprintf("\\Controller\\%s", ucfirst(strtolower($controller)));

        if(!class_exists($ctrl)) {
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

        // Formatierung der Eingabe, sodass Methode der Klasse gefunden werden kann
        $actionMethod = sprintf("%sAction", strtolower($action));

        // Überprüfen ob Klasse jeweilige Methode nicht besitzt und ggf dann Fehlermeldung ausgeben
        $reflection = new ReflectionClass($this->_controller);
        if (!$reflection->hasMethod($actionMethod)) {
            throw new InvalidArgumentException(
                "$this->_controller hat keine Action: $action"
            );
        }

        // Wenn keine Fehlermeldung erfolgt, dann Methode setzen
        $this->_action = $actionMethod;
    }

    private function setParams($params) {
        // /index/view/id/1/filter/name
        // params: id => 1, filter => name
        $splitted = explode('/', $params);

        // Überprüfen ob Parameterzahl ungerade, damit das Assoziative Array anschließend korrekt gebildet werden kann
        if (count($splitted) % 2 > 0) {
            throw new InvalidArgumentException("Parameterzahl ungültig!");
        }

        // id/1/filter/name
        // id, 1, filter, name
        $paramArray = array();
        $lastIndex = 0;

        // generiert das Assoziative Array -> Ordnet in einem neuen Array $paramArray jeden modular % ungeraden wert einem geraden Wert zu (id          => 1, filter => name
        for ($i = 0; $i < count($splitted); $i++) {
            if ($i % 2 > 0) {
                $paramArray[$splitted[$lastIndex]] = $splitted[$i];
            }
            $lastIndex = $i;
        }
        $this->_params = $paramArray;
    }

    public function run () {
        // Neues Objekt der Controller Klasse erstellen
        $ctrlObj = new $this->_controller;

        // Aktion Methode aufrufen und ihr die Parameter mit übergeben
        $ctrlObj->{$this->_action}($this->_params);

    }
}