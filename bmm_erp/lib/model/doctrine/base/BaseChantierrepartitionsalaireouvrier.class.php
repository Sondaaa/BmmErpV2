<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Chantierrepartitionsalaireouvrier', 'doctrine');

/**
 * BaseChantierrepartitionsalaireouvrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_repartition
 * @property string $libelle
 * @property decimal $montant
 * @property integer $id_projet
 * @property integer $jour
 * @property Repartitionsalaireouvrier $Repartitionsalaireouvrier
 * @property Projet $Projet
 * @property Doctrine_Collection $Lignerepartitionsalaireouvrier
 * 
 * @method integer                           getId()                             Returns the current record's "id" value
 * @method integer                           getIdRepartition()                  Returns the current record's "id_repartition" value
 * @method string                            getLibelle()                        Returns the current record's "libelle" value
 * @method decimal                           getMontant()                        Returns the current record's "montant" value
 * @method integer                           getIdProjet()                       Returns the current record's "id_projet" value
 * @method integer                           getJour()                           Returns the current record's "jour" value
 * @method Repartitionsalaireouvrier         getRepartitionsalaireouvrier()      Returns the current record's "Repartitionsalaireouvrier" value
 * @method Projet                            getProjet()                         Returns the current record's "Projet" value
 * @method Doctrine_Collection               getLignerepartitionsalaireouvrier() Returns the current record's "Lignerepartitionsalaireouvrier" collection
 * @method Chantierrepartitionsalaireouvrier setId()                             Sets the current record's "id" value
 * @method Chantierrepartitionsalaireouvrier setIdRepartition()                  Sets the current record's "id_repartition" value
 * @method Chantierrepartitionsalaireouvrier setLibelle()                        Sets the current record's "libelle" value
 * @method Chantierrepartitionsalaireouvrier setMontant()                        Sets the current record's "montant" value
 * @method Chantierrepartitionsalaireouvrier setIdProjet()                       Sets the current record's "id_projet" value
 * @method Chantierrepartitionsalaireouvrier setJour()                           Sets the current record's "jour" value
 * @method Chantierrepartitionsalaireouvrier setRepartitionsalaireouvrier()      Sets the current record's "Repartitionsalaireouvrier" value
 * @method Chantierrepartitionsalaireouvrier setProjet()                         Sets the current record's "Projet" value
 * @method Chantierrepartitionsalaireouvrier setLignerepartitionsalaireouvrier() Sets the current record's "Lignerepartitionsalaireouvrier" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseChantierrepartitionsalaireouvrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('chantierrepartitionsalaireouvrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'chantierrepartitionsalaireouvrier_id',
             'length' => 4,
             ));
        $this->hasColumn('id_repartition', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 700, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 700,
             ));
        $this->hasColumn('montant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_projet', 'integer', 4, array(
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Repartitionsalaireouvrier', array(
             'local' => 'id_repartition',
             'foreign' => 'id'));

        $this->hasOne('Projet', array(
             'local' => 'id_projet',
             'foreign' => 'id'));

        $this->hasMany('Lignerepartitionsalaireouvrier', array(
             'local' => 'id',
             'foreign' => 'id_chantierrepartition'));
    }
}