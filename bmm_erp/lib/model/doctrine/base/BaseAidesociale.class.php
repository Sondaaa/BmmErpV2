<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Aidesociale', 'doctrine');

/**
 * BaseAidesociale
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property date $date
 * @property integer $id
 * @property integer $id_agents
 * @property string $nature
 * @property string $origine
 * @property decimal $montant
 * @property string $observation
 * @property integer $id_typeaide
 * @property Agents $Agents
 * @property Typeaide $Typeaide
 * 
 * @method date        getDate()        Returns the current record's "date" value
 * @method integer     getId()          Returns the current record's "id" value
 * @method integer     getIdAgents()    Returns the current record's "id_agents" value
 * @method string      getNature()      Returns the current record's "nature" value
 * @method string      getOrigine()     Returns the current record's "origine" value
 * @method decimal     getMontant()     Returns the current record's "montant" value
 * @method string      getObservation() Returns the current record's "observation" value
 * @method integer     getIdTypeaide()  Returns the current record's "id_typeaide" value
 * @method Agents      getAgents()      Returns the current record's "Agents" value
 * @method Typeaide    getTypeaide()    Returns the current record's "Typeaide" value
 * @method Aidesociale setDate()        Sets the current record's "date" value
 * @method Aidesociale setId()          Sets the current record's "id" value
 * @method Aidesociale setIdAgents()    Sets the current record's "id_agents" value
 * @method Aidesociale setNature()      Sets the current record's "nature" value
 * @method Aidesociale setOrigine()     Sets the current record's "origine" value
 * @method Aidesociale setMontant()     Sets the current record's "montant" value
 * @method Aidesociale setObservation() Sets the current record's "observation" value
 * @method Aidesociale setIdTypeaide()  Sets the current record's "id_typeaide" value
 * @method Aidesociale setAgents()      Sets the current record's "Agents" value
 * @method Aidesociale setTypeaide()    Sets the current record's "Typeaide" value
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAidesociale extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('aidesociale');
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'aidesociale_id',
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
        $this->hasColumn('nature', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('origine', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('montant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('observation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_typeaide', 'integer', 4, array(
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

        $this->hasOne('Typeaide', array(
             'local' => 'id_typeaide',
             'foreign' => 'id'));
    }
}