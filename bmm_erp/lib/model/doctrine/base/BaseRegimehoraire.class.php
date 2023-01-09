<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Regimehoraire', 'doctrine');

/**
 * BaseRegimehoraire
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $nbheure
 * 
 * @method integer       getId()      Returns the current record's "id" value
 * @method string        getLibelle() Returns the current record's "libelle" value
 * @method integer       getNbheure() Returns the current record's "nbheure" value
 * @method Regimehoraire setId()      Sets the current record's "id" value
 * @method Regimehoraire setLibelle() Sets the current record's "libelle" value
 * @method Regimehoraire setNbheure() Sets the current record's "nbheure" value
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRegimehoraire extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('regimehoraire');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'regimehoraire_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('nbheure', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}