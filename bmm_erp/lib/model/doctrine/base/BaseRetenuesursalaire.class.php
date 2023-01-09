<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Retenuesursalaire', 'doctrine');

/**
 * BaseRetenuesursalaire
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_fournisseur
 * @property string $naturepret
 * @property decimal $montantpret
 * @property decimal $retenuesursalaire
 * @property integer $nbrmois
 * @property date $datedebut
 * @property date $datefin
 * @property integer $id_agents
 * @property integer $mois
 * @property integer $annee
 * @property date $datedemande
 * @property boolean $paye
 * @property decimal $salairenetapayer
 * @property boolean $valide
 * @property integer $pourcentagedesalaire
 * @property decimal $montantdupourcentage
 * @property Agents $Agents
 * @property Fournisseur $Fournisseur
 * @property Doctrine_Collection $Historiqueretenue
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method integer             getIdFournisseur()        Returns the current record's "id_fournisseur" value
 * @method string              getNaturepret()           Returns the current record's "naturepret" value
 * @method decimal             getMontantpret()          Returns the current record's "montantpret" value
 * @method decimal             getRetenuesursalaire()    Returns the current record's "retenuesursalaire" value
 * @method integer             getNbrmois()              Returns the current record's "nbrmois" value
 * @method date                getDatedebut()            Returns the current record's "datedebut" value
 * @method date                getDatefin()              Returns the current record's "datefin" value
 * @method integer             getIdAgents()             Returns the current record's "id_agents" value
 * @method integer             getMois()                 Returns the current record's "mois" value
 * @method integer             getAnnee()                Returns the current record's "annee" value
 * @method date                getDatedemande()          Returns the current record's "datedemande" value
 * @method boolean             getPaye()                 Returns the current record's "paye" value
 * @method decimal             getSalairenetapayer()     Returns the current record's "salairenetapayer" value
 * @method boolean             getValide()               Returns the current record's "valide" value
 * @method integer             getPourcentagedesalaire() Returns the current record's "pourcentagedesalaire" value
 * @method decimal             getMontantdupourcentage() Returns the current record's "montantdupourcentage" value
 * @method Agents              getAgents()               Returns the current record's "Agents" value
 * @method Fournisseur         getFournisseur()          Returns the current record's "Fournisseur" value
 * @method Doctrine_Collection getHistoriqueretenue()    Returns the current record's "Historiqueretenue" collection
 * @method Retenuesursalaire   setId()                   Sets the current record's "id" value
 * @method Retenuesursalaire   setIdFournisseur()        Sets the current record's "id_fournisseur" value
 * @method Retenuesursalaire   setNaturepret()           Sets the current record's "naturepret" value
 * @method Retenuesursalaire   setMontantpret()          Sets the current record's "montantpret" value
 * @method Retenuesursalaire   setRetenuesursalaire()    Sets the current record's "retenuesursalaire" value
 * @method Retenuesursalaire   setNbrmois()              Sets the current record's "nbrmois" value
 * @method Retenuesursalaire   setDatedebut()            Sets the current record's "datedebut" value
 * @method Retenuesursalaire   setDatefin()              Sets the current record's "datefin" value
 * @method Retenuesursalaire   setIdAgents()             Sets the current record's "id_agents" value
 * @method Retenuesursalaire   setMois()                 Sets the current record's "mois" value
 * @method Retenuesursalaire   setAnnee()                Sets the current record's "annee" value
 * @method Retenuesursalaire   setDatedemande()          Sets the current record's "datedemande" value
 * @method Retenuesursalaire   setPaye()                 Sets the current record's "paye" value
 * @method Retenuesursalaire   setSalairenetapayer()     Sets the current record's "salairenetapayer" value
 * @method Retenuesursalaire   setValide()               Sets the current record's "valide" value
 * @method Retenuesursalaire   setPourcentagedesalaire() Sets the current record's "pourcentagedesalaire" value
 * @method Retenuesursalaire   setMontantdupourcentage() Sets the current record's "montantdupourcentage" value
 * @method Retenuesursalaire   setAgents()               Sets the current record's "Agents" value
 * @method Retenuesursalaire   setFournisseur()          Sets the current record's "Fournisseur" value
 * @method Retenuesursalaire   setHistoriqueretenue()    Sets the current record's "Historiqueretenue" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRetenuesursalaire extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('retenuesursalaire');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'retenuesursalaire_id',
             'length' => 4,
             ));
        $this->hasColumn('id_fournisseur', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('naturepret', 'string', 1, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('montantpret', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('retenuesursalaire', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('nbrmois', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('datedebut', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datefin', 'date', 25, array(
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
        $this->hasColumn('datedemande', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('paye', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('salairenetapayer', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('valide', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('pourcentagedesalaire', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantdupourcentage', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Agents', array(
             'local' => 'id_agents',
             'foreign' => 'id'));

        $this->hasOne('Fournisseur', array(
             'local' => 'id_fournisseur',
             'foreign' => 'id'));

        $this->hasMany('Historiqueretenue', array(
             'local' => 'id',
             'foreign' => 'id_retenue'));
    }
}