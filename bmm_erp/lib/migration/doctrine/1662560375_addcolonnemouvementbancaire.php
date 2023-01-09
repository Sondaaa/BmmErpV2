<?php

class Addcolonnemouvementbancaire extends Doctrine_Migration_Base
{
  public function up()
  {
      // $this->addColumn('mouvementbanciare', 'id_budget', 'integer');
      // $this->createForeignKey('mouvementbanciare', 'id_budget_fkey', array(
      //       'local' => 'id_budget',
      //       'foreign' => 'id',
      //       'foreignTable' => 'titrebudjet',
      //       'onDelete' => 'CASCADE'
      //   ));
  }

  public function down()
  {
  }
}
