<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignetachesagents', 'doctrine');

/**
 * BaseLignetachesagents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property integer $id_tache
 * @property Agents $Agents
 * @property Taches $Taches
 * 
 * @method integer           getId()        Returns the current record's "id" value
 * @method integer           getIdAgents()  Returns the current record's "id_agents" value
 * @method integer           getIdTache()   Returns the current record's "id_tache" value
 * @method Agents            getAgents()    Returns the current record's "Agents" value
 * @method Taches            getTaches()    Returns the current record's "Taches" value
 * @method Lignetachesagents setId()        Sets the current record's "id" value
 * @method Lignetachesagents setIdAgents()  Sets the current record's "id_agents" value
 * @method Lignetachesagents setIdTache()   Sets the current record's "id_tache" value
 * @method Lignetachesagents setAgents()    Sets the current record's "Agents" value
 * @method Lignetachesagents setTaches()    Sets the current record's "Taches" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignetachesagents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignetachesagents');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignetachesagents_id',
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
        $this->hasColumn('id_tache', 'integer', 4, array(
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

        $this->hasOne('Taches', array(
             'local' => 'id_tache',
             'foreign' => 'id'));
    }
}