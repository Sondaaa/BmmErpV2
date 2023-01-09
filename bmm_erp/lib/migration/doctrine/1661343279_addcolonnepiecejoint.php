<?php

class Addcolonnepiecejoint extends Doctrine_Migration_Base
{
  public function up()
  {
    //   $this->addColumn('piecejoint', 'id_parametragesociete ', 'integer');
    // $this->createForeignKey('piecejoint', 'id_parametragesociete', array(
    //   'local' => 'id_parametragesociete',
    //   'foreign' => 'id',
    //   'foreignTable' => 'parametragesociete',
    //   'onDelete' => 'CASCADE'
    // ));
    //  $this->addColumn('piecejoint', 'id_fichederogation ', 'integer');
    // $this->createForeignKey('piecejoint', 'id_fichederogation', array(
    //   'local' => 'id_fichederogation',
    //   'foreign' => 'id',
    //   'foreignTable' => 'documentachat',
    //   'onDelete' => 'CASCADE'
    // ));
   
  }

  public function down()
  {
  }
}
