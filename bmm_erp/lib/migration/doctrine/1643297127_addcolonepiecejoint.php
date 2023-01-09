<?php

class Addcolonepiecejoint extends Doctrine_Migration_Base {

    public function up() {
        // $this->addColumn('piecejoint', 'id_pvreceptionmarche ', 'integer');
        // $this->createForeignKey('piecejoint', 'id_pvreceptionmarche', array(
        //     'local' => 'id_pvreceptionmarche',
        //     'foreign' => 'id',
        //     'foreignTable' => 'pvrception',
        //     'onDelete' => 'CASCADE'
        // ));
    }

    public function down() {
        
    }

}
