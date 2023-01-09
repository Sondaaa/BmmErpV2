<?php

class Addtable extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createTable('salairejournalier', array(
                 'id' =>
                 array(
                     'type' => 'serial',
                     'fixed' => 0,
                     'unsigned' => false,
                     'primary' => true,
                     'sequence' => 'salairejournalier_id',
                     'length' => NULL,
                 ),
                 'montant' =>
                 array(
                     'type' => 'numeric (18,3)',
                     'fixed' => 0,
                     'unsigned' => false,
                     'notnull' => false,
                     'primary' => false,
                     'length' => NULL,
                     'default' => NULL
                 ), ), array(
                 'indexes' =>
                 array(
                 ),
                 'primary' =>
                 array(
                     0 => 'id',
                 ),
                 'charset' => 'UTF8',
             ));
             $this->addColumn('contratouvrier', 'id_salairejouralier', 'integer');
             $this->createForeignKey('contratouvrier', 'id_salairejouralier', array(
                 'local' => 'id_salairejouralier',
                 'foreign' => 'id',
                 'foreignTable' => 'salairejournalier',
                 'onDelete' => 'CASCADE'
             ));
             
  }

  public function down()
  {
  }
}
