<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Repartitioncharge', 'doctrine');

/**
 * BaseRepartitioncharge
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property integer $annee
 * @property decimal $montant
 * @property decimal $main
 * @property decimal $intrant
 * @property decimal $mecanisation
 * @property integer $jour
 * @property Doctrine_Collection $Uniterepartitioncharge
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method date                getDate()                   Returns the current record's "date" value
 * @method integer             getAnnee()                  Returns the current record's "annee" value
 * @method decimal             getMontant()                Returns the current record's "montant" value
 * @method decimal             getMain()                   Returns the current record's "main" value
 * @method decimal             getIntrant()                Returns the current record's "intrant" value
 * @method decimal             getMecanisation()           Returns the current record's "mecanisation" value
 * @method integer             getJour()                   Returns the current record's "jour" value
 * @method Doctrine_Collection getUniterepartitioncharge() Returns the current record's "Uniterepartitioncharge" collection
 * @method Repartitioncharge   setId()                     Sets the current record's "id" value
 * @method Repartitioncharge   setDate()                   Sets the current record's "date" value
 * @method Repartitioncharge   setAnnee()                  Sets the current record's "annee" value
 * @method Repartitioncharge   setMontant()                Sets the current record's "montant" value
 * @method Repartitioncharge   setMain()                   Sets the current record's "main" value
 * @method Repartitioncharge   setIntrant()                Sets the current record's "intrant" value
 * @method Repartitioncharge   setMecanisation()           Sets the current record's "mecanisation" value
 * @method Repartitioncharge   setJour()                   Sets the current record's "jour" value
 * @method Repartitioncharge   setUniterepartitioncharge() Sets the current record's "Uniterepartitioncharge" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRepartitioncharge extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('repartitioncharge');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'repartitioncharge_id',
             'length' => 4,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('annee', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('main', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('intrant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('mecanisation', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('jour', 'integer', 4, array(
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
        $this->hasMany('Uniterepartitioncharge', array(
             'local' => 'id',
             'foreign' => 'id_repartitioncharge'));
    }
}