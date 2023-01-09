<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Echelon', 'doctrine');

/**
 * BaseEchelon
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libelle
 * @property integer $id
 * @property Doctrine_Collection $Salairedebase
 * 
 * @method string              getLibelle()       Returns the current record's "libelle" value
 * @method integer             getId()            Returns the current record's "id" value
 * @method Doctrine_Collection getSalairedebase() Returns the current record's "Salairedebase" collection
 * @method Echelon             setLibelle()       Sets the current record's "libelle" value
 * @method Echelon             setId()            Sets the current record's "id" value
 * @method Echelon             setSalairedebase() Sets the current record's "Salairedebase" collection
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEchelon extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('echelon');
        $this->hasColumn('libelle', 'string', 5, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 5,
             ));
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'echelon_id',
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Salairedebase', array(
             'local' => 'id',
             'foreign' => 'id_echelon'));
    }
}