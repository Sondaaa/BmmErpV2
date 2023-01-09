<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Jourferier', 'doctrine');

/**
 * BaseJourferier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $jour
 * @property string $mois
 * @property date $date
 * @property string $libelle
 * @property boolean $paye
  * @property boolean $periodique
 * 
 * @method integer    getId()      Returns the current record's "id" value
 * @method string     getJour()    Returns the current record's "jour" value
 * @method string     getMois()    Returns the current record's "mois" value
 * @method date       getDate()    Returns the current record's "date" value
 * @method string     getLibelle() Returns the current record's "libelle" value
 * @method boolean    getPaye()    Returns the current record's "paye" value
 * @method boolean    getPeriodique()    Returns the current record's "periodique" value
 * @method Jourferier setId()      Sets the current record's "id" value
 * @method Jourferier setJour()    Sets the current record's "jour" value
 * @method Jourferier setMois()    Sets the current record's "mois" value
 * @method Jourferier setDate()    Sets the current record's "date" value
 * @method Jourferier setLibelle() Sets the current record's "libelle" value
 * @method Jourferier setPaye()    Sets the current record's "paye" value
  * @method Jourferier setPeriodique()    Sets the current record's "periodique" value
 
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJourferier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jourferier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'jourferier_id',
             'length' => 4,
             ));
        $this->hasColumn('jour', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('mois', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('paye', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
			 
        $this->hasColumn('periodique', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
			 
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}