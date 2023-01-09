<?php

class Addtablelignedoctransfert extends Doctrine_Migration_Base
{
  public function up()
  {
  //     $this->createTable('lignedocumenttransfert', array(
  //     'id' =>
  //     array(
  //       'type' => 'serial',
  //       'fixed' => 0,
  //       'unsigned' => false,
  //       'primary' => true,
  //       'sequence' => 'lignedocumenttransfert_id',
  //     ),
  //     'id_immo' =>
  //     array(
  //       'type' => 'integer',
  //       'fixed' => 0,
  //       'unsigned' => false,
  //       'notnull' => false,
  //       'primary' => false,
  //       'length' => NULL,
  //       'default' => NULL
  //     ),
  //     'id_documenttransfert' =>
  //     array(
  //       'type' => 'integer',
  //       'fixed' => 0,
  //       'unsigned' => false,
  //       'notnull' => false,
  //       'primary' => false,
  //       'length' => NULL,
  //       'default' => NULL
  //     ),
  //     'id_local1' =>
  //     array(
  //       'type' => 'integer',
  //       'fixed' => 0,
  //       'unsigned' => false,
  //       'notnull' => false,
  //       'primary' => false,
  //       'length' => NULL,
  //       'default' => NULL
  //     ),
  //     'id_local2' =>
  //     array(
  //       'type' => 'integer',
  //       'fixed' => 0,
  //       'unsigned' => false,
  //       'notnull' => false,
  //       'primary' => false,
  //       'length' => NULL,
  //       'default' => NULL
  //     ),
  //     'id_curenttransfert' =>
  //     array(
  //       'type' => 'integer',
  //       'fixed' => 0,
  //       'unsigned' => false,
  //       'notnull' => false,
  //       'primary' => false,
  //       'length' => NULL,
  //       'default' => NULL
  //     ),
  //   ));

  //   $this->createForeignKey('lignedocumenttransfert', 'id_curenttransfert', array(
  //     'local' => 'id_curenttransfert',
  //     'foreign' => 'id',
  //     'foreignTable' => 'Emplacement',
  //     'onDelete' => 'CASCADE'
  //   ));

  //   $this->createForeignKey('lignedocumenttransfert', 'id_local1', array(
  //     'local' => 'id_local1',
  //     'foreign' => 'id',
  //     'foreignTable' => 'Bureaux',
  //     'onDelete' => 'CASCADE'
  //   ));

  //   $this->createForeignKey('lignedocumenttransfert', 'id_local2', array(
  //     'local' => 'id_local2',
  //     'foreign' => 'id',
  //     'foreignTable' => 'Bureaux',
  //     'onDelete' => 'CASCADE'
  //   ));
  //   $this->createForeignKey('lignedocumenttransfert', 'id_immo', array(
  //     'local' => 'id_immo',
  //     'foreign' => 'id',
  //     'foreignTable' => 'Immobilisation',
  //     'onDelete' => 'CASCADE'
  //   ));

  //   $this->createForeignKey('lignedocumenttransfert', 'id_documenttransfert', array(
  //     'local' => 'id_documenttransfert',
  //     'foreign' => 'id',
  //     'foreignTable' => 'Documenttransfert',
  //     'onDelete' => 'CASCADE'
  //   ));
  //      $this->addColumn('documenttransfert','type','character varying');
  // $this->addColumn('lignedocumenttransfert','id_organisme','integer');
  // $this->createForeignKey('lignedocumenttransfert', 'lignedocumenttransfert_id_organisme', array(
  //   'name' => 'lignedocumenttransfert',
  //   'local' => 'id_organisme',
  //   'foreign' => 'id',
  //   'foreignTable' => 'organisme',
  //   'onUpdate' => null,
  //   'onDelete' => 'CASCADE',
  // ));
  // $this->addColumn('lignedocumenttransfert','id_user','integer');
  //   $this->createForeignKey('lignedocumenttransfert', 'lignedocumenttransfert_id_user', array(
  //     'name' => 'lignedocumenttransfert',
  //     'local' => 'id_user',
  //     'foreign' => 'id',
  //     'foreignTable' => 'agents',
  //     'onUpdate' => null,
  //     'onDelete' => 'CASCADE',
  //   ));
    
  //      $this->addColumn('lignedocumenttransfert','datetransfert','date');
  //   $this->addColumn('lignedocumenttransfert','dateretur','date');
  }

  public function down()
  {
  }
}
