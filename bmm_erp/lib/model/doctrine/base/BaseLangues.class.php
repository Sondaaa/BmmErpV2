<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Langues', 'doctrine');

/**
 * BaseLangues
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Lignelangueagents
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method string              getLibelle()           Returns the current record's "libelle" value
 * @method Doctrine_Collection getLignelangueagents() Returns the current record's "Lignelangueagents" collection
 * @method Langues             setId()                Sets the current record's "id" value
 * @method Langues             setLibelle()           Sets the current record's "libelle" value
 * @method Langues             setLignelangueagents() Sets the current record's "Lignelangueagents" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLangues extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('langues');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'langues_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Lignelangueagents', array(
             'local' => 'id',
             'foreign' => 'id_langue'));
    }
}