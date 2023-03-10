<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Accidents', 'doctrine');

/**
 * BaseAccidents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $raison
 * @property string $adresse
 * @property date $date
 * @property integer $duree
 * @property string $typehandicap
 * @property integer $id_agents
 * @property string $type
 * @property integer $nbrjour
 * @property string $motif
 * @property string $observation
 * @property integer $id_lieu
 * @property Agents $Agents
 * @property Lieutravail $Lieutravail
 * 
 * @method integer     getId()           Returns the current record's "id" value
 * @method string      getRaison()       Returns the current record's "raison" value
 * @method string      getAdresse()      Returns the current record's "adresse" value
 * @method date        getDate()         Returns the current record's "date" value
 * @method integer     getDuree()        Returns the current record's "duree" value
 * @method string      getTypehandicap() Returns the current record's "typehandicap" value
 * @method integer     getIdAgents()     Returns the current record's "id_agents" value
 * @method string      getType()         Returns the current record's "type" value
 * @method integer     getNbrjour()      Returns the current record's "nbrjour" value
 * @method string      getMotif()        Returns the current record's "motif" value
 * @method string      getObservation()  Returns the current record's "observation" value
 * @method integer     getIdLieu()       Returns the current record's "id_lieu" value
 * @method Agents      getAgents()       Returns the current record's "Agents" value
 * @method Lieutravail getLieutravail()  Returns the current record's "Lieutravail" value
 * @method Accidents   setId()           Sets the current record's "id" value
 * @method Accidents   setRaison()       Sets the current record's "raison" value
 * @method Accidents   setAdresse()      Sets the current record's "adresse" value
 * @method Accidents   setDate()         Sets the current record's "date" value
 * @method Accidents   setDuree()        Sets the current record's "duree" value
 * @method Accidents   setTypehandicap() Sets the current record's "typehandicap" value
 * @method Accidents   setIdAgents()     Sets the current record's "id_agents" value
 * @method Accidents   setType()         Sets the current record's "type" value
 * @method Accidents   setNbrjour()      Sets the current record's "nbrjour" value
 * @method Accidents   setMotif()        Sets the current record's "motif" value
 * @method Accidents   setObservation()  Sets the current record's "observation" value
 * @method Accidents   setIdLieu()       Sets the current record's "id_lieu" value
 * @method Accidents   setAgents()       Sets the current record's "Agents" value
 * @method Accidents   setLieutravail()  Sets the current record's "Lieutravail" value
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAccidents extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('accidents');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'accidents_id',
             'length' => 4,
             ));
        $this->hasColumn('raison', 'string', 100, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('adresse', 'string', 150, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 150,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('duree', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('typehandicap', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
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
        $this->hasColumn('type', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('nbrjour', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('motif', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('observation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_lieu', 'integer', 4, array(
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

        $this->hasOne('Lieutravail', array(
             'local' => 'id_lieu',
             'foreign' => 'id'));
    }
}