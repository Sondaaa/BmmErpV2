<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typecourrier', 'doctrine');

/**
 * BaseTypecourrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $type
 * @property string $prefix
 * @property string $coul
 * @property Doctrine_Collection $Parametreexpedition
 * @property Doctrine_Collection $Courrier
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getType()                Returns the current record's "type" value
 * @method string              getPrefix()              Returns the current record's "prefix" value
 * @method string              getCoul()                Returns the current record's "coul" value
 * @method Doctrine_Collection getParametreexpedition() Returns the current record's "Parametreexpedition" collection
 * @method Doctrine_Collection getCourrier()            Returns the current record's "Courrier" collection
 * @method Typecourrier        setId()                  Sets the current record's "id" value
 * @method Typecourrier        setType()                Sets the current record's "type" value
 * @method Typecourrier        setPrefix()              Sets the current record's "prefix" value
 * @method Typecourrier        setCoul()                Sets the current record's "coul" value
 * @method Typecourrier        setParametreexpedition() Sets the current record's "Parametreexpedition" collection
 * @method Typecourrier        setCourrier()            Sets the current record's "Courrier" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypecourrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typecourrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typecourrier_id',
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
        $this->hasColumn('prefix', 'string', 3, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 3,
             ));
        $this->hasColumn('coul', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Parametreexpedition', array(
             'local' => 'id',
             'foreign' => 'id_typecourrier'));

        $this->hasMany('Courrier', array(
             'local' => 'id',
             'foreign' => 'id_type'));
    }
}