<?php

class Addtabledoctransfertimm extends Doctrine_Migration_Base
{
  public function up()
  {
    //           $this->addColumn('immobilisation', 'id_marque', 'integer');
    //     $this->createForeignKey('immobilisation', 'immobilisation_id_marque', array(
    //         'name' => 'immobilisation',
    //         'local' => 'id_marque',
    //         'foreign' => 'id',
    //         'foreignTable' => 'marqueimmobilisation',
    //         'onUpdate' => null,
    //         'onDelete' => 'CASCADE',
    //     ));
        
        
        
    //     $this->createTable('documenttransfert', array(
    //   'id' =>
    //   array(
    //     'type' => 'serial',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'primary' => true,
    //     'sequence' => 'documenttransfert_id',
    //   ),
    //   'id_immo' =>
    //   array(
    //     'type' => 'integer',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
    //   'libelle' =>
    //   array(
    //     'type' => 'character varying',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
    //   'created_at' =>
    //   array(
    //     'type' => 'timestamp',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
    //   'updated_at' =>
    //   array(
    //     'type' => 'timestamp',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
    //   'id_user' =>
    //   array(
    //     'type' => 'integer',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
      
    //   'id_typetransfert' =>
    //   array(
    //     'type' => 'integer',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),

    //   'etat_transfert' =>
    //   array(
    //     'type' =>  'character varying',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
     
    //   'description' =>
    //   array(
    //     'type' =>  'character varying',
    //     'fixed' => 0,
    //     'unsigned' => false,
    //     'notnull' => false,
    //     'primary' => false,
    //     'length' => NULL,
    //     'default' => NULL
    //   ),
      
    // ));

    // $this->createForeignKey('documenttransfert', 'id_user', array(
    //   'local' => 'id_user',
    //   'foreign' => 'id',
    //   'foreignTable' => 'Utilisateur',
    //   'onDelete' => 'CASCADE'
    // ));

    // $this->createForeignKey('documenttransfert', 'id_typetransfert', array(
    //   'local' => 'id_typetransfert',
    //   'foreign' => 'id',
    //   'foreignTable' => 'Typeaffectationimmo',
    //   'onDelete' => 'CASCADE'
    // ));
  }

  public function down()
  {
  }
}
