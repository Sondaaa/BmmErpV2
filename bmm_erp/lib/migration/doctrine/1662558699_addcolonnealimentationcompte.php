<?php

class Addcolonnealimentationcompte extends Doctrine_Migration_Base
{
  public function up()
  {
      // $this->addColumn('Alimentationcompte', 'id_titrebudget', 'integer');
      //   $this->createForeignKey('Alimentationcompte', 'id_titrebudget_fkey', array(
      //       'local' => 'id_titrebudget',
      //       'foreign' => 'id',
      //       'foreignTable' => 'titrebudjet',
      //       'onDelete' => 'CASCADE'
      //   ));
    }

  public function down()
  {
  }
}
