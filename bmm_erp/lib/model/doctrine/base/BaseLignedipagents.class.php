<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignedipagents', 'doctrine');

/**
 * BaseLignedipagents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property date $annee
 * @property integer $id_agents
 * @property integer $id_diplome
 * @property integer $nordre
 * @property Agents $Agents
 * @property Diplome $Diplome
 * 
 * @method integer        getId()         Returns the current record's "id" value
 * @method string         getLibelle()    Returns the current record's "libelle" value
 * @method date           getAnnee()      Returns the current record's "annee" value
 * @method integer        getIdAgents()   Returns the current record's "id_agents" value
 * @method integer        getIdDiplome()  Returns the current record's "id_diplome" value
 * @method integer        getNordre()     Returns the current record's "nordre" value
 * @method Agents         getAgents()     Returns the current record's "Agents" value
 * @method Diplome        getDiplome()    Returns the current record's "Diplome" value
 * @method Lignedipagents setId()         Sets the current record's "id" value
 * @method Lignedipagents setLibelle()    Sets the current record's "libelle" value
 * @method Lignedipagents setAnnee()      Sets the current record's "annee" value
 * @method Lignedipagents setIdAgents()   Sets the current record's "id_agents" value
 * @method Lignedipagents setIdDiplome()  Sets the current record's "id_diplome" value
 * @method Lignedipagents setNordre()     Sets the current record's "nordre" value
 * @method Lignedipagents setAgents()     Sets the current record's "Agents" value
 * @method Lignedipagents setDiplome()    Sets the current record's "Diplome" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignedipagents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignedipagents');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignedipagents_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('annee', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_diplome', 'integer', 4, array(
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
             'local' => 'id_agents',
             'foreign' => 'id'));

        $this->hasOne('Diplome', array(
             'local' => 'id_diplome',
             'foreign' => 'id'));
    }
}