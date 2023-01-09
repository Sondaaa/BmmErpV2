<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Moduleerp', 'doctrine');

/**
 * BaseModuleerp
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nom
 * @property Doctrine_Collection $Rolemodule
 
 * 
 * @method integer             getId()         Returns the current record's "id" value
 * @method string              getNom()        Returns the current record's "nom" value
 * @method Doctrine_Collection getRolemodule() Returns the current record's "Rolemodule" collection
 
 * @method Moduleerp           setId()         Sets the current record's "id" value
 * @method Moduleerp           setNom()        Sets the current record's "nom" value
 * @method Moduleerp           setRolemodule() Sets the current record's "Rolemodule" collection
 
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseModuleerp extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('moduleerp');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'moduleerp_id',
             'length' => 4,
             ));
        $this->hasColumn('nom', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Rolemodule', array(
             'local' => 'id',
             'foreign' => 'id_module'));

        
    }
}