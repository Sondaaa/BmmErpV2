<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ligneniveuxeducatif', 'doctrine');

/**
 * BaseLigneniveuxeducatif
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property integer $id_niveaueducatif
 * @property integer $id_agents
 * @property Agents $Agents
 * @property Niveaueducatif $Niveaueducatif
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method string              getDescription()       Returns the current record's "description" value
 * @method integer             getIdNiveaueducatif()  Returns the current record's "id_niveaueducatif" value
 * @method integer             getIdAgents()          Returns the current record's "id_agents" value
 * @method Agents              getAgents()            Returns the current record's "Agents" value
 * @method Niveaueducatif      getNiveaueducatif()    Returns the current record's "Niveaueducatif" value
 * @method Ligneniveuxeducatif setId()                Sets the current record's "id" value
 * @method Ligneniveuxeducatif setDescription()       Sets the current record's "description" value
 * @method Ligneniveuxeducatif setIdNiveaueducatif()  Sets the current record's "id_niveaueducatif" value
 * @method Ligneniveuxeducatif setIdAgents()          Sets the current record's "id_agents" value
 * @method Ligneniveuxeducatif setAgents()            Sets the current record's "Agents" value
 * @method Ligneniveuxeducatif setNiveaueducatif()    Sets the current record's "Niveaueducatif" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLigneniveuxeducatif extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ligneniveuxeducatif');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'ligneniveuxeducatif_id',
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('id_niveaueducatif', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
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
        $this->hasOne('Agents', array(
             'local' => 'id_agents',
             'foreign' => 'id'));

        $this->hasOne('Niveaueducatif', array(
             'local' => 'id_niveaueducatif',
             'foreign' => 'id'));
    }
}