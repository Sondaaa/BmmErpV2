<?php

class Addexeercicetomarcheprevesionelle extends Doctrine_Migration_Base
{
  public function up()
  {
//    $this->addColumn('marche_prevesionelle','id_exercice','integer',10,array());
//    $this->createForeignKey('marche_prevesionelle', 'marche_prevesionelle_id_exercice_id', array(
//      'name' => 'marche_prevesionelle_id_exercice_id',
//      'local' => 'id_exercice',
//      'foreign' => 'id',
//      'foreignTable' => 'exercice',
//      'onUpdate' => NULL,
//      'onDelete' => 'CASCADE',
//      ));
  }

  public function down()
  {
  }
}
