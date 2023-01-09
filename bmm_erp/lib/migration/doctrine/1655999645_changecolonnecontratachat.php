<?php

class Changecolonnecontratachat extends Doctrine_Migration_Base
{
  public function up()
  {
       $this->removeColumn('contratachat','dateoservice');
       $this->addColumn('contratachat','dateoservice','date');
  }

  public function down()
  {
  }
}
