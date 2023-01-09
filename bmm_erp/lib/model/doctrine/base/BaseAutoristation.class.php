<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Autoristation', 'doctrine');

/**
 * BaseAutoristation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property string $hopital
 * @property date $date
 * @property string $moyen
 * @property string $causedevisite
 * @property string $cheminsignagents
 * @property string $cheminsigndirecteur
 * @property string $cheminmedecin
 * @property string $reference
 * @property integer $id_hopital
 * @property string $signatureagents
 * @property string $visamedecin
 * @property string $signaturedirecteur
 * @property string $decision
 * @property Agents $Agents
  * @property Hopital $Hopital
 * 
 * @method integer       getId()                 Returns the current record's "id" value
 * @method integer       getIdAgents()           Returns the current record's "id_agents" value
 * @method string        getHopital()            Returns the current record's "hopital" value
 * @method date          getDate()               Returns the current record's "date" value
 * @method string        getMoyen()              Returns the current record's "moyen" value
 * @method string        getCausedevisite()      Returns the current record's "causedevisite" value
* @method Hopital        getHopital()    		 Returns the current record's "Hopital" value
 * @method string        getReference()          Returns the current record's "reference" value
 * @method string        getSignatureagents()    Returns the current record's "signatureagents" value
 * @method string        getVisamedecin()        Returns the current record's "visamedecin" value
  * @method string      getCheminsignagents()      Returns the current record's "cheminsignagents" value
 * @method string      getCheminsigndirecteur()      Returns the current record's "cheminsigndirecteur" value
 * @method string      getCheminmedecin()      Returns the current record's "cheminmedecin" value
 * @method string        getSignaturedirecteur() Returns the current record's "signaturedirecteur" value
 * @method string        getDecision()           Returns the current record's "decision" value
 * @method Agents        getAgents()             Returns the current record's "Agents" value
 * @method integer       getIdHopital()   Returns the current record's "id_hopital" value
 * @method Autoristation setId()                 Sets the current record's "id" value
 * @method Autoristation setIdAgents()           Sets the current record's "id_agents" value

 * @method Autoristation setDate()               Sets the current record's "date" value
 * @method Autoristation setMoyen()              Sets the current record's "moyen" value
 * @method Autoristation setCausedevisite()      Sets the current record's "causedevisite" value
 * @method Autoristation setReference()          Sets the current record's "reference" value
 * @method Autoristation setSignatureagents()    Sets the current record's "signatureagents" value
 * @method Autoristation setHopital()           Sets the current record's "hopital" value
 * @method Autoristation setIdHopital()         Sets the current record's "id_hopital" value
 * @method Autoristation setVisamedecin()        Sets the current record's "visamedecin" value
 * @method Autoristation setCheminsignagents()      Sets the current record's "cheminsignagents" value
 * @method Autoristation setCheminsigndirecteur() Sets the current record's "cheminsigndirecteur" value
 * @method Autoristation setCheminmedecin()      Sets the current record's "cheminmedecin" value
 * @method Autoristation setSignaturedirecteur() Sets the current record's "signaturedirecteur" value
 * @method Autoristation setDecision()           Sets the current record's "decision" value
 * @method Autoristation setAgents()             Sets the current record's "Agents" value
  @method Demandederemboursement setHopital()     Sets the current record's "Hopital" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAutoristation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('autoristation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'autoristation_id',
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
	$this->hasColumn('id_hopital', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('hopital', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
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
			 $this->hasColumn('cheminmedecin', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('moyen', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('causedevisite', 'string', 255, array(
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
        $this->hasColumn('signatureagents', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('visamedecin', 'string', 255, array(
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
        $this->hasColumn('decision', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Agents', array(
             'local' => 'id_agents',
             'foreign' => 'id'));
	    $this->hasOne('Hopital', array(
             'local' => 'id_hopital',
             'foreign' => 'id'));
    }
}