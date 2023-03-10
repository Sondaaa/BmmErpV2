<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Reglementcomptable', 'doctrine');

/**
 * BaseReglementcomptable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $date
 * @property string $refrence
 * @property decimal $totalht
 * @property decimal $totaltva
 * @property decimal $timbre
 * @property decimal $totalttc
 * @property integer $id_dossier
 * @property date $dateimportation
 * @property integer $saisie
 * @property integer $id_piececomptable
 * @property integer $numero
 * @property date $datevaleur
 * @property string $libelle
 * @property string $type
 * @property integer $id_comptecomptable
 * @property integer $id_banque
 * @property integer $id_journal
 * @property integer $id_frs
 * @property integer $id_mouvement
 * @property Caissesbanques $Caissesbanques
 * @property Plandossiercomptable $Plandossiercomptable
 * @property Dossiercomptable $Dossiercomptable
 * @property Fournisseur $Fournisseur
 * @property Journalcomptable $Journalcomptable
 * @property Mouvementbanciare $Mouvementbanciare
 * @property Doctrine_Collection $Lignepiececomptable
 * 
 * @method integer              getId()                   Returns the current record's "id" value
 * @method date                 getDate()                 Returns the current record's "date" value
 * @method string               getRefrence()             Returns the current record's "refrence" value
 * @method decimal              getTotalht()              Returns the current record's "totalht" value
 * @method decimal              getTotaltva()             Returns the current record's "totaltva" value
 * @method decimal              getTimbre()               Returns the current record's "timbre" value
 * @method decimal              getTotalttc()             Returns the current record's "totalttc" value
 * @method integer              getIdDossier()            Returns the current record's "id_dossier" value
 * @method date                 getDateimportation()      Returns the current record's "dateimportation" value
 * @method integer              getSaisie()               Returns the current record's "saisie" value
 * @method integer              getIdPiececomptable()     Returns the current record's "id_piececomptable" value
 * @method integer              getNumero()               Returns the current record's "numero" value
 * @method date                 getDatevaleur()           Returns the current record's "datevaleur" value
 * @method string               getLibelle()              Returns the current record's "libelle" value
 * @method string               getType()                 Returns the current record's "type" value
 * @method integer              getIdComptecomptable()    Returns the current record's "id_comptecomptable" value
 * @method integer              getIdBanque()             Returns the current record's "id_banque" value
 * @method integer              getIdJournal()            Returns the current record's "id_journal" value
 * @method integer              getIdFrs()                Returns the current record's "id_frs" value
 * @method integer              getIdMouvement()          Returns the current record's "id_mouvement" value
 * @method Caissesbanques       getCaissesbanques()       Returns the current record's "Caissesbanques" value
 * @method Plandossiercomptable getPlandossiercomptable() Returns the current record's "Plandossiercomptable" value
 * @method Dossiercomptable     getDossiercomptable()     Returns the current record's "Dossiercomptable" value
 * @method Fournisseur          getFournisseur()          Returns the current record's "Fournisseur" value
 * @method Journalcomptable     getJournalcomptable()     Returns the current record's "Journalcomptable" value
 * @method Mouvementbanciare    getMouvementbanciare()    Returns the current record's "Mouvementbanciare" value
 * @method Doctrine_Collection  getLignepiececomptable()  Returns the current record's "Lignepiececomptable" collection
 * @method Reglementcomptable   setId()                   Sets the current record's "id" value
 * @method Reglementcomptable   setDate()                 Sets the current record's "date" value
 * @method Reglementcomptable   setRefrence()             Sets the current record's "refrence" value
 * @method Reglementcomptable   setTotalht()              Sets the current record's "totalht" value
 * @method Reglementcomptable   setTotaltva()             Sets the current record's "totaltva" value
 * @method Reglementcomptable   setTimbre()               Sets the current record's "timbre" value
 * @method Reglementcomptable   setTotalttc()             Sets the current record's "totalttc" value
 * @method Reglementcomptable   setIdDossier()            Sets the current record's "id_dossier" value
 * @method Reglementcomptable   setDateimportation()      Sets the current record's "dateimportation" value
 * @method Reglementcomptable   setSaisie()               Sets the current record's "saisie" value
 * @method Reglementcomptable   setIdPiececomptable()     Sets the current record's "id_piececomptable" value
 * @method Reglementcomptable   setNumero()               Sets the current record's "numero" value
 * @method Reglementcomptable   setDatevaleur()           Sets the current record's "datevaleur" value
 * @method Reglementcomptable   setLibelle()              Sets the current record's "libelle" value
 * @method Reglementcomptable   setType()                 Sets the current record's "type" value
 * @method Reglementcomptable   setIdComptecomptable()    Sets the current record's "id_comptecomptable" value
 * @method Reglementcomptable   setIdBanque()             Sets the current record's "id_banque" value
 * @method Reglementcomptable   setIdJournal()            Sets the current record's "id_journal" value
 * @method Reglementcomptable   setIdFrs()                Sets the current record's "id_frs" value
 * @method Reglementcomptable   setIdMouvement()          Sets the current record's "id_mouvement" value
 * @method Reglementcomptable   setCaissesbanques()       Sets the current record's "Caissesbanques" value
 * @method Reglementcomptable   setPlandossiercomptable() Sets the current record's "Plandossiercomptable" value
 * @method Reglementcomptable   setDossiercomptable()     Sets the current record's "Dossiercomptable" value
 * @method Reglementcomptable   setFournisseur()          Sets the current record's "Fournisseur" value
 * @method Reglementcomptable   setJournalcomptable()     Sets the current record's "Journalcomptable" value
 * @method Reglementcomptable   setMouvementbanciare()    Sets the current record's "Mouvementbanciare" value
 * @method Reglementcomptable   setLignepiececomptable()  Sets the current record's "Lignepiececomptable" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseReglementcomptable extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reglementcomptable');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'reglementcomptable_id',
             'length' => 4,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('refrence', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('totalht', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('totaltva', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('timbre', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('totalttc', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_dossier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dateimportation', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('saisie', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('id_piececomptable', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('datevaleur', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('type', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_comptecomptable', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_banque', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_journal', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_frs', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_mouvement', 'integer', 4, array(
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
        $this->hasOne('Caissesbanques', array(
             'local' => 'id_banque',
             'foreign' => 'id'));

        $this->hasOne('Plandossiercomptable', array(
             'local' => 'id_comptecomptable',
             'foreign' => 'id'));

        $this->hasOne('Dossiercomptable', array(
             'local' => 'id_dossier',
             'foreign' => 'id'));

        $this->hasOne('Fournisseur', array(
             'local' => 'id_frs',
             'foreign' => 'id'));

        $this->hasOne('Journalcomptable', array(
             'local' => 'id_journal',
             'foreign' => 'id'));

        $this->hasOne('Mouvementbanciare', array(
             'local' => 'id_mouvement',
             'foreign' => 'id'));

        $this->hasMany('Lignepiececomptable', array(
             'local' => 'id',
             'foreign' => 'id_regelment'));
    }
}