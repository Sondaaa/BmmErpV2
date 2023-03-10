<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Hopital', 'doctrine');

/**
 * BaseHopital
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Demandederemboursement
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method string              getLibelle()                Returns the current record's "libelle" value
 * @method Doctrine_Collection getDemandederemboursement() Returns the current record's "Demandederemboursement" collection
 * @method Hopital             setId()                     Sets the current record's "id" value
 * @method Hopital             setLibelle()                Sets the current record's "libelle" value
 * @method Hopital             setDemandederemboursement() Sets the current record's "Demandederemboursement" collection
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHopital extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hopital');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'hopital_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Demandederemboursement', array(
             'local' => 'id',
             'foreign' => 'id_hopital'));
    }
}