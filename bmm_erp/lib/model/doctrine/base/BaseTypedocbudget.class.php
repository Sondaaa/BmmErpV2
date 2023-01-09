<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typedocbudget', 'doctrine');

/**
 * BaseTypedocbudget
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Documentbudget
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getLibelle()        Returns the current record's "libelle" value
 * @method Doctrine_Collection getDocumentbudget() Returns the current record's "Documentbudget" collection
 * @method Typedocbudget       setId()             Sets the current record's "id" value
 * @method Typedocbudget       setLibelle()        Sets the current record's "libelle" value
 * @method Typedocbudget       setDocumentbudget() Sets the current record's "Documentbudget" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypedocbudget extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typedocbudget');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typedocbudget_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 150, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 150,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Documentbudget', array(
             'local' => 'id',
             'foreign' => 'id_type'));
    }
}