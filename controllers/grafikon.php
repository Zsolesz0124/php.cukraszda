<?php

class Grafikon_Controller {
    public $baseName = 'grafikon';  //meghatározni, hogy melyik oldalon vagyunk

    public function main(array $vars) { // a router által továbbított paramétereket kapja
        $osszTipusModel = new Ossztipus_Model;
        //a modellben belépteti a felhasználót
        $retData = $osszTipusModel->get_data($vars);

        //betöltjük a nézetet
        $view = new View_Loader($this->baseName . "_main");
        foreach ($retData as $name => $value)
            $view->assign($name, $value);
    }
}

?>
