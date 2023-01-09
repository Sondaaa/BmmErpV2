<?php

class Changelibelletostringvaringbudget extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->changeColumn('titrebudjet','libelle','character varying');
  }

  public function down()
  {
  }
}
