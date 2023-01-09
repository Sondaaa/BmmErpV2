<?php

// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Piecejoint', 'doctrine');

/**
 * BasePiecejoint
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $chemin
 * @property string $objet
 * @property string $sujet
 * @property integer $id_typepiece
 * @property integer $id_courrier
 * @property integer $id_parcour
 * @property integer $id_docachat
 * @property integer $id_ordreservice
 * @property integer $id_docbudget
 * @property integer $id_titrebudget
 * @property integer $id_transfert
 * @property integer $id_orderservicecontrat
 * @property integer $id_pvreceptionmarche
 * @property integer $id_parametragesociete
 * @property integer $id_fichederogation
 
 * @property Parametragesociete $Parametragesociete
 * @property integer $id_marche
 * @property Courrier $Courrier
 * @property Parcourcourier $Parcourcourier
 * @property Typepiece $Typepiece
 * @property Dossierfourniseur $Dossierfourniseur
 * @property Documentachat $Documentachat
 * @property Fournisseur $Fournisseur
 * @property Parametragesociete $Parametragesociete
 * @property Pvrception $Pvrception
 * @property Documentachat $Documentachat_9
 * @property Documentbudget $Documentbudget
 * @property Ordredeservicecontratachat $Ordredeservicecontratachat
 * @property Ordredeservice $Ordredeservice
 * @property Titrebudjet $Titrebudjet
 * @property Transfertbudget $Transfertbudget
 * @property Marches $Marches
 * 
 * @method integer            getId()                     Returns the current record's "id" value
 * @method string             getChemin()                 Returns the current record's "chemin" value
 * @method string             getObjet()                  Returns the current record's "objet" value
 * @method string             getSujet()                  Returns the current record's "sujet" value
 * @method integer            getIdTypepiece()            Returns the current record's "id_typepiece" value
 * @method integer            getIdCourrier()             Returns the current record's "id_courrier" value
 * @method integer            getIdParcour()              Returns the current record's "id_parcour" value
 * @method integer            getIdDocachat()             Returns the current record's "id_docachat" value
 * @method integer            getIdOrdreservice()         Returns the current record's "id_ordreservice" value
 * @method integer            getIdDocbudget()            Returns the current record's "id_docbudget" value
 * @method integer            getIdTitrebudget()          Returns the current record's "id_titrebudget" value
 * @method integer            getIdTransfert()            Returns the current record's "id_transfert" value
 * @method integer            getIdOrderservicecontrat()  Returns the current record's "id_orderservicecontrat" value
 * @method integer            getIdPvreceptionmarche()    Returns the current record's "id_pvreceptionmarche" value
 * @method integer            getIdParametragesociete()   Returns the current record's "id_parametragesociete" value
 * @method integer            getIdFichederogation()      Returns the current record's "id_fichederogation" value
  * @method integer            getIdMarche()               Returns the current record's "id_marche" value
 * @method Courrier           getCourrier()               Returns the current record's "Courrier" value
 * @method Parcourcourier     getParcourcourier()         Returns the current record's "Parcourcourier" value
 * @method Typepiece          getTypepiece()              Returns the current record's "Typepiece" value
 * @method Dossierfourniseur  getDossierfourniseur()      Returns the current record's "Dossierfourniseur" value
 * @method Documentachat      getDocumentachat()          Returns the current record's "Documentachat" value
 * @method Fournisseur        getFournisseur()            Returns the current record's "Fournisseur" value
 * @method Parametragesociete getParametragesociete()     Returns the current record's "Parametragesociete" value
 * @method Ordredeservicecontratachat getOrdredeservicecontratachat() Returns the current record's "Ordredeservicecontratachat" value
 * @method Parametragesociete getParametragesociete()     Returns the current record's "Parametragesociete" value
 
 * @method Pvrception         getPvrception()             Returns the current record's "Pvrception" value
 * @method Documentachat      getDocumentachat9()         Returns the current record's "Documentachat_9" value
 * @method Documentbudget     getDocumentbudget()         Returns the current record's "Documentbudget" value
 * @method Ordredeservice     getOrdredeservice()         Returns the current record's "Ordredeservice" value
 * @method Titrebudjet        getTitrebudjet()            Returns the current record's "Titrebudjet" value
 * @method Transfertbudget    getTransfertbudget()        Returns the current record's "Transfertbudget" value
 * @method Marches            getMarches()                Returns the current record's "Marches" value
 * @method Piecejoint         setId()                     Sets the current record's "id" value
 * @method Piecejoint         setChemin()                 Sets the current record's "chemin" value
 * @method Piecejoint         setObjet()                  Sets the current record's "objet" value
 * @method Piecejoint         setSujet()                  Sets the current record's "sujet" value
 * @method Piecejoint         setIdTypepiece()            Sets the current record's "id_typepiece" value
 * @method Piecejoint         setIdCourrier()             Sets the current record's "id_courrier" value
 * @method Piecejoint         setIdParcour()              Sets the current record's "id_parcour" value
 * @method Piecejoint         setIdDocachat()             Sets the current record's "id_docachat" value
 * @method Piecejoint         setIdOrdreservice()         Sets the current record's "id_ordreservice" value
 * @method Piecejoint         setIdDocbudget()            Sets the current record's "id_docbudget" value
 * @method Piecejoint         setIdTitrebudget()          Sets the current record's "id_titrebudget" value
 * @method Piecejoint         setIdTransfert()            Sets the current record's "id_transfert" value
 * @method Piecejoint         setIdOrderservicecontrat()  Sets the current record's "id_orderservicecontrat" value
 * @method Piecejoint         setIdPvreceptionmarche()    Sets the current record's "id_pvreceptionmarche" value
 * @method Piecejoint         setIdParametragesociete()   Sets the current record's "id_parametragesociete" value
 * @method Piecejoint         setIdFichederogation()      Sets the current record's "id_fichederogation" value
  * @method Piecejoint         setIdMarche()               Sets the current record's "id_marche" value
 * @method Piecejoint         setCourrier()               Sets the current record's "Courrier" value
 * @method Piecejoint         setParcourcourier()         Sets the current record's "Parcourcourier" value
 * @method Piecejoint         setTypepiece()              Sets the current record's "Typepiece" value
 * @method Piecejoint         setDossierfourniseur()      Sets the current record's "Dossierfourniseur" value
 * @method Piecejoint         setDocumentachat()          Sets the current record's "Documentachat" value
  
 * @method Piecejoint         setFournisseur()            Sets the current record's "Fournisseur" value
 * @method Piecejoint         setParametragesociete()     Sets the current record's "Parametragesociete" value
 * @method Piecejoint                 setOrdredeservicecontratachat() Sets the current record's "Ordredeservicecontratachat" value
 * @method Piecejoint         setPvrception()             Sets the current record's "Pvrception" value
 * @method Piecejoint         setDocumentachat9()         Sets the current record's "Documentachat_9" value
 * @method Piecejoint         setDocumentbudget()         Sets the current record's "Documentbudget" value
 * @method Piecejoint         setOrdredeservice()         Sets the current record's "Ordredeservice" value
 * @method Piecejoint         setTitrebudjet()            Sets the current record's "Titrebudjet" value
 * @method Piecejoint         setTransfertbudget()        Sets the current record's "Transfertbudget" value
 * @method Piecejoint         setMarches()                Sets the current record's "Marches" value
 * @method Piecejoint         setParametragesociete()     Sets the current record's "Parametragesociete" value
 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePiecejoint extends sfDoctrineRecord {

    public function setTableDefinition() {
        $this->setTableName('piecejoint');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => true,
            'sequence' => 'piecejoint_id',
            'length' => 4,
        ));
        $this->hasColumn('chemin', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('objet', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('sujet', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('id_typepiece', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_courrier', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_parcour', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_docachat', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_ordreservice', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_docbudget', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_titrebudget', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_transfert', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_orderservicecontrat', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_pvreceptionmarche', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_parametragesociete', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_fichederogation', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
       
        $this->hasColumn('id_marche', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
    }

    public function setUp() {
        parent::setUp();
        $this->hasOne('Courrier', array(
            'local' => 'id_courrier',
            'foreign' => 'id'));

        $this->hasOne('Parcourcourier', array(
            'local' => 'id_parcour',
            'foreign' => 'id'));

        $this->hasOne('Typepiece', array(
            'local' => 'id_typepiece',
            'foreign' => 'id'));
        $this->hasOne('Ordredeservicecontratachat', array(
            'local' => 'id_orderservicecontrat',
            'foreign' => 'id'));
       

        $this->hasOne('Documentachat', array(
            'local' => 'id_fichederogation',
            'foreign' => 'id'));

       

        $this->hasOne('Parametragesociete', array(
            'local' => 'id_parametragesociete',
            'foreign' => 'id'));

        $this->hasOne('Pvrception', array(
            'local' => 'id_pvreceptionmarche',
            'foreign' => 'id'));

        $this->hasOne('Documentachat as Documentachat_9', array(
            'local' => 'id_docachat',
            'foreign' => 'id'));

        $this->hasOne('Documentbudget', array(
            'local' => 'id_docbudget',
            'foreign' => 'id'));

        $this->hasOne('Ordredeservice', array(
            'local' => 'id_ordreservice',
            'foreign' => 'id'));

        $this->hasOne('Titrebudjet', array(
            'local' => 'id_titrebudget',
            'foreign' => 'id'));

        $this->hasOne('Transfertbudget', array(
            'local' => 'id_transfert',
            'foreign' => 'id'));

        $this->hasOne('Marches', array(
            'local' => 'id_marche',
            'foreign' => 'id'));
    }

}
