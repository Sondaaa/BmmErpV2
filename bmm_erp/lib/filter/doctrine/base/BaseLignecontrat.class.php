<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignecontrat', 'doctrine');

/**
 * BaseLignecontrat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property decimal $cout
 * @property integer $id_articlestock
 * @property integer $id_doc
 * @property decimal $mntht
 * @property decimal $mnttva
 * @property decimal $mntthtva
 * @property decimal $mntttc
 * @property string $impudegt
 * @property string $codearticle
 * @property string $designationartcile
 * @property integer $id_tva
 * @property string $observation
 * @property decimal $punitaire
 * @property decimal $qte
 * @property integer $id_mag
 * @property integer $id_projet
 * @property integer $id_contrat
 * @property integer $nordre
 * @property string $unite
 * @property string $tauxfodec
 * @property decimal $fodec
 * @property decimal $prixu
 * @property integer $id_unite
 * @property integer $id_tauxfodec
 * @property integer $id_unitemarche
 * @property Article $Article
 * @property Magasin $Magasin
 * @property Tva $Tva
 * @property Projet $Projet
 * @property Contratachat $Contratachat
 * @property Typepiececontrat $Typepiececontrat
 * @property Tauxfodec $Tauxfodec
 * @property Unitemarche $Unitemarche
 * 
 * @method integer          getId()                 Returns the current record's "id" value
 * @method decimal          getCout()               Returns the current record's "cout" value
 * @method integer          getIdArticlestock()     Returns the current record's "id_articlestock" value
 * @method integer          getIdDoc()              Returns the current record's "id_doc" value
 * @method decimal          getMntht()              Returns the current record's "mntht" value
 * @method decimal          getMnttva()             Returns the current record's "mnttva" value
 * @method decimal          getMntthtva()           Returns the current record's "mntthtva" value
 * @method decimal          getMntttc()             Returns the current record's "mntttc" value
 * @method string           getImpudegt()           Returns the current record's "impudegt" value
 * @method string           getCodearticle()        Returns the current record's "codearticle" value
 * @method string           getDesignationartcile() Returns the current record's "designationartcile" value
 * @method integer          getIdTva()              Returns the current record's "id_tva" value
 * @method string           getObservation()        Returns the current record's "observation" value
 * @method decimal          getPunitaire()          Returns the current record's "punitaire" value
 * @method decimal          getQte()                Returns the current record's "qte" value
 * @method integer          getIdMag()              Returns the current record's "id_mag" value
 * @method integer          getIdProjet()           Returns the current record's "id_projet" value
 * @method integer          getIdContrat()          Returns the current record's "id_contrat" value
 * @method integer          getNordre()             Returns the current record's "nordre" value
 * @method string           getUnite()              Returns the current record's "unite" value
 * @method string           getTauxfodec()          Returns the current record's "tauxfodec" value
 * @method decimal          getFodec()              Returns the current record's "fodec" value
 * @method decimal          getPrixu()              Returns the current record's "prixu" value
 * @method integer          getIdUnite()            Returns the current record's "id_unite" value
 * @method integer          getIdTauxfodec()        Returns the current record's "id_tauxfodec" value
 * @method integer          getIdUnitemarche()      Returns the current record's "id_unitemarche" value
 * @method Article          getArticle()            Returns the current record's "Article" value
 * @method Magasin          getMagasin()            Returns the current record's "Magasin" value
 * @method Tva              getTva()                Returns the current record's "Tva" value
 * @method Projet           getProjet()             Returns the current record's "Projet" value
 * @method Contratachat     getContratachat()       Returns the current record's "Contratachat" value
 * @method Typepiececontrat getTypepiececontrat()   Returns the current record's "Typepiececontrat" value
 * @method Tauxfodec        getTauxfodec()          Returns the current record's "Tauxfodec" value
 * @method Unitemarche      getUnitemarche()        Returns the current record's "Unitemarche" value
 * @method Lignecontrat     setId()                 Sets the current record's "id" value
 * @method Lignecontrat     setCout()               Sets the current record's "cout" value
 * @method Lignecontrat     setIdArticlestock()     Sets the current record's "id_articlestock" value
 * @method Lignecontrat     setIdDoc()              Sets the current record's "id_doc" value
 * @method Lignecontrat     setMntht()              Sets the current record's "mntht" value
 * @method Lignecontrat     setMnttva()             Sets the current record's "mnttva" value
 * @method Lignecontrat     setMntthtva()           Sets the current record's "mntthtva" value
 * @method Lignecontrat     setMntttc()             Sets the current record's "mntttc" value
 * @method Lignecontrat     setImpudegt()           Sets the current record's "impudegt" value
 * @method Lignecontrat     setCodearticle()        Sets the current record's "codearticle" value
 * @method Lignecontrat     setDesignationartcile() Sets the current record's "designationartcile" value
 * @method Lignecontrat     setIdTva()              Sets the current record's "id_tva" value
 * @method Lignecontrat     setObservation()        Sets the current record's "observation" value
 * @method Lignecontrat     setPunitaire()          Sets the current record's "punitaire" value
 * @method Lignecontrat     setQte()                Sets the current record's "qte" value
 * @method Lignecontrat     setIdMag()              Sets the current record's "id_mag" value
 * @method Lignecontrat     setIdProjet()           Sets the current record's "id_projet" value
 * @method Lignecontrat     setIdContrat()          Sets the current record's "id_contrat" value
 * @method Lignecontrat     setNordre()             Sets the current record's "nordre" value
 * @method Lignecontrat     setUnite()              Sets the current record's "unite" value
 * @method Lignecontrat     setTauxfodec()          Sets the current record's "tauxfodec" value
 * @method Lignecontrat     setFodec()              Sets the current record's "fodec" value
 * @method Lignecontrat     setPrixu()              Sets the current record's "prixu" value
 * @method Lignecontrat     setIdUnite()            Sets the current record's "id_unite" value
 * @method Lignecontrat     setIdTauxfodec()        Sets the current record's "id_tauxfodec" value
 * @method Lignecontrat     setIdUnitemarche()      Sets the current record's "id_unitemarche" value
 * @method Lignecontrat     setArticle()            Sets the current record's "Article" value
 * @method Lignecontrat     setMagasin()            Sets the current record's "Magasin" value
 * @method Lignecontrat     setTva()                Sets the current record's "Tva" value
 * @method Lignecontrat     setProjet()             Sets the current record's "Projet" value
 * @method Lignecontrat     setContratachat()       Sets the current record's "Contratachat" value
 * @method Lignecontrat     setTypepiececontrat()   Sets the current record's "Typepiececontrat" value
 * @method Lignecontrat     setTauxfodec()          Sets the current record's "Tauxfodec" value
 * @method Lignecontrat     setUnitemarche()        Sets the current record's "Unitemarche" value
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignecontrat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignecontrat');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignecontrat_id',
             'length' => 4,
             ));
        $this->hasColumn('cout', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_articlestock', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_doc', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('mntht', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('mnttva', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('mntthtva', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('mntttc', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('impudegt', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('codearticle', 'string', 150, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 150,
             ));
        $this->hasColumn('designationartcile', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_tva', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('observation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('punitaire', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('qte', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_mag', 'integer', 4, array(
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
        $this->hasColumn('id_contrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
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
        $this->hasColumn('unite', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('tauxfodec', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('fodec', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('prixu', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_unite', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_tauxfodec', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_unitemarche', 'integer', 4, array(
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
        $this->hasOne('Article', array(
             'local' => 'id_articlestock',
             'foreign' => 'id'));

        $this->hasOne('Magasin', array(
             'local' => 'id_mag',
             'foreign' => 'id'));

        $this->hasOne('Tva', array(
             'local' => 'id_tva',
             'foreign' => 'id'));

        $this->hasOne('Projet', array(
             'local' => 'id_projet',
             'foreign' => 'id'));

        $this->hasOne('Contratachat', array(
             'local' => 'id_contrat',
             'foreign' => 'id'));

        $this->hasOne('Typepiececontrat', array(
             'local' => 'id_unite',
             'foreign' => 'id'));

        $this->hasOne('Tauxfodec', array(
             'local' => 'id_tauxfodec',
             'foreign' => 'id'));

        $this->hasOne('Unitemarche', array(
             'local' => 'id_unitemarche',
             'foreign' => 'id'));
    }
}