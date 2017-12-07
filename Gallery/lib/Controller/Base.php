<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 17.11.17
 * Time: 14:29
 */

namespace Controller;

class Base {

    public function render(string $template, array $data) {

        $view = new \View\Template($template);
        return $view->renderTemplate($data);
    }

    public function isPost() {

        if (count($_POST) > 0) {
            return true;
        }

        return false;
    }

    public function isFileUpload() {

        if (count($_FILES) > 0) {
            return true;
        }

        return false;
    }


}