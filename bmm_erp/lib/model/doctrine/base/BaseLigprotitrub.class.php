<?php

// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ligprotitrub', 'doctrine');

/**
 * BaseLigprotitrub
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_titre
 * @property integer $id_rubrique
 * @property decimal $mnt
 * @property decimal $mntengage
 * @property decimal $mntdeponser
 * @property decimal $relicaengager
 * @property decimal $relicadeponser
 * @property integer $orderbudget
 * @property decimal $mntprovisoire
 * @property string $code
 * @property decimal $mntencaisse
 * @property decimal $mntredresement
 * @property integer $modifseul
 * @property string $nordre
 * @property decimal $mntretire
 * @property decimal $mntexterne
 * @property Rubrique $Rubrique
 * @property Titrebudjet $Titrebudjet
 * @property Doctrine_Collection $Documentbudget
 * @property Doctrine_Collection $Financement
 * @property Doctrine_Collection $Transfertbudget
 * @property Doctrine_Collection $Transfertbudget_2
 * @property Doctrine_Collection $Ligneoperationcaisse
 * @property Doctrine_Collection $Lignebanquecaisse
 * @property Doctrine_Collection $Lignedocachat
 * @property Doctrine_Collection $Annexebudgetrubrique
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method integer             getIdTitre()              Returns the current record's "id_titre" value
 * @method integer             getIdRubrique()           Returns the current record's "id_rubrique" value
 * @method decimal             getMnt()                  Returns the current record's "mnt" value
 * @method decimal             getMntengage()            Returns the current record's "mntengage" value
 * @method decimal             getMntdeponser()          Returns the current record's "mntdeponser" value
 * @method decimal             getRelicaengager()        Returns the current record's "relicaengager" value
 * @method string              getCode()                 Returns the current record's "code" value
 * @method decimal             getRelicadeponser()       Returns the current record's "relicadeponser" value
 * @method integer             getOrderbudget()          Returns the current record's "orderbudget" value
 * @method decimal             getMntprovisoire()        Returns the current record's "mntprovisoire" value
 * @method decimal             getMntencaisse()          Returns the current record's "mntencaisse" value
 * @method decimal             getMntredresement()       Returns the current record's "mntredresement" value
 * @method integer             getModifseul()            Returns the current record's "modifseul" value
 * @method string              getNordre()               Returns the current record's "nordre" value
 * @method decimal             getMntexterne()           Returns the current record's "mntexterne" value
 * @method decimal             getMntretire()            Returns the current record's "mntretire" value
 * @method Rubrique            getRubrique()             Returns the current record's "Rubrique" value
 * @method Titrebudjet         getTitrebudjet()          Returns the current record's "Titrebudjet" value
 * @method Doctrine_Collection getAnnexebudgetrubrique() Returns the current record's "Annexebudgetrubrique" collection
 * @method Doctrine_Collection getDocumentbudget()       Returns the current record's "Documentbudget" collection
 * @method Doctrine_Collection getFinancement()          Returns the current record's "Financement" collection
 * @method Doctrine_Collection getTransfertbudget()      Returns the current record's "Transfertbudget" collection
 * @method Doctrine_Collection getTransfertbudget2()     Returns the current record's "Transfertbudget_2" collection
 * @method Doctrine_Collection getLigneoperationcaisse() Returns the current record's "Ligneoperationcaisse" collection
 * @method Doctrine_Collection getLignebanquecaisse()    Returns the current record's "Lignebanquecaisse" collection
 * @method Doctrine_Collection getLignedocachat()        Returns the current record's "Lignedocachat" collection
 * @method Ligprotitrub        setId()                   Sets the current record's "id" value
 * @method Ligprotitrub        setIdTitre()              Sets the current record's "id_titre" value
 * @method Ligprotitrub        setIdRubrique()           Sets the current record's "id_rubrique" value
 * @method Ligprotitrub        setMnt()                  Sets the current record's "mnt" value
 * @method Ligprotitrub        setMntengage()            Sets the current record's "mntengage" value
 * @method Ligprotitrub        setMntdeponser()          Sets the current record's "mntdeponser" value
 * @method Ligprotitrub        setRelicaengager()        Sets the current record's "relicaengager" value
 * @method Ligprotitrub        setRelicadeponser()       Sets the current record's "relicadeponser" value
 * @method Ligprotitrub        setOrderbudget()          Sets the current record's "orderbudget" value
 * @method Ligprotitrub        setMntprovisoire()        Sets the current record's "mntprovisoire" value
 * @method Ligprotitrub        setMntencaisse()          Sets the current record's "mntencaisse" value
 * @method Ligprotitrub        setMntredresement()       Sets the current record's "mntredresement" value
 * @method Ligprotitrub        setModifseul()            Sets the current record's "modifseul" value
 * @method Ligprotitrub        setNordre()               Sets the current record's "nordre" value
 * @method Titrebudjet         setMntexterne()           Sets the current record's "mntexterne" value
 * @method Ligprotitrub        setRubrique()             Sets the current record's "Rubrique" value
 * @method Ligprotitrub        setTitrebudjet()          Sets the current record's "Titrebudjet" value
 * @method Ligprotitrub        setDocumentbudget()       Sets the current record's "Documentbudget" collection
 * @method Ligprotitrub        setFinancement()          Sets the current record's "Financement" collection
 * @method Ligprotitrub        setCode()                 Sets the current record's "code" value
 
 * @method Ligprotitrub        setMntretire()            Sets the current record's "mntretire" value
 * @method Ligprotitrub        setAnnexebudgetrubrique() Sets the current record's "Annexebudgetrubrique" collection
 * @method Ligprotitrub        setTransfertbudget()      Sets the current record's "Transfertbudget" collection
 * @method Ligprotitrub        setTransfertbudget2()     Sets the current record's "Transfertbudget_2" collection
 * @method Ligprotitrub        setLigneoperationcaisse() Sets the current record's "Ligneoperationcaisse" collection
 * @method Ligprotitrub        setLignebanquecaisse()    Sets the current record's "Lignebanquecaisse" collection
 * @method Ligprotitrub        setLignedocachat()        Sets the current record's "Lignedocachat" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLigprotitrub extends sfDoctrineRecord {

    public function setTableDefinition() {
        $this->setTableName('ligprotitrub');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => true,
            'sequence' => 'ligprotitrub_id',
            'length' => 4,
        ));
        $this->hasColumn('id_titre', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_rubrique', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('mnt', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('mntengage', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('mntdeponser', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('code', 'string', 20, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 20,
        ));
        $this->hasColumn('relicaengager', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('relicadeponser', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('orderbudget', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('mntprovisoire', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('mntencaisse', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('mntredresement', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
        $this->hasColumn('modifseul', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('nordre', 'string', 5, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 5,
        ));
        $this->hasColumn('mntexterne', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
		  $this->hasColumn('mntretire', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
    }

    public function setUp() {
        parent::setUp();
        $this->hasOne('Rubrique', array(
            'local' => 'id_rubrique',
            'foreign' => 'id'));

        $this->hasOne('Titrebudjet', array(
            'local' => 'id_titre',
            'foreign' => 'id'));

        $this->hasMany('Documentbudget', array(
            'local' => 'id',
            'foreign' => 'id_budget'));

        $this->hasMany('Financement', array(
            'local' => 'id',
            'foreign' => 'id_lignebudget'));

        $this->hasMany('Transfertbudget', array(
            'local' => 'id',
            'foreign' => 'id_destination'));

        $this->hasMany('Transfertbudget as Transfertbudget_2', array(
            'local' => 'id',
            'foreign' => 'id_source'));

        $this->hasMany('Ligneoperationcaisse', array(
            'local' => 'id',
            'foreign' => 'id_budget'));

        $this->hasMany('Lignebanquecaisse', array(
            'local' => 'id',
            'foreign' => 'id_budget'));
        
        $this->hasMany('Annexebudgetrubrique', array(
             'local' => 'id',
             'foreign' => 'id_ligprotitrub'));

        $this->hasMany('Lignedocachat', array(
            'local' => 'id',
            'foreign' => 'codebudget'));
    }

}