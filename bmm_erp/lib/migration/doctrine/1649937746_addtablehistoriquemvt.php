<?php

class Addtablehistoriquemvt extends Doctrine_Migration_Base {

    public function up() {
//        $this->createTable('historiquemouvement', array(
//            'id' =>
//            array(
//                'type' => 'serial',
//                'fixed' => 0,
//                'unsigned' => false,
//                'primary' => true,
//                'sequence' => 'historiquemouvement_id',
//                'length' => NULL,
//            ),
//            'etatfrs' =>
//            array(
//                'type' => 'character varying',
//                'fixed' => 0,
//                'unsigned' => false,
//                'notnull' => false,
//                'primary' => false,
//                'length' => NULL,
//                'default' => NULL
//            ),
//            'id_frs' =>
//            array(
//                'type' => 'integer',
//                'length' => NULL,
//            ),
//            'id_lignemvt' =>
//            array(
//                'type' => 'integer',
//                'length' => NULL,
//            )), array(
//            'indexes' =>
//            array(
//            ),
//            'primary' =>
//            array(
//                0 => 'id',
//            ),
//            'charset' => 'UTF8',
//        ));
//        $this->createForeignKey('historiquemouvement', 'id_frs', array(
//            'local' => 'id_frs',
//            'foreign' => 'id',
//            'foreignTable' => 'fournisseur',
//            'onDelete' => 'CASCADE'
//        ));
//        $this->createForeignKey('historiquemouvement', 'id_lignemvt', array(
//            'local' => 'id_lignemvt',
//            'foreign' => 'id',
//            'foreignTable' => 'lignemouvementfacturation',
//            'onDelete' => 'CASCADE'
//        ));
//        
//        $this->addColumn('lignemouvementfacturation', 'etatfrs ', 'character varying');
        
    }

    public function down() {
        
    }

}
