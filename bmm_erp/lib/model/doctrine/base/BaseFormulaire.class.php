<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Formulaire', 'doctrine');

/**
 * BaseFormulaire
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property integer $id_contrat

 * @property integer $note2
 * @property integer $note3
 * @property integer $note1
  * @property string $cheminsignature
 * @property string $total
 * @property string $mayen
 * @property string $dureemois
 * @property string $dureejou
 * @property integer $nbpointmois
 * @property integer $nbrponitsjour
 * @property string $totalpoint
 * @property string $etat
 * 
 * @property string $ancienete
 * @property integer $nbrpointsancien
 * @property integer $nbrpointjouranci
 * @property string $totalponitanci
 * @property Agents $Agents
 * @property Contrat $Contrat

 * 
 * @method integer     getId()               Returns the current record's "id" value
 * @method integer     getIdAgents()         Returns the current record's "id_agents" value
 * @method integer     getIdContrat()        Returns the current record's "id_contrat" value

 * @method integer     getNote2()            Returns the current record's "note2" value
 * @method integer     getNote3()            Returns the current record's "note3" value
 * @method integer     getNote1()            Returns the current record's "note1" value
  * @method string      getCheminsignature()      Returns the current record's "cheminsignature" value
 * @method string      getTotal()            Returns the current record's "total" value
 * @method string      getMayen()            Returns the current record's "mayen" value
 * @method string      getDureemois()        Returns the current record's "dureemois" value
 * @method string      getDureejou()         Returns the current record's "dureejou" value
 * @method integer     getNbpointmois()      Returns the current record's "nbpointmois" value
 * @method integer     getNbrponitsjour()    Returns the current record's "nbrponitsjour" value
 * @method string      getTotalpoint()       Returns the current record's "totalpoint" value
 * @method integer     getNbrpointsancien()  Returns the current record's "nbrpointsancien" value
 * @method integer     getNbrpointjouranci() Returns the current record's "nbrpointjouranci" value
 * @method string      getTotalponitanci()   Returns the current record's "totalponitanci" value
 * @method string      getEtat()             Returns the current record's "etat" value
 * 
 *  @method string      getAncienete()       Returns the current record's "ancienete" value
 *
 * @method Agents      getAgents()           Returns the current record's "Agents" value
 * @method Contrat     getContrat()          Returns the current record's "Contrat" value
 
 * @method Formulaire  setId()               Sets the current record's "id" value
 * @method Formulaire  setIdAgents()         Sets the current record's "id_agents" value
 * @method Formulaire  setIdContrat()        Sets the current record's "id_contrat" value

 * @method Formulaire  setNote2()            Sets the current record's "note2" value
 * @method Formulaire  setNote3()            Sets the current record's "note3" value
 * @method Formulaire  setNote1()            Sets the current record's "note1" value
 * @method Formulaire  setTotal()            Sets the current record's "total" value
 * @method Formulaire  setMayen()            Sets the current record's "mayen" value
 * @method Formulaire  setDureemois()        Sets the current record's "dureemois" value
 * @method Formulaire  setDureejou()         Sets the current record's "dureejou" value
 * @method Formulaire  setNbpointmois()      Sets the current record's "nbpointmois" value
 * @method Formulaire  setCheminsignature()      Sets the current record's "cheminsignature" value
 * @method Formulaire  setNbrponitsjour()    Sets the current record's "nbrponitsjour" value
 * @method Formulaire  setTotalpoint()       Sets the current record's "totalpoint" value
 * @method Formulaire  setNbrpointsancien()  Sets the current record's "nbrpointsancien" value
 * @method Formulaire  setNbrpointjouranci() Sets the current record's "nbrpointjouranci" value
 * @method Formulaire  setTotalponitanci()   Sets the current record's "totalponitanci" value
 * @method Formulaire  setEtat()             Sets the current record's "etat" value
 * @method Formulaire  setAncienete()             Sets the current record's "ancienete" value
 *
 *  @method Formulaire  setAgents()           Sets the current record's "Agents" value
 * @method Formulaire  setContrat()          Sets the current record's "Contrat" value

 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFormulaire extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('formulaire');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'formulaire_id',
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
        $this->hasColumn('id_contrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('cheminsignature', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('note2', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('note3', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('note1', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('total', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
         $this->hasColumn('etat', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('mayen', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('dureemois', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('dureejou', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('nbpointmois', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrponitsjour', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('totalpoint', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        
         $this->hasColumn('ancienete', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('nbrpointsancien', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrpointjouranci', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('totalponitanci', 'string', 255, array(
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

        $this->hasOne('Contrat', array(
             'local' => 'id_contrat',
             'foreign' => 'id'));

      
    }
}