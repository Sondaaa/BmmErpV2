<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typecaisse', 'doctrine');

/**
 * BaseTypecaisse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Caissesbanques
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getLibelle()        Returns the current record's "libelle" value
 * @method Doctrine_Collection getCaissesbanques() Returns the current record's "Caissesbanques" collection
 * @method Typecaisse          setId()             Sets the current record's "id" value
 * @method Typecaisse          setLibelle()        Sets the current record's "libelle" value
 * @method Typecaisse          setCaissesbanques() Sets the current record's "Caissesbanques" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypecaisse extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typecaisse');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typecaisse_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Caissesbanques', array(
             'local' => 'id',
             'foreign' => 'id_typecb'));
    }
}