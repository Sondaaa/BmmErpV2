<?php

class Addcolonedocumentachat extends Doctrine_Migration_Base {

    public function up() {

//        $this->addColumn('documentachat', 'fodec', 'boolean');
//        $this->addColumn('documentachat', 'droittimbre', 'character vayring');
//        $this->addColumn('lignedocachat', 'mntfodec', 'numeric');
//        $this->addColumn('lignedocachat', 'mntthtva', 'numeric');
        //tauxfodec
//         $this->addColumn('lignedocachat', 'id_tauxfodec', 'integer');

//        $this->addIndex('lignedocachat', 'lignedocachat_id_tauxfodec_fkey', array(
//            'fields' => array('id_tauxfodec')
//        ));
//        $this->createForeignKey('lignedocachat', 'lignedocachat_id_tauxfodec_fkey', array(
//            'local' => 'id_tauxfodec',
//            'foreign' => 'id',
//            'foreignTable' => 'tauxfodec',
//            'onDelete' => 'CASCADE'
//        ));
    }

    public function down() {
        
    }

}
