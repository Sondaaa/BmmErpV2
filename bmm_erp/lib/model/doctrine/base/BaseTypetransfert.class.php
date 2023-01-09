<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typetransfert', 'doctrine');

/**
 * BaseTypetransfert
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Transfertbudget
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method string              getLibelle()         Returns the current record's "libelle" value
 * @method Doctrine_Collection getTransfertbudget() Returns the current record's "Transfertbudget" collection
 * @method Typetransfert       setId()              Sets the current record's "id" value
 * @method Typetransfert       setLibelle()         Sets the current record's "libelle" value
 * @method Typetransfert       setTransfertbudget() Sets the current record's "Transfertbudget" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypetransfert extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typetransfert');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typetransfert_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 30, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 30,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Transfertbudget', array(
             'local' => 'id',
             'foreign' => 'id_typetransfert'));
    }
}