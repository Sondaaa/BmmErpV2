<?php

class Addcolonnefournisseur extends Doctrine_Migration_Base
{
  public function up()
  { 
      // $this->addColumn('fournisseur', 'created_at', 'date');
      // $this->addColumn('fournisseur', 'updated_at', 'date');
      //  $this->addColumn('fournisseur', 'user_updated', 'integer');
      //  $this->createForeignKey('fournisseur', 'fournisseur_user_updated_fkey', array(
      //       'local' => 'user_updated',
      //       'foreign' => 'id',
      //       'foreignTable' => 'utilisateur',
      //       'onDelete' => 'CASCADE'
      //   ));
      
  }

  public function down()
  {
  }
}
