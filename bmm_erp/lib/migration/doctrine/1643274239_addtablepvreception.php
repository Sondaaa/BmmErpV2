<?php

class Addtablepvreception extends Doctrine_Migration_Base {

    public function up() {

        // $this->createTable('pvrception', array(
        //     'id' =>
        //     array(
        //         'type' => 'serial',
        //         'fixed' => 0,
        //         'unsigned' => false,
        //         'primary' => true,
        //         'sequence' => 'pvrception_id',
        //     ),
        //     'datepvrecptionprovisoire' =>
        //     array(
        //         'type' => 'date',
        //         'fixed' => 0,
        //         'unsigned' => false,
        //         'notnull' => false,
        //         'primary' => false,
        //         'length' => NULL,
        //         'default' => NULL
        //     ),
        //     'observation' =>
        //     array(
        //         'type' => 'character varying',
        //         'fixed' => 0,
        //         'unsigned' => false,
        //         'notnull' => false,
        //         'primary' => false,
        //         'length' => NULL,
        //         'default' => NULL
        //     ),
        //     'typepv' =>
        //     array(
        //         'type' => 'character varying',
        //         'fixed' => 0,
        //         'unsigned' => false,
        //         'notnull' => false,
        //         'primary' => false,
        //         'length' => NULL,
        //         'default' => NULL
        //     ),
        //     'urldocumentscan' =>
        //     array(
        //         'type' => 'character varying',
        //         'fixed' => 0,
        //         'unsigned' => false,
        //         'notnull' => false,
        //         'primary' => false,
        //         'length' => NULL,
        //         'default' => NULL
        //     ),
        // ));
    }

    public function down() {
        
    }

}
