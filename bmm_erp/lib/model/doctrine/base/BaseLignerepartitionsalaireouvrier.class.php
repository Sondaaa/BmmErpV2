<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignerepartitionsalaireouvrier', 'doctrine');

/**
 * BaseLignerepartitionsalaireouvrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_chantierrepartition
 * @property integer $mois
 * @property integer $jour
 * @property decimal $montant
 * @property Chantierrepartitionsalaireouvrier $Chantierrepartitionsalaireouvrier
 * 
 * @method integer                           getId()                                Returns the current record's "id" value
 * @method integer                           getIdChantierrepartition()             Returns the current record's "id_chantierrepartition" value
 * @method integer                           getMois()                              Returns the current record's "mois" value
 * @method integer                           getJour()                              Returns the current record's "jour" value
 * @method decimal                           getMontant()                           Returns the current record's "montant" value
 * @method Chantierrepartitionsalaireouvrier getChantierrepartitionsalaireouvrier() Returns the current record's "Chantierrepartitionsalaireouvrier" value
 * @method Lignerepartitionsalaireouvrier    setId()                                Sets the current record's "id" value
 * @method Lignerepartitionsalaireouvrier    setIdChantierrepartition()             Sets the current record's "id_chantierrepartition" value
 * @method Lignerepartitionsalaireouvrier    setMois()                              Sets the current record's "mois" value
 * @method Lignerepartitionsalaireouvrier    setJour()                              Sets the current record's "jour" value
 * @method Lignerepartitionsalaireouvrier    setMontant()                           Sets the current record's "montant" value
 * @method Lignerepartitionsalaireouvrier    setChantierrepartitionsalaireouvrier() Sets the current record's "Chantierrepartitionsalaireouvrier" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignerepartitionsalaireouvrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignerepartitionsalaireouvrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignerepartitionsalaireouvrier_id',
             'length' => 4,
             ));
        $this->hasColumn('id_chantierrepartition', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('mois', 'integer', 4, array(
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
        $this->hasOne('Chantierrepartitionsalaireouvrier', array(
             'local' => 'id_chantierrepartition',
             'foreign' => 'id'));
    }
}