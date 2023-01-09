<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Demarcheur', 'doctrine');

/**
 * BaseDemarcheur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nomcomplet
 * @property integer $id_agent
 * @property string $gsm
 * @property Agents $Agents
 * @property Doctrine_Collection $Ligneoperationcaisse
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getNomcomplet()           Returns the current record's "nomcomplet" value
 * @method integer             getIdAgent()              Returns the current record's "id_agent" value
 * @method string              getGsm()                  Returns the current record's "gsm" value
 * @method Agents              getAgents()               Returns the current record's "Agents" value
 * @method Doctrine_Collection getLigneoperationcaisse() Returns the current record's "Ligneoperationcaisse" collection
 * @method Demarcheur          setId()                   Sets the current record's "id" value
 * @method Demarcheur          setNomcomplet()           Sets the current record's "nomcomplet" value
 * @method Demarcheur          setIdAgent()              Sets the current record's "id_agent" value
 * @method Demarcheur          setGsm()                  Sets the current record's "gsm" value
 * @method Demarcheur          setAgents()               Sets the current record's "Agents" value
 * @method Demarcheur          setLigneoperationcaisse() Sets the current record's "Ligneoperationcaisse" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDemarcheur extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('demarcheur');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'demarcheur_id',
             'length' => 4,
             ));
        $this->hasColumn('nomcomplet', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('id_agent', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('gsm', 'string', 8, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Agents', array(
             'local' => 'id_agent',
             'foreign' => 'id'));

        $this->hasMany('Ligneoperationcaisse', array(
             'local' => 'id',
             'foreign' => 'id_demarcheur'));
    }
}