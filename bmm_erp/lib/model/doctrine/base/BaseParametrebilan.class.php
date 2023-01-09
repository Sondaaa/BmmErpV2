<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Parametrebilan', 'doctrine');

/**
 * BaseParametrebilan
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $note
 * @property integer $type
 * @property integer $id_comptedebut
 * @property integer $id_comptefin
 * @property integer $id_exercice
 * @property integer $id_dossier
 * @property Dossiercomptable $Dossiercomptable
 * @property Plancomptable $Plandossiercomptable
 * @property Plancomptable $Plandossiercomptable2
 * @property Exercice $Exercice
 * 
 * @method integer        getId()              Returns the current record's "id" value
 * @method string         getNote()            Returns the current record's "note" value
 * @method integer        getType()            Returns the current record's "type" value
 * @method integer        getIdComptedebut()   Returns the current record's "id_comptedebut" value
 * @method integer        getIdComptefin()     Returns the current record's "id_comptefin" value
 * @method integer        getIdExercice()      Returns the current record's "id_exercice" value
 * @method integer        getIdDossier()       Returns the current record's "id_dossier" value
 * @method Dossiercomptable    getDossiercomptable()  Returns the current record's "Dossiercomptable" value
 * @method Plandossiercomptable  getPlancomptable()   Returns the current record's "Plandossiercomptable" value
 * @method Plandossiercomptable  getPlancomptable2()  Returns the current record's "Plandossiercomptable2" value
 * @method Exercice       getExercice()        Returns the current record's "Exercice" value
 * @method Parametrebilan setId()              Sets the current record's "id" value
 * @method Parametrebilan setNote()            Sets the current record's "note" value
 * @method Parametrebilan setType()            Sets the current record's "type" value
 * @method Parametrebilan setIdComptedebut()   Sets the current record's "id_comptedebut" value
 * @method Parametrebilan setIdComptefin()     Sets the current record's "id_comptefin" value
 * @method Parametrebilan setIdExercice()      Sets the current record's "id_exercice" value
 * @method Parametrebilan setIdDossier()       Sets the current record's "id_dossier" value
 * @method Parametrebilan setDossiercomptable()  Sets the current record's "Dossiercomptable" value
 * @method Parametrebilan setPlancomptable()   Sets the current record's "Plancomptable" value
 * @method Parametrebilan setPlancomptable2()  Sets the current record's "Plancomptable2" value
 * @method Piececomptable setExercice()        Sets the current record's "Exercice" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseParametrebilan extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('parametrebilan');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'parametrebilan_id',
             'length' => 4,
             ));
        $this->hasColumn('note', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 10,
             ));
        $this->hasColumn('type', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('id_comptedebut', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_comptefin', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_exercice', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_dossier', 'integer', 4, array(
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
        $this->hasOne('Plandossiercomptable', array(
             'local' => 'id_comptefin',
             'foreign' => 'id'));

        $this->hasOne('Plandossiercomptable as Plandossiercomptable2', array(
             'local' => 'id_comptedebut',
             'foreign' => 'id'));
        
        $this->hasOne('Exercice', array(
             'local' => 'id_exercice',
             'foreign' => 'id'));
        
        $this->hasOne('Dossiercomptable', array(
             'local' => 'id_dossier',
             'foreign' => 'id'));
    }
}