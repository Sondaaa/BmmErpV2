<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Sourcepret', 'doctrine');

/**
 * BaseSourcepret
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Pret
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getLibelle() Returns the current record's "libelle" value
 * @method Doctrine_Collection getPret()    Returns the current record's "Pret" collection
 * @method Sourcepret          setId()      Sets the current record's "id" value
 * @method Sourcepret          setLibelle() Sets the current record's "libelle" value
 * @method Sourcepret          setPret()    Sets the current record's "Pret" collection
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSourcepret extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sourcepret');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'sourcepret_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 35, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 35,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Pret', array(
             'local' => 'id',
             'foreign' => 'id_source'));
    }
}