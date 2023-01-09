<?php

class Changecoluncodebureauxandaddcolonneidsite extends Doctrine_Migration_Base
{
  public function up()
  {
    // $this->changeColumn('bureaux','code','character varying');
    // $this->addColumn('bureaux', 'id_site ', 'integer');
    // $this->createForeignKey('bureaux', 'id_site', array(
    //   'local' => 'id_site',
    //   'foreign' => 'id',
    //   'foreignTable' => 'site',
    //   'onDelete' => 'CASCADE'
    // ));
  }

  public function down()
  {
  }
}
