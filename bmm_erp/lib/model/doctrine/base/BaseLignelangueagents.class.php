<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignelangueagents', 'doctrine');

/**
 * BaseLignelangueagents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property integer $id_langue
 * @property integer $id_angents
 * @property integer $nordre
 * @property Agents $Agents
 * @property Langues $Langues
 * 
 * @method integer           getId()          Returns the current record's "id" value
 * @method string            getDescription() Returns the current record's "description" value
 * @method integer           getIdLangue()    Returns the current record's "id_langue" value
 * @method integer           getIdAngents()   Returns the current record's "id_angents" value
 * @method integer           getNordre()      Returns the current record's "nordre" value
 * @method Agents            getAgents()      Returns the current record's "Agents" value
 * @method Langues           getLangues()     Returns the current record's "Langues" value
 * @method Lignelangueagents setId()          Sets the current record's "id" value
 * @method Lignelangueagents setDescription() Sets the current record's "description" value
 * @method Lignelangueagents setIdLangue()    Sets the current record's "id_langue" value
 * @method Lignelangueagents setIdAngents()   Sets the current record's "id_angents" value
 * @method Lignelangueagents setNordre()      Sets the current record's "nordre" value
 * @method Lignelangueagents setAgents()      Sets the current record's "Agents" value
 * @method Lignelangueagents setLangues()     Sets the current record's "Langues" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignelangueagents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignelangueagents');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'ligne_langue_agents_id',
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
        $this->hasColumn('id_langue', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_angents', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nordre', 'integer', 4, array(
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
             'local' => 'id_angents',
             'foreign' => 'id'));

        $this->hasOne('Langues', array(
             'local' => 'id_langue',
             'foreign' => 'id'));
    }
}