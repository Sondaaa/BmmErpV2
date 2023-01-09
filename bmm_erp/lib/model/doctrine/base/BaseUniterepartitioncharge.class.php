<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Uniterepartitioncharge', 'doctrine');

/**
 * BaseUniterepartitioncharge
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property string $libelle
 * @property decimal $montant
 * @property integer $id_repartitioncharge
 * @property Repartitioncharge $Repartitioncharge
 * @property Doctrine_Collection $Ligneuniterepartition
 * @property Doctrine_Collection $Parametreuniterepartition
 * 
 * @method integer                getId()                        Returns the current record's "id" value
 * @method date                   getDate()                      Returns the current record's "date" value
 * @method string                 getLibelle()                   Returns the current record's "libelle" value
 * @method decimal                getMontant()                   Returns the current record's "montant" value
 * @method integer                getIdRepartitioncharge()       Returns the current record's "id_repartitioncharge" value
 * @method Repartitioncharge      getRepartitioncharge()         Returns the current record's "Repartitioncharge" value
 * @method Doctrine_Collection    getLigneuniterepartition()     Returns the current record's "Ligneuniterepartition" collection
 * @method Doctrine_Collection    getParametreuniterepartition() Returns the current record's "Parametreuniterepartition" collection
 * @method Uniterepartitioncharge setId()                        Sets the current record's "id" value
 * @method Uniterepartitioncharge setDate()                      Sets the current record's "date" value
 * @method Uniterepartitioncharge setLibelle()                   Sets the current record's "libelle" value
 * @method Uniterepartitioncharge setMontant()                   Sets the current record's "montant" value
 * @method Uniterepartitioncharge setIdRepartitioncharge()       Sets the current record's "id_repartitioncharge" value
 * @method Uniterepartitioncharge setRepartitioncharge()         Sets the current record's "Repartitioncharge" value
 * @method Uniterepartitioncharge setLigneuniterepartition()     Sets the current record's "Ligneuniterepartition" collection
 * @method Uniterepartitioncharge setParametreuniterepartition() Sets the current record's "Parametreuniterepartition" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUniterepartitioncharge extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('uniterepartitioncharge');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'uniterepartitioncharge_id',
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
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('montant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_repartitioncharge', 'integer', 4, array(
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
        $this->hasOne('Repartitioncharge', array(
             'local' => 'id_repartitioncharge',
             'foreign' => 'id'));

        $this->hasMany('Ligneuniterepartition', array(
             'local' => 'id',
             'foreign' => 'id_uniterepartition'));

        $this->hasMany('Parametreuniterepartition', array(
             'local' => 'id',
             'foreign' => 'id_uniterepartition'));
    }
}