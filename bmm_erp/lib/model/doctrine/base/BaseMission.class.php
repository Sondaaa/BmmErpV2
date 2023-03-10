<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Mission', 'doctrine');

/**
 * BaseMission
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property integer $id_ouvrier
 * @property integer $id_lieu
 * @property string $duree
 * @property string $cheminsignagents
 * @property string $cheminsigndirecteur
 * @property string $cheminsignadaf
 * @property date $datesortie
 * @property string $heuresortie
 * @property string $moyentransport
 * @property string $mission
 * @property string $reference
 * @property string $logenment
 * @property date $datearrive
 * @property string $heurearrive
 * @property string $signatureagents
 * @property string $signaturedirecteur
 * @property Agents $Agents
 * @property Ouvrier $Ouvrier
 * @property Lieutravail $Lieutravail
 * 
 * @method integer     getId()                 Returns the current record's "id" value
 * @method integer     getIdAgents()           Returns the current record's "id_agents" value
 * @method integer     getIdOuvrier()          Returns the current record's "id_ouvrier" value
 * @method integer     getIdLieu()             Returns the current record's "id_lieu" value
 * @method string      getDuree()              Returns the current record's "duree" value
 * @method date        getDatesortie()         Returns the current record's "datesortie" value
 * @method string      getHeuresortie()        Returns the current record's "heuresortie" value
 * @method string      getCheminsignagents()      Returns the current record's "cheminsignagents" value
 * @method string      getCheminsigndirecteur()      Returns the current record's "cheminsigndirecteur" value
 * @method string      getCheminsignadaf()      Returns the current record's "cheminsignadaf" value
 * @method string      getMoyentransport()     Returns the current record's "moyentransport" value
 * @method string      getMission()            Returns the current record's "mission" value
 * @method string      getReference()          Returns the current record's "reference" value
 * @method string      getLogenment()          Returns the current record's "logenment" value
 * @method date        getDatearrive()         Returns the current record's "datearrive" value
 * @method string      getHeurearrive()        Returns the current record's "heurearrive" value
 * @method string      getSignatureagents()    Returns the current record's "signatureagents" value
 * @method string      getSignaturedirecteur() Returns the current record's "signaturedirecteur" value
 * @method Agents      getAgents()             Returns the current record's "Agents" value
 * @method Ouvrier     getOuvrier()            Returns the current record's "Ouvrier" value
 * @method Lieutravail getLieutravail()        Returns the current record's "Lieutravail" value
 * @method Mission     setId()                 Sets the current record's "id" value
 * @method Mission     setIdAgents()           Sets the current record's "id_agents" value
 * @method Mission     setIdOuvrier()          Sets the current record's "id_ouvrier" value
 * @method Mission     setIdLieu()             Sets the current record's "id_lieu" value
 * @method Mission     setDuree()              Sets the current record's "duree" value
 * @method Mission     setDatesortie()         Sets the current record's "datesortie" value
 * @method Mission     setHeuresortie()        Sets the current record's "heuresortie" value
 * @method Mission     setMoyentransport()     Sets the current record's "moyentransport" value
 * @method Mission     setMission()            Sets the current record's "mission" value
 * @method Mission     setReference()          Sets the current record's "reference" value
 * @method Mission     setLogenment()          Sets the current record's "logenment" value
 * @method Mission     setDatearrive()         Sets the current record's "datearrive" value
 * @method Mission     setHeurearrive()        Sets the current record's "heurearrive" value
 * @method Mission           setCheminsignagents()      Sets the current record's "cheminsignagents" value
 * @method Mission           setCheminsigndirecteur()      Sets the current record's "cheminsigndirecteur" value
 * @method Mission           setCheminsignadaf()      Sets the current record's "cheminsignadaf" value
 * @method Mission     setSignatureagents()    Sets the current record's "signatureagents" value
 * @method Mission     setSignaturedirecteur() Sets the current record's "signaturedirecteur" value
 * @method Mission     setAgents()             Sets the current record's "Agents" value
 * @method Mission     setOuvrier()            Sets the current record's "Ouvrier" value
 * @method Mission     setLieutravail()        Sets the current record's "Lieutravail" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMission extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mission');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'mission_id',
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
        $this->hasColumn('id_ouvrier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
			 $this->hasColumn('cheminsignagents', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
			 $this->hasColumn('cheminsigndirecteur', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
			 $this->hasColumn('cheminsignadaf', 'string', null, array(
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
        $this->hasColumn('duree', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('datesortie', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('heuresortie', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('moyentransport', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('mission', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('reference', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('logenment', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('datearrive', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('heurearrive', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('signatureagents', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('signaturedirecteur', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
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

        $this->hasOne('Lieutravail', array(
             'local' => 'id_lieu',
             'foreign' => 'id'));
    }
}