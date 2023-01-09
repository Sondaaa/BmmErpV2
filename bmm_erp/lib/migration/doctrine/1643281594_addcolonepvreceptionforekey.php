<?php

class Addcolonepvreceptionforekey extends Doctrine_Migration_Base
{
  public function up()
  {
    //   $this->addColumn('pvrception', 'id_lots ', 'integer');
    // $this->createForeignKey('pvrception', 'id_lots', array(
    //   'local' => 'id_lots',
    //   'foreign' => 'id',
    //   'foreignTable' => 'lots',
    //   'onDelete' => 'CASCADE'
    // ));
  }

  public function down()
  {
  }
}
