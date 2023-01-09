<?php

class Addcolonnesalaireouvrier extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->addColumn('salaireouvrier', 'id_affectation', 'character varying');
  }

  public function down()
  {
  }
}
