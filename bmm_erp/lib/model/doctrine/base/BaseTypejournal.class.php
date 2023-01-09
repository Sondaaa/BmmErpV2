<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typejournal', 'doctrine');

/**
 * BaseTypejournal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Journalcomptable
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getLibelle()          Returns the current record's "libelle" value
 * @method Doctrine_Collection getJournalcomptable() Returns the current record's "Journalcomptable" collection
 * @method Typejournal         setId()               Sets the current record's "id" value
 * @method Typejournal         setLibelle()          Sets the current record's "libelle" value
 * @method Typejournal         setJournalcomptable() Sets the current record's "Journalcomptable" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypejournal extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typejournal');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typejournal_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Journalcomptable', array(
             'local' => 'id',
             'foreign' => 'id_type_journal'));
    }
}