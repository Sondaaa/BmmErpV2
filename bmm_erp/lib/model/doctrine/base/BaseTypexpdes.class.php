<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typexpdes', 'doctrine');

/**
 * BaseTypexpdes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $type
 * @property Doctrine_Collection $Expdest
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getType()    Returns the current record's "type" value
 * @method Doctrine_Collection getExpdest() Returns the current record's "Expdest" collection
 * @method Typexpdes           setId()      Sets the current record's "id" value
 * @method Typexpdes           setType()    Sets the current record's "type" value
 * @method Typexpdes           setExpdest() Sets the current record's "Expdest" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypexpdes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typexpdes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
            'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('type', 'string', null, array(
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
        $this->hasMany('Expdest', array(
             'local' => 'id',
             'foreign' => 'id_type'));
    }
}