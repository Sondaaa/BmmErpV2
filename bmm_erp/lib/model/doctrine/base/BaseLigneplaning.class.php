<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ligneplaning', 'doctrine');

/**
 * BaseLigneplaning
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $nordre
 * @property integer $numtheme
 * @property integer $id_regroupement
 * @property integer $id_sousrubrique
 * @property string $montant
 * @property string $montanttotalht
 * @property integer $id_besoins
 * @property string $theme
 * @property boolean $valide
 * @property integer $id_pluning
 * @property string $montantttc
 * @property date $dateformation
 * @property date $datefin
 * @property string $montantht
 * @property integer $id_formateur
 * @property integer $id_tva
 * @property string $mtva
 * @property integer $nbrjour
 * @property integer $nbrheure
 * @property string $montantristourne
 * @property string $montantsociete
 * @property string $mtvafinal
 * @property string $modalitecalcul
 * @property boolean $realise
 * @property string $motif
 * @property date $datedebutprevu
 * @property date $datefinprevu
 * @property integer $id_fournisseur
 * @property integer $id_facture
 * @property Besoinsdeformation $Besoinsdeformation
 * @property Formateur $Formateur
 * @property Planing $Planing
 * @property Regroupementtheme $Regroupementtheme
 * @property Sousrubrique $Sousrubrique
 * @property Tva $Tva
 * @property Fournisseur $Fournisseur
 * @property Documentachat $Documentachat
 * 
 * @method integer            getId()                 Returns the current record's "id" value
 * @method integer            getNordre()             Returns the current record's "nordre" value
 * @method integer            getNumtheme()           Returns the current record's "numtheme" value
 * @method integer            getIdRegroupement()     Returns the current record's "id_regroupement" value
 * @method integer            getIdSousrubrique()     Returns the current record's "id_sousrubrique" value
 * @method string             getMontant()            Returns the current record's "montant" value
 * @method string             getMontanttotalht()     Returns the current record's "montanttotalht" value
 * @method integer            getIdBesoins()          Returns the current record's "id_besoins" value
 * @method string             getTheme()              Returns the current record's "theme" value
 * @method boolean            getValide()             Returns the current record's "valide" value
 * @method integer            getIdPluning()          Returns the current record's "id_pluning" value
 * @method string             getMontantttc()         Returns the current record's "montantttc" value
 * @method date               getDateformation()      Returns the current record's "dateformation" value
 * @method date               getDatefin()            Returns the current record's "datefin" value
 * @method string             getMontantht()          Returns the current record's "montantht" value
 * @method integer            getIdFormateur()        Returns the current record's "id_formateur" value
 * @method integer            getIdTva()              Returns the current record's "id_tva" value
 * @method string             getMtva()               Returns the current record's "mtva" value
 * @method integer            getNbrjour()            Returns the current record's "nbrjour" value
 * @method integer            getNbrheure()           Returns the current record's "nbrheure" value
 * @method string             getMontantristourne()   Returns the current record's "montantristourne" value
 * @method string             getMontantsociete()     Returns the current record's "montantsociete" value
 * @method string             getMtvafinal()          Returns the current record's "mtvafinal" value
 * @method string             getModalitecalcul()     Returns the current record's "modalitecalcul" value
 * @method boolean            getRealise()            Returns the current record's "realise" value
 * @method string             getMotif()              Returns the current record's "motif" value
 * @method date               getDatedebutprevu()     Returns the current record's "datedebutprevu" value
 * @method date               getDatefinprevu()       Returns the current record's "datefinprevu" value
 * @method integer            getIdFournisseur()      Returns the current record's "id_fournisseur" value
 * @method integer            getIdFacture()          Returns the current record's "id_facture" value
 * @method Besoinsdeformation getBesoinsdeformation() Returns the current record's "Besoinsdeformation" value
 * @method Formateur          getFormateur()          Returns the current record's "Formateur" value
 * @method Planing            getPlaning()            Returns the current record's "Planing" value
 * @method Regroupementtheme  getRegroupementtheme()  Returns the current record's "Regroupementtheme" value
 * @method Sousrubrique       getSousrubrique()       Returns the current record's "Sousrubrique" value
 * @method Tva                getTva()                Returns the current record's "Tva" value
 * @method Fournisseur        getFournisseur()        Returns the current record's "Fournisseur" value
 * @method Documentachat      getDocumentachat()      Returns the current record's "Documentachat" value
 * @method Ligneplaning       setId()                 Sets the current record's "id" value
 * @method Ligneplaning       setNordre()             Sets the current record's "nordre" value
 * @method Ligneplaning       setNumtheme()           Sets the current record's "numtheme" value
 * @method Ligneplaning       setIdRegroupement()     Sets the current record's "id_regroupement" value
 * @method Ligneplaning       setIdSousrubrique()     Sets the current record's "id_sousrubrique" value
 * @method Ligneplaning       setMontant()            Sets the current record's "montant" value
 * @method Ligneplaning       setMontanttotalht()     Sets the current record's "montanttotalht" value
 * @method Ligneplaning       setIdBesoins()          Sets the current record's "id_besoins" value
 * @method Ligneplaning       setTheme()              Sets the current record's "theme" value
 * @method Ligneplaning       setValide()             Sets the current record's "valide" value
 * @method Ligneplaning       setIdPluning()          Sets the current record's "id_pluning" value
 * @method Ligneplaning       setMontantttc()         Sets the current record's "montantttc" value
 * @method Ligneplaning       setDateformation()      Sets the current record's "dateformation" value
 * @method Ligneplaning       setDatefin()            Sets the current record's "datefin" value
 * @method Ligneplaning       setMontantht()          Sets the current record's "montantht" value
 * @method Ligneplaning       setIdFormateur()        Sets the current record's "id_formateur" value
 * @method Ligneplaning       setIdTva()              Sets the current record's "id_tva" value
 * @method Ligneplaning       setMtva()               Sets the current record's "mtva" value
 * @method Ligneplaning       setNbrjour()            Sets the current record's "nbrjour" value
 * @method Ligneplaning       setNbrheure()           Sets the current record's "nbrheure" value
 * @method Ligneplaning       setMontantristourne()   Sets the current record's "montantristourne" value
 * @method Ligneplaning       setMontantsociete()     Sets the current record's "montantsociete" value
 * @method Ligneplaning       setMtvafinal()          Sets the current record's "mtvafinal" value
 * @method Ligneplaning       setModalitecalcul()     Sets the current record's "modalitecalcul" value
 * @method Ligneplaning       setRealise()            Sets the current record's "realise" value
 * @method Ligneplaning       setMotif()              Sets the current record's "motif" value
 * @method Ligneplaning       setDatedebutprevu()     Sets the current record's "datedebutprevu" value
 * @method Ligneplaning       setDatefinprevu()       Sets the current record's "datefinprevu" value
 * @method Ligneplaning       setIdFournisseur()      Sets the current record's "id_fournisseur" value
 * @method Ligneplaning       setIdFacture()          Sets the current record's "id_facture" value
 * @method Ligneplaning       setBesoinsdeformation() Sets the current record's "Besoinsdeformation" value
 * @method Ligneplaning       setFormateur()          Sets the current record's "Formateur" value
 * @method Ligneplaning       setPlaning()            Sets the current record's "Planing" value
 * @method Ligneplaning       setRegroupementtheme()  Sets the current record's "Regroupementtheme" value
 * @method Ligneplaning       setSousrubrique()       Sets the current record's "Sousrubrique" value
 * @method Ligneplaning       setTva()                Sets the current record's "Tva" value
 * @method Ligneplaning       setFournisseur()        Sets the current record's "Fournisseur" value
 * @method Ligneplaning       setDocumentachat()      Sets the current record's "Documentachat" value
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLigneplaning extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ligneplaning');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'ligneplaning_id',
             'length' => 4,
             ));
        $this->hasColumn('nordre', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('numtheme', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_regroupement', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_sousrubrique', 'integer', 4, array(
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
        $this->hasColumn('montanttotalht', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_besoins', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('theme', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('valide', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_pluning', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantttc', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('dateformation', 'date', 25, array(
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
        $this->hasColumn('montantht', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_formateur', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_tva', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('mtva', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('nbrjour', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrheure', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantristourne', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('montantsociete', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('mtvafinal', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('modalitecalcul', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('realise', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('motif', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('datedebutprevu', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datefinprevu', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_fournisseur', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_facture', 'integer', 4, array(
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
        $this->hasOne('Besoinsdeformation', array(
             'local' => 'id_besoins',
             'foreign' => 'id'));

        $this->hasOne('Formateur', array(
             'local' => 'id_formateur',
             'foreign' => 'id'));

        $this->hasOne('Planing', array(
             'local' => 'id_pluning',
             'foreign' => 'id'));

        $this->hasOne('Regroupementtheme', array(
             'local' => 'id_regroupement',
             'foreign' => 'id'));

        $this->hasOne('Sousrubrique', array(
             'local' => 'id_sousrubrique',
             'foreign' => 'id'));

        $this->hasOne('Tva', array(
             'local' => 'id_tva',
             'foreign' => 'id'));

        $this->hasOne('Fournisseur', array(
             'local' => 'id_fournisseur',
             'foreign' => 'id'));

        $this->hasOne('Documentachat', array(
             'local' => 'id_facture',
             'foreign' => 'id'));
    }
}