<?php

class Deletecolonnebureau extends Doctrine_Migration_Base
{
  public function up()
  {
    // $this->dropForeignKey('bureaux', 'fk_id_magasin');
    // $this->removeColumn('bureaux', 'id_magasin');
 
  }

  public function down()
  {
  }
}
