<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Annulationengagement', 'doctrine');

/**
 * BaseAnnulationengagement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property decimal $montantecart
 * @property boolean $totale
 * @property integer $id_lignemouvementfacturation
 * @property integer $id_ligprotitrub
 * @property integer $id_documentachat
 * @property Lignemouvementfacturation $Lignemouvementfacturation
 * @property Ligprotitrub $Ligprotitrub
 * @property Documentachat $Documentachat
 * 
 * @method integer                   getId()                           Returns the current record's "id" value
 * @method date                      getDate()                         Returns the current record's "date" value
 * @method decimal                   getMontantecart()                 Returns the current record's "montantecart" value
 * @method boolean                   getTotale()                       Returns the current record's "totale" value
 * @method integer                   getIdLignemouvementfacturation()  Returns the current record's "id_lignemouvementfacturation" value
 * @method integer                   getIdLigprotitrub()               Returns the current record's "id_ligprotitrub" value
 * @method integer                   getIdDocumentachat()              Returns the current record's "id_documentachat" value
 * @method Lignemouvementfacturation getLignemouvementfacturation()    Returns the current record's "Lignemouvementfacturation" value
 * @method Ligprotitrub              getLigprotitrub()                 Returns the current record's "Ligprotitrub" value
 * @method Documentachat             getDocumentachat()                Returns the current record's "Documentachat" value
 * @method Annulationengagement      setId()                           Sets the current record's "id" value
 * @method Annulationengagement      setDate()                         Sets the current record's "date" value
 * @method Annulationengagement      setMontantecart()                 Sets the current record's "montantecart" value
 * @method Annulationengagement      setTotale()                       Sets the current record's "totale" value
 * @method Annulationengagement      setIdLignemouvementfacturation()  Sets the current record's "id_lignemouvementfacturation" value
 * @method Annulationengagement      setIdLigprotitrub()               Sets the current record's "id_ligprotitrub" value
 * @method Annulationengagement      setIdDocumentachat()              Sets the current record's "id_documentachat" value
 * @method Annulationengagement      setLignemouvementfacturation()    Sets the current record's "Lignemouvementfacturation" value
 * @method Annulationengagement      setLigprotitrub()                 Sets the current record's "Ligprotitrub" value
 * @method Annulationengagement      setDocumentachat()                Sets the current record's "Documentachat" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAnnulationengagement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('annulationengagement');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'annulationengagement_id',
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
        $this->hasColumn('montantecart', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('totale', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_lignemouvementfacturation', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_ligprotitrub', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_documentachat', 'integer', 4, array(
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
        $this->hasOne('Lignemouvementfacturation', array(
             'local' => 'id_lignemouvementfacturation',
             'foreign' => 'id'));

        $this->hasOne('Ligprotitrub', array(
             'local' => 'id_ligprotitrub',
             'foreign' => 'id'));

        $this->hasOne('Documentachat', array(
             'local' => 'id_documentachat',
             'foreign' => 'id'));
    }
}