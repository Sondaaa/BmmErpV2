<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Exercice', 'doctrine');

/**
 * BaseExercice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property date $date_debut
 * @property date $date_fin
 * @property Doctrine_Collection $Dossiercomptable
 * @property Doctrine_Collection $Piececomptable
 * @property Doctrine_Collection $Plandossiercomptable
 * @property Doctrine_Collection $Dossierexercice
 * @property Doctrine_Collection $Journalcomptable
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getLibelle()          Returns the current record's "libelle" value
 * @method date                getDateDebut()        Returns the current record's "date_debut" value
 * @method date                getDateFin()          Returns the current record's "date_fin" value
 * @method string   getType()       Returns the current record's "type" value
 * @method Doctrine_Collection getDossiercomptable() Returns the current record's "Dossiercomptable" collection
 * @method Doctrine_Collection getPlandossiercomptable() Returns the current record's "Plandossiercomptable" collection
 * @method Doctrine_Collection getPiececomptable()   Returns the current record's "Piececomptable" collection
 * @method Doctrine_Collection getDossierexercice()  Returns the current record's "Dossierexercice" collection
 * @method Doctrine_Collection getJournalcomptable() Returns the current record's "Journalcomptable" collection
 * @method Exercice            setId()               Sets the current record's "id" value
 * @method Exercice            setLibelle()          Sets the current record's "libelle" value
 * @method Exercice            setDateDebut()        Sets the current record's "date_debut" value
 * @method Exercice            setDateFin()          Sets the current record's "date_fin" value
 * @method Exercice            setDossiercomptable() Sets the current record's "Dossiercomptable" collection
 * @method Exercice            setPlandossiercomptable() Sets the current record's "Plandossiercomptable" collection
 * @method Exercice            setPiececomptable()   Sets the current record's "Piececomptable" collection
 * @method Exercice            setDossierexercice()  Sets the current record's "Dossierexercice" collection
 * @method Exercice            setJournalcomptable() Sets the current record's "Journalcomptable" collection
  * @method Exercice setType()       Sets the current record's "type" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseExercice extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('exercice');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'exercice_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('date_debut', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('date_fin', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
          $this->hasColumn('type', 'string', 100, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Dossiercomptable', array(
             'local' => 'id',
             'foreign' => 'id_exercice'));
        
        $this->hasMany('Plandossiercomptable', array(
             'local' => 'id',
             'foreign' => 'id_exercice'));

        $this->hasMany('Piececomptable', array(
             'local' => 'id',
             'foreign' => 'id_exercice'));

        $this->hasMany('Dossierexercice', array(
             'local' => 'id',
             'foreign' => 'id_exercice'));

        $this->hasMany('Journalcomptable', array(
             'local' => 'id',
             'foreign' => 'id_exercice'));
    }
}