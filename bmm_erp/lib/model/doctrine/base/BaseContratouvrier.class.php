<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Contratouvrier', 'doctrine');

/**
 * BaseContratouvrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $daterecrutement
 * @property integer $id_ouvrier
 * @property integer $id_specialteouvrier
 * @property integer $id_chantier
 * @property integer $id_lieuaffetation
 * @property string $montant
 * @property date $datedebutcontrat
 * @property date $datefincontrat
 * @property integer $id_situationadmini
 * @property integer $id_projet
 * @property string $montnattot
 * @property string $nbjour
 * @property integer $id_retraite
 * @property date $dateretraite
 * @property integer $id_salairejouralier
 * @property Chantier $Chantier
 * @property Lieuaffectationouvrier $Lieuaffectationouvrier
 * @property Ouvrier $Ouvrier
 * @property Projet $Projet
 * @property Retraite $Retraite
 * @property Situationadminouvrier $Situationadminouvrier
 * @property Specialiteouvrier $Specialiteouvrier
 * @property Salairejournalier $Salairejournalier
 * @property Doctrine_Collection $Historiquecontratouvrier
 * @property Doctrine_Collection $Salaireouvrier
 * @property Doctrine_Collection $Attestationouvrier
 * 
 * @method integer                getId()                       Returns the current record's "id" value
 * @method date                   getDaterecrutement()          Returns the current record's "daterecrutement" value
 * @method integer                getIdOuvrier()                Returns the current record's "id_ouvrier" value
 * @method integer                getIdSpecialteouvrier()       Returns the current record's "id_specialteouvrier" value
 * @method integer                getIdChantier()               Returns the current record's "id_chantier" value
 * @method integer                getIdLieuaffetation()         Returns the current record's "id_lieuaffetation" value
 * @method string                 getMontant()                  Returns the current record's "montant" value
 * @method date                   getDatedebutcontrat()         Returns the current record's "datedebutcontrat" value
 * @method date                   getDatefincontrat()           Returns the current record's "datefincontrat" value
 * @method integer                getIdSituationadmini()        Returns the current record's "id_situationadmini" value
 * @method integer                getIdProjet()                 Returns the current record's "id_projet" value
 * @method string                 getMontnattot()               Returns the current record's "montnattot" value
 * @method string                 getNbjour()                   Returns the current record's "nbjour" value
 * @method integer                getIdRetraite()               Returns the current record's "id_retraite" value
 * @method date                   getDateretraite()             Returns the current record's "dateretraite" value
 * @method integer                getIdSalairejouralier()       Returns the current record's "id_salairejouralier" value
 * @method Chantier               getChantier()                 Returns the current record's "Chantier" value
 * @method Lieuaffectationouvrier getLieuaffectationouvrier()   Returns the current record's "Lieuaffectationouvrier" value
 * @method Ouvrier                getOuvrier()                  Returns the current record's "Ouvrier" value
 * @method Projet                 getProjet()                   Returns the current record's "Projet" value
 * @method Retraite               getRetraite()                 Returns the current record's "Retraite" value
 * @method Situationadminouvrier  getSituationadminouvrier()    Returns the current record's "Situationadminouvrier" value
 * @method Specialiteouvrier      getSpecialiteouvrier()        Returns the current record's "Specialiteouvrier" value
 * @method Salairejournalier      getSalairejournalier()        Returns the current record's "Salairejournalier" value
 * @method Doctrine_Collection    getHistoriquecontratouvrier() Returns the current record's "Historiquecontratouvrier" collection
 * @method Doctrine_Collection    getSalaireouvrier()           Returns the current record's "Salaireouvrier" collection
 * @method Doctrine_Collection    getAttestationouvrier()       Returns the current record's "Attestationouvrier" collection
 * @method Contratouvrier         setId()                       Sets the current record's "id" value
 * @method Contratouvrier         setDaterecrutement()          Sets the current record's "daterecrutement" value
 * @method Contratouvrier         setIdOuvrier()                Sets the current record's "id_ouvrier" value
 * @method Contratouvrier         setIdSpecialteouvrier()       Sets the current record's "id_specialteouvrier" value
 * @method Contratouvrier         setIdChantier()               Sets the current record's "id_chantier" value
 * @method Contratouvrier         setIdLieuaffetation()         Sets the current record's "id_lieuaffetation" value
 * @method Contratouvrier         setMontant()                  Sets the current record's "montant" value
 * @method Contratouvrier         setDatedebutcontrat()         Sets the current record's "datedebutcontrat" value
 * @method Contratouvrier         setDatefincontrat()           Sets the current record's "datefincontrat" value
 * @method Contratouvrier         setIdSituationadmini()        Sets the current record's "id_situationadmini" value
 * @method Contratouvrier         setIdProjet()                 Sets the current record's "id_projet" value
 * @method Contratouvrier         setMontnattot()               Sets the current record's "montnattot" value
 * @method Contratouvrier         setNbjour()                   Sets the current record's "nbjour" value
 * @method Contratouvrier         setIdRetraite()               Sets the current record's "id_retraite" value
 * @method Contratouvrier         setDateretraite()             Sets the current record's "dateretraite" value
 * @method Contratouvrier         setIdSalairejouralier()       Sets the current record's "id_salairejouralier" value
 * @method Contratouvrier         setChantier()                 Sets the current record's "Chantier" value
 * @method Contratouvrier         setLieuaffectationouvrier()   Sets the current record's "Lieuaffectationouvrier" value
 * @method Contratouvrier         setOuvrier()                  Sets the current record's "Ouvrier" value
 * @method Contratouvrier         setProjet()                   Sets the current record's "Projet" value
 * @method Contratouvrier         setRetraite()                 Sets the current record's "Retraite" value
 * @method Contratouvrier         setSituationadminouvrier()    Sets the current record's "Situationadminouvrier" value
 * @method Contratouvrier         setSpecialiteouvrier()        Sets the current record's "Specialiteouvrier" value
 * @method Contratouvrier         setSalairejournalier()        Sets the current record's "Salairejournalier" value
 * @method Contratouvrier         setHistoriquecontratouvrier() Sets the current record's "Historiquecontratouvrier" collection
 * @method Contratouvrier         setSalaireouvrier()           Sets the current record's "Salaireouvrier" collection
 * @method Contratouvrier         setAttestationouvrier()       Sets the current record's "Attestationouvrier" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContratouvrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contratouvrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'contratouvrier_id',
             'length' => 4,
             ));
        $this->hasColumn('daterecrutement', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
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
        $this->hasColumn('id_specialteouvrier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_chantier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_lieuaffetation', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montant', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('datedebutcontrat', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datefincontrat', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_situationadmini', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_projet', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montnattot', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('nbjour', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_retraite', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dateretraite', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_salairejouralier', 'integer', 4, array(
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
        $this->hasOne('Chantier', array(
             'local' => 'id_chantier',
             'foreign' => 'id'));

        $this->hasOne('Lieuaffectationouvrier', array(
             'local' => 'id_lieuaffetation',
             'foreign' => 'id'));

        $this->hasOne('Ouvrier', array(
             'local' => 'id_ouvrier',
             'foreign' => 'id'));

        $this->hasOne('Projet', array(
             'local' => 'id_projet',
             'foreign' => 'id'));

        $this->hasOne('Retraite', array(
             'local' => 'id_retraite',
             'foreign' => 'id'));

        $this->hasOne('Situationadminouvrier', array(
             'local' => 'id_situationadmini',
             'foreign' => 'id'));

        $this->hasOne('Specialiteouvrier', array(
             'local' => 'id_specialteouvrier',
             'foreign' => 'id'));

        $this->hasOne('Salairejournalier', array(
             'local' => 'id_salairejouralier',
             'foreign' => 'id'));

        $this->hasMany('Historiquecontratouvrier', array(
             'local' => 'id',
             'foreign' => 'id_contratouvrier'));

        $this->hasMany('Salaireouvrier', array(
             'local' => 'id',
             'foreign' => 'id_contratouvrier'));

        $this->hasMany('Attestationouvrier', array(
             'local' => 'id',
             'foreign' => 'id_contratouvrier'));
    }
}