<?php

class Updateactivitetiers extends Doctrine_Migration_Base
{
  public function up()
  {
//    $this->addColumn('activitetiers','parent_id','integer');
//      $this->createForeignKey('activitetiers', 'activitetiers_parent_id', array(
//      'name' => 'activitetiers_parent_id',
//      'local' => 'parent_id',
//      'foreign' => 'id',
//      'foreignTable' => 'activitetiers',
//      'onUpdate' => NULL,
//      'onDelete' => NULL,
//      ));
  }

  public function down()
  {
  }
}
