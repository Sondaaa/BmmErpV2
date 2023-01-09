<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Planing', 'doctrine');

/**
 * BasePlaning
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $montantttc
 * @property string $montanttotalht
 * @property date $datedebutentete
 * @property date $datefinentete
 * @property string $objet
 * @property integer $annee
 * @property string $montantrealise
 * @property boolean $elignible
 * @property boolean $noneligibletfp
 * @property Doctrine_Collection $Plan
 * @property Doctrine_Collection $Ligneplaning
 * @property Doctrine_Collection $Tableaubordformation
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getMontantttc()           Returns the current record's "montantttc" value
 * @method string              getMontanttotalht()       Returns the current record's "montanttotalht" value
 * @method date                getDatedebutentete()      Returns the current record's "datedebutentete" value
 * @method date                getDatefinentete()        Returns the current record's "datefinentete" value
 * @method string              getObjet()                Returns the current record's "objet" value
 * @method integer             getAnnee()                Returns the current record's "annee" value
 * @method string              getMontantrealise()       Returns the current record's "montantrealise" value
 * @method boolean             getElignible()            Returns the current record's "elignible" value
 * @method boolean             getNoneligibletfp()       Returns the current record's "noneligibletfp" value
 * @method Doctrine_Collection getPlan()                 Returns the current record's "Plan" collection
 * @method Doctrine_Collection getLigneplaning()         Returns the current record's "Ligneplaning" collection
 * @method Doctrine_Collection getTableaubordformation() Returns the current record's "Tableaubordformation" collection
 * @method Planing             setId()                   Sets the current record's "id" value
 * @method Planing             setMontantttc()           Sets the current record's "montantttc" value
 * @method Planing             setMontanttotalht()       Sets the current record's "montanttotalht" value
 * @method Planing             setDatedebutentete()      Sets the current record's "datedebutentete" value
 * @method Planing             setDatefinentete()        Sets the current record's "datefinentete" value
 * @method Planing             setObjet()                Sets the current record's "objet" value
 * @method Planing             setAnnee()                Sets the current record's "annee" value
 * @method Planing             setMontantrealise()       Sets the current record's "montantrealise" value
 * @method Planing             setElignible()            Sets the current record's "elignible" value
 * @method Planing             setNoneligibletfp()       Sets the current record's "noneligibletfp" value
 * @method Planing             setPlan()                 Sets the current record's "Plan" collection
 * @method Planing             setLigneplaning()         Sets the current record's "Ligneplaning" collection
 * @method Planing             setTableaubordformation() Sets the current record's "Tableaubordformation" collection
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePlaning extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('planing');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'planing_id',
             'length' => 4,
             ));
        $this->hasColumn('montantttc', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('montanttotalht', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('datedebutentete', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datefinentete', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('objet', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('annee', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantrealise', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('elignible', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('noneligibletfp', 'boolean', 1, array(
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
        $this->hasMany('Plan', array(
             'local' => 'id',
             'foreign' => 'id_planing'));

        $this->hasMany('Ligneplaning', array(
             'local' => 'id',
             'foreign' => 'id_pluning'));

        $this->hasMany('Tableaubordformation', array(
             'local' => 'id',
             'foreign' => 'id_plan'));
    }
}