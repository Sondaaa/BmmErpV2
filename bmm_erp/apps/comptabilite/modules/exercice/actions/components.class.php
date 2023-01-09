<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of components
 *
 * @author Bilel
 */
class exerciceComponents extends sfComponents {

    public function executeListeExercice() {
        $this->exercices = ExerciceTable::getInstance()->findAll();
    }

}

?>
