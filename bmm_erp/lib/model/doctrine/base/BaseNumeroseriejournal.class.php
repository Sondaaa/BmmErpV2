<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Numeroseriejournal', 'doctrine');

/**
 * BaseNumeroseriejournal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $prefixe
 * @property date $datedebut
 * @property date $datefin
 * @property integer $numerodebut
 * @property integer $numerofin
 * @property integer $attendu
 * @property integer $isbloque
 * @property integer $isvalide
 * @property integer $id_journal
 * @property Journalcomptable $Journalcomptable
 * @property Doctrine_Collection $Piececomptable
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getPrefixe()          Returns the current record's "prefixe" value
 * @method date                getDatedebut()        Returns the current record's "datedebut" value
 * @method date                getDatefin()          Returns the current record's "datefin" value
 * @method integer             getNumerodebut()      Returns the current record's "numerodebut" value
 * @method integer             getNumerofin()        Returns the current record's "numerofin" value
 * @method integer             getAttendu()          Returns the current record's "attendu" value
 * @method integer             getIsbloque()         Returns the current record's "isbloque" value
 * @method integer             getIsvalide()         Returns the current record's "isvalide" value
 * @method integer             getIdJournal()        Returns the current record's "id_journal" value
 * @method Journalcomptable    getJournalcomptable() Returns the current record's "Journalcomptable" value
 * @method Doctrine_Collection getPiececomptable()   Returns the current record's "Piececomptable" collection
 * @method Numeroseriejournal  setId()               Sets the current record's "id" value
 * @method Numeroseriejournal  setPrefixe()          Sets the current record's "prefixe" value
 * @method Numeroseriejournal  setDatedebut()        Sets the current record's "datedebut" value
 * @method Numeroseriejournal  setDatefin()          Sets the current record's "datefin" value
 * @method Numeroseriejournal  setNumerodebut()      Sets the current record's "numerodebut" value
 * @method Numeroseriejournal  setNumerofin()        Sets the current record's "numerofin" value
 * @method Numeroseriejournal  setAttendu()          Sets the current record's "attendu" value
 * @method Numeroseriejournal  setIsbloque()         Sets the current record's "isbloque" value
 * @method Numeroseriejournal  setIsvalide()         Sets the current record's "isvalide" value
 * @method Numeroseriejournal  setIdJournal()        Sets the current record's "id_journal" value
 * @method Numeroseriejournal  setJournalcomptable() Sets the current record's "Journalcomptable" value
 * @method Numeroseriejournal  setPiececomptable()   Sets the current record's "Piececomptable" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNumeroseriejournal extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('numeroseriejournal');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'numeroseriejournal_id',
             'length' => 4,
             ));
        $this->hasColumn('prefixe', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 10,
             ));
        $this->hasColumn('datedebut', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datefin', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('numerodebut', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '1',
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('numerofin', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '1',
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('attendu', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '1',
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('isbloque', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'default' => '0',
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('isvalide', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'default' => '0',
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('id_journal', 'integer', 4, array(
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
        $this->hasOne('Journalcomptable', array(
             'local' => 'id_journal',
             'foreign' => 'id'));

        $this->hasMany('Piececomptable', array(
             'local' => 'id',
             'foreign' => 'id_serie'));
    }
}