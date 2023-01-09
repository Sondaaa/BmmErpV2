<?php

class Addcollonnedocachat extends Doctrine_Migration_Base
{
  public function up()
  {
        // $this->addColumn('documentachat', 'id_droittimbre ', 'integer');
        //  $this->createForeignKey('documentachat', 'id_droittimbre', array(
        //      'local' => 'id_droittimbre',
        //      'foreign' => 'id',
        //      'foreignTable' => 'droittimbre',
        //      'onDelete' => 'CASCADE'
        //  ));
  }

  public function down()
  {
  }
}
