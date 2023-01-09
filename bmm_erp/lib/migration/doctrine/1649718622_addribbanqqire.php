<?php

class Addribbanqqire extends Doctrine_Migration_Base
{
  public function up()
  {
//    $this->createTable('ribbancaire', array(
//      'id' =>
//      array(
//        'type' => 'serial',
//        'fixed' => 0,
//        'unsigned' => false,
//        'primary' => true,
//        'sequence' => 'ribbancaire_id',
//      ),
//      'rib' =>
//      array(
//        'type' => 'character varying',
//        'fixed' => 0,
//        'unsigned' => false,
//        'notnull' => false,
//        'primary' => false,
//        'length' => NULL,
//        'default' => NULL
//      ),
//      'etat' =>
//      array(
//        'type' => 'character varying',
//        'fixed' => 0,
//        'unsigned' => false,
//        'notnull' => false,
//        'primary' => false,
//        'length' => NULL,
//        'default' => NULL
//      ),
//      'banque_id' =>
//      array(
//        'type' => 'integer',
//        'fixed' => 0,
//        'unsigned' => false,
//        'notnull' => false,
//        'primary' => false,
//        'length' => NULL,
//        'default' => NULL
//      ),
//      'naturebanque_id' =>
//      array(
//        'type' => 'integer',
//        'fixed' => 0,
//        'unsigned' => false,
//        'notnull' => false,
//        'primary' => false,
//        'length' => NULL,
//        'default' => NULL
//      ),
//      'frs_id' =>
//      array(
//        'type' => 'integer',
//        'fixed' => 0,
//        'unsigned' => false,
//        'notnull' => false,
//        'primary' => false,
//        'length' => NULL,
//        'default' => NULL
//      ),
//    ));
//    $this->createForeignKey('ribbancaire', 'ribbancaire_frs_id', array(
//             'name' => 'ribbancaire_frs_id',
//             'local' => 'frs_id',
//             'foreign' => 'id',
//             'foreignTable' => 'fournisseur',
//             'onUpdate' => NULL,
//             'onDelete' => NULL,
//             ));
//        $this->createForeignKey('ribbancaire', 'ribbancaire_naturebanque_id', array(
//             'name' => 'ribbancaire_naturebanque_id',
//             'local' => 'naturebanque_id',
//             'foreign' => 'id',
//             'foreignTable' => 'naturebanque',
//             'onUpdate' => NULL,
//             'onDelete' => NULL,
//             ));
//        $this->createForeignKey('ribbancaire', 'ribbancaire_banque_id', array(
//             'name' => 'ribbancaire_banque_id',
//             'local' => 'banque_id',
//             'foreign' => 'id',
//             'foreignTable' => 'banque',
//             'onUpdate' => NULL,
//             'onDelete' => NULL,
//             ));
  }

  public function down()
  {
    $this->dropTable('ribbancaire');
  }
}
