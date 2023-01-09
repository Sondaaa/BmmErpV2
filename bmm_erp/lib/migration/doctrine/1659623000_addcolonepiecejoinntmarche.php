<?php

class Addcolonepiecejoinntmarche extends Doctrine_Migration_Base
{
  public function up()
  {
      //  $this->addColumn('piecejoint', 'id_marche ', 'integer');
      //   $this->createForeignKey('piecejoint', 'id_marche', array(
      //       'local' => 'id_marche',
      //       'foreign' => 'id',
      //       'foreignTable' => 'marches',
      //       'onDelete' => 'CASCADE'
      //   ));
  }

  public function down()
  {
  }
}
