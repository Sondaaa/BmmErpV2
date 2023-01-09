<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Nature', 'doctrine');

/**
 * BaseNature
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nature
 * @property Doctrine_Collection $Immobilisation
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getNature()         Returns the current record's "nature" value
 * @method Doctrine_Collection getImmobilisation() Returns the current record's "Immobilisation" collection
 * @method Nature              setId()             Sets the current record's "id" value
 * @method Nature              setNature()         Sets the current record's "nature" value
 * @method Nature              setImmobilisation() Sets the current record's "Immobilisation" collection
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNature extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('nature');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nature', 'string', 300, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 300,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Immobilisation', array(
             'local' => 'id',
             'foreign' => 'id_nature'));
    }
}