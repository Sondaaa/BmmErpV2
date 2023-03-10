<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Entetepaie', 'doctrine');

/**
 * BaseEntetepaie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $mois
 * @property integer $annee
 * @property string $idrh
 * @property string $nomcomplet
 * @property string $numaffiliation
 * @property date $dateembauche
 * @property string $qualification
 * @property string $categorie
 * @property string $echelle
 * @property string $echelon
 * @property string $etatcivil
 * @property decimal $salairedebase
 * @property integer $id_agents
 * @property Agents $Agents
 * @property Doctrine_Collection $Paiement
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method integer             getMois()           Returns the current record's "mois" value
 * @method integer             getAnnee()          Returns the current record's "annee" value
 * @method string              getIdrh()           Returns the current record's "idrh" value
 * @method string              getNomcomplet()     Returns the current record's "nomcomplet" value
 * @method string              getNumaffiliation() Returns the current record's "numaffiliation" value
 * @method date                getDateembauche()   Returns the current record's "dateembauche" value
 * @method string              getQualification()  Returns the current record's "qualification" value
 * @method string              getCategorie()      Returns the current record's "categorie" value
 * @method string              getEchelle()        Returns the current record's "echelle" value
 * @method string              getEchelon()        Returns the current record's "echelon" value
 * @method string              getEtatcivil()      Returns the current record's "etatcivil" value
 * @method decimal             getSalairedebase()  Returns the current record's "salairedebase" value
 * @method integer             getIdAgents()       Returns the current record's "id_agents" value
 * @method Agents              getAgents()         Returns the current record's "Agents" value
 * @method Doctrine_Collection getPaiement()       Returns the current record's "Paiement" collection
 * @method Entetepaie          setId()             Sets the current record's "id" value
 * @method Entetepaie          setMois()           Sets the current record's "mois" value
 * @method Entetepaie          setAnnee()          Sets the current record's "annee" value
 * @method Entetepaie          setIdrh()           Sets the current record's "idrh" value
 * @method Entetepaie          setNomcomplet()     Sets the current record's "nomcomplet" value
 * @method Entetepaie          setNumaffiliation() Sets the current record's "numaffiliation" value
 * @method Entetepaie          setDateembauche()   Sets the current record's "dateembauche" value
 * @method Entetepaie          setQualification()  Sets the current record's "qualification" value
 * @method Entetepaie          setCategorie()      Sets the current record's "categorie" value
 * @method Entetepaie          setEchelle()        Sets the current record's "echelle" value
 * @method Entetepaie          setEchelon()        Sets the current record's "echelon" value
 * @method Entetepaie          setEtatcivil()      Sets the current record's "etatcivil" value
 * @method Entetepaie          setSalairedebase()  Sets the current record's "salairedebase" value
 * @method Entetepaie          setIdAgents()       Sets the current record's "id_agents" value
 * @method Entetepaie          setAgents()         Sets the current record's "Agents" value
 * @method Entetepaie          setPaiement()       Sets the current record's "Paiement" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEntetepaie extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('entetepaie');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'entetepaie_id',
             'length' => 4,
             ));
        $this->hasColumn('mois', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('annee', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('idrh', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('nomcomplet', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('numaffiliation', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('dateembauche', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('qualification', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('categorie', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('echelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('echelon', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('etatcivil', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('salairedebase', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
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

        $this->hasMany('Paiement', array(
             'local' => 'id',
             'foreign' => 'id_entetpaie'));
    }
}