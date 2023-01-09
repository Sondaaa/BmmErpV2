<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pvdoc', 'doctrine');

/**
 * BasePvdoc
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $daterenion
 * @property date $datereception
 * @property integer $duree
 * @property integer $numero
 * @property Doctrine_Collection $Lignedocpv
 * @property Doctrine_Collection $Lignepvfrs
 * @property Doctrine_Collection $Lignepvvisa
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method date                getDaterenion()    Returns the current record's "daterenion" value
 * @method date                getDatereception() Returns the current record's "datereception" value
 * @method integer             getDuree()         Returns the current record's "duree" value
 * @method integer             getNumero()        Returns the current record's "numero" value
 * @method Doctrine_Collection getLignedocpv()    Returns the current record's "Lignedocpv" collection
 * @method Doctrine_Collection getLignepvfrs()    Returns the current record's "Lignepvfrs" collection
 * @method Doctrine_Collection getLignepvvisa()   Returns the current record's "Lignepvvisa" collection
 * @method Pvdoc               setId()            Sets the current record's "id" value
 * @method Pvdoc               setDaterenion()    Sets the current record's "daterenion" value
 * @method Pvdoc               setDatereception() Sets the current record's "datereception" value
 * @method Pvdoc               setDuree()         Sets the current record's "duree" value
 * @method Pvdoc               setNumero()        Sets the current record's "numero" value
 * @method Pvdoc               setLignedocpv()    Sets the current record's "Lignedocpv" collection
 * @method Pvdoc               setLignepvfrs()    Sets the current record's "Lignepvfrs" collection
 * @method Pvdoc               setLignepvvisa()   Sets the current record's "Lignepvvisa" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePvdoc extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pvdoc');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('daterenion', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('datereception', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('duree', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Lignedocpv', array(
             'local' => 'id',
             'foreign' => 'id_pv'));

        $this->hasMany('Lignepvfrs', array(
             'local' => 'id',
             'foreign' => 'id_pv'));

        $this->hasMany('Lignepvvisa', array(
             'local' => 'id',
             'foreign' => 'id_pv'));
    }
}