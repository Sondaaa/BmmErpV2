<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Experiences', 'doctrine');

/**
 * BaseExperiences
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property string $organistaion
 * @property integer $duree
 * @property integer $id_agents
 * @property integer $id_typeexperience
 * @property date $date
 * @property integer $nordre
 * @property Agents $Agents
 * @property Typeexperience $Typeexperience
 * 
 * @method integer        getId()                Returns the current record's "id" value
 * @method string         getDescription()       Returns the current record's "description" value
 * @method string         getOrganistaion()      Returns the current record's "organistaion" value
 * @method integer        getDuree()             Returns the current record's "duree" value
 * @method integer        getIdAgents()          Returns the current record's "id_agents" value
 * @method integer        getIdTypeexperience()  Returns the current record's "id_typeexperience" value
 * @method date           getDate()              Returns the current record's "date" value
 * @method integer        getNordre()            Returns the current record's "nordre" value
 * @method Agents         getAgents()            Returns the current record's "Agents" value
 * @method Typeexperience getTypeexperience()    Returns the current record's "Typeexperience" value
 * @method Experiences    setId()                Sets the current record's "id" value
 * @method Experiences    setDescription()       Sets the current record's "description" value
 * @method Experiences    setOrganistaion()      Sets the current record's "organistaion" value
 * @method Experiences    setDuree()             Sets the current record's "duree" value
 * @method Experiences    setIdAgents()          Sets the current record's "id_agents" value
 * @method Experiences    setIdTypeexperience()  Sets the current record's "id_typeexperience" value
 * @method Experiences    setDate()              Sets the current record's "date" value
 * @method Experiences    setNordre()            Sets the current record's "nordre" value
 * @method Experiences    setAgents()            Sets the current record's "Agents" value
 * @method Experiences    setTypeexperience()    Sets the current record's "Typeexperience" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseExperiences extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('experiences');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'experiences_id',
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('organistaion', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('duree', 'integer', 4, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_typeexperience', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
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
             'local' => 'id_agents',
             'foreign' => 'id'));

        $this->hasOne('Typeexperience', array(
             'local' => 'id_typeexperience',
             'foreign' => 'id'));
    }
}