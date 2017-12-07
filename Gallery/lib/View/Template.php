<?php

namespace View;

class Template {
    protected $_tmplFile = null;

    public function __construct(string $tmplFile)
    {
        $this->_tmplFile = $tmplFile;
    }

    public function renderTemplate(array $data)
    {
        extract($data);

        ob_start();
        require_once BASEPATH . '/template/' . $this->_tmplFile;
        $htmlResponse = ob_get_contents();
        ob_end_clean();

        return $htmlResponse;
    }
}