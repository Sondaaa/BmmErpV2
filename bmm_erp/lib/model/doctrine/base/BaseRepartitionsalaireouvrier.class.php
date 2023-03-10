<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Repartitionsalaireouvrier', 'doctrine');

/**
 * BaseRepartitionsalaireouvrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property integer $annee
 * @property integer $jour
 * @property decimal $montant
 * @property Doctrine_Collection $Compterepartitionsalaireouvrier
 * @property Doctrine_Collection $Chantierrepartitionsalaireouvrier
 * 
 * @method integer                   getId()                                Returns the current record's "id" value
 * @method date                      getDate()                              Returns the current record's "date" value
 * @method integer                   getAnnee()                             Returns the current record's "annee" value
 * @method integer                   getJour()                              Returns the current record's "jour" value
 * @method decimal                   getMontant()                           Returns the current record's "montant" value
 * @method Doctrine_Collection       getCompterepartitionsalaireouvrier()   Returns the current record's "Compterepartitionsalaireouvrier" collection
 * @method Doctrine_Collection       getChantierrepartitionsalaireouvrier() Returns the current record's "Chantierrepartitionsalaireouvrier" collection
 * @method Repartitionsalaireouvrier setId()                                Sets the current record's "id" value
 * @method Repartitionsalaireouvrier setDate()                              Sets the current record's "date" value
 * @method Repartitionsalaireouvrier setAnnee()                             Sets the current record's "annee" value
 * @method Repartitionsalaireouvrier setJour()                              Sets the current record's "jour" value
 * @method Repartitionsalaireouvrier setMontant()                           Sets the current record's "montant" value
 * @method Repartitionsalaireouvrier setCompterepartitionsalaireouvrier()   Sets the current record's "Compterepartitionsalaireouvrier" collection
 * @method Repartitionsalaireouvrier setChantierrepartitionsalaireouvrier() Sets the current record's "Chantierrepartitionsalaireouvrier" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRepartitionsalaireouvrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('repartitionsalaireouvrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'repartitionsalaireouvrier_id',
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
        $this->hasColumn('jour', 'integer', 4, array(
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Compterepartitionsalaireouvrier', array(
             'local' => 'id',
             'foreign' => 'id_repartition'));

        $this->hasMany('Chantierrepartitionsalaireouvrier', array(
             'local' => 'id',
             'foreign' => 'id_repartition'));
    }
}