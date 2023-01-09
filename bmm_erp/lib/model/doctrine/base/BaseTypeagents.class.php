<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typeagents', 'doctrine');

/**
 * BaseTypeagents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Agents
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getLibelle() Returns the current record's "libelle" value
 * @method Doctrine_Collection getAgents()  Returns the current record's "Agents" collection
 * @method Typeagents          setId()      Sets the current record's "id" value
 * @method Typeagents          setLibelle() Sets the current record's "libelle" value
 * @method Typeagents          setAgents()  Sets the current record's "Agents" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypeagents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typeagents');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typeagents_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 100, array(
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
        $this->hasMany('Agents', array(
             'local' => 'id',
             'foreign' => 'id_type'));
    }
}