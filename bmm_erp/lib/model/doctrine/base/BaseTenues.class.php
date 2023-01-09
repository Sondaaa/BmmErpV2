<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Tenues', 'doctrine');

/**
 * BaseTenues
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $tache
 * @property integer $id_agents
 * @property string $observation
 * @property string $caracteristique
 * @property integer $id_ouvrier
 * @property string $personnel
 * @property date $date
 * @property integer $id_typetenue
 * @property integer $id_typemission
 * @property Agents $Agents
 * @property Ouvrier $Ouvrier
 * @property Typetenue $Typetenue
 * @property Typemission $Typemission
 * 
 * @method integer     getId()              Returns the current record's "id" value
 * @method string      getTache()           Returns the current record's "tache" value
 * @method integer     getIdAgents()        Returns the current record's "id_agents" value
 * @method string      getObservation()     Returns the current record's "observation" value
 * @method string      getCaracteristique() Returns the current record's "caracteristique" value
 * @method integer     getIdOuvrier()       Returns the current record's "id_ouvrier" value
 * @method string      getPersonnel()       Returns the current record's "personnel" value
 * @method date        getDate()            Returns the current record's "date" value
 * @method integer     getIdTypetenue()     Returns the current record's "id_typetenue" value
 * @method integer     getIdTypemission()   Returns the current record's "id_typemission" value
 * @method Agents      getAgents()          Returns the current record's "Agents" value
 * @method Ouvrier     getOuvrier()         Returns the current record's "Ouvrier" value
 * @method Typetenue   getTypetenue()       Returns the current record's "Typetenue" value
 * @method Typemission getTypemission()     Returns the current record's "Typemission" value
 * @method Tenues      setId()              Sets the current record's "id" value
 * @method Tenues      setTache()           Sets the current record's "tache" value
 * @method Tenues      setIdAgents()        Sets the current record's "id_agents" value
 * @method Tenues      setObservation()     Sets the current record's "observation" value
 * @method Tenues      setCaracteristique() Sets the current record's "caracteristique" value
 * @method Tenues      setIdOuvrier()       Sets the current record's "id_ouvrier" value
 * @method Tenues      setPersonnel()       Sets the current record's "personnel" value
 * @method Tenues      setDate()            Sets the current record's "date" value
 * @method Tenues      setIdTypetenue()     Sets the current record's "id_typetenue" value
 * @method Tenues      setIdTypemission()   Sets the current record's "id_typemission" value
 * @method Tenues      setAgents()          Sets the current record's "Agents" value
 * @method Tenues      setOuvrier()         Sets the current record's "Ouvrier" value
 * @method Tenues      setTypetenue()       Sets the current record's "Typetenue" value
 * @method Tenues      setTypemission()     Sets the current record's "Typemission" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTenues extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tenues');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'tenues_id',
             'length' => 4,
             ));
        $this->hasColumn('tache', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('observation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('caracteristique', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_ouvrier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('personnel', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_typetenue', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_typemission', 'integer', 4, array(
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

        $this->hasOne('Ouvrier', array(
             'local' => 'id_ouvrier',
             'foreign' => 'id'));

        $this->hasOne('Typetenue', array(
             'local' => 'id_typetenue',
             'foreign' => 'id'));

        $this->hasOne('Typemission', array(
             'local' => 'id_typemission',
             'foreign' => 'id'));
    }
}