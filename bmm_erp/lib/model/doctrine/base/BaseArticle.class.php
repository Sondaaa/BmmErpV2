<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Article', 'doctrine');

/**
 * BaseArticle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $datecreation
 * @property integer $numero
 * @property integer $id_user
 * @property string $codeart
 * @property string $designation
 * @property integer $id_unite
 * @property integer $id_typestock
 * @property integer $id_famille
 * @property string $codefamille
 * @property decimal $stockmin
 * @property decimal $stocksecurite
 * @property decimal $stockalert
 * @property boolean $stocable
 * @property decimal $stockmax
 * @property string $codeabc
 * @property integer $id_modele
 * @property decimal $delai
 * @property bit $blocappro
 * @property string $comptegenerale
 * @property integer $id_methode
 * @property decimal $stockreel
 * @property decimal $stockreelvaleur
 * @property decimal $enlinstance
 * @property decimal $senqteenle
 * @property integer $id_fabriquant
 * @property decimal $aht
 * @property integer $id_tva
 * @property decimal $attc
 * @property decimal $qtetheorique
 * @property integer $id_sousfamille
 * @property string $codesf
 * @property integer $id_nature
 * @property string $codenature
 * @property decimal $pamp
 * @property Utilisateur $Utilisateur
 * @property Unitemarche $Unitemarche
 * @property Typearticle $Typearticle
 * @property Famillearticle $Famillearticle
 * @property Modeleapro $Modeleapro
 * @property Methodevalorisation $Methodevalorisation
 * @property Fabricant $Fabricant
 * @property Tva $Tva
 * @property Sousfamillearticle $Sousfamillearticle
 * @property Tva $Tva_10
 * @property Naturearticle $Naturearticle
 * @property Doctrine_Collection $Stock
 * @property Doctrine_Collection $Lignedocachat
 * @property Doctrine_Collection $Ligneinventaire
 * @property Doctrine_Collection $Lignecararticle
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method date                getDatecreation()        Returns the current record's "datecreation" value
 * @method integer             getNumero()              Returns the current record's "numero" value
 * @method integer             getIdUser()              Returns the current record's "id_user" value
 * @method string              getCodeart()             Returns the current record's "codeart" value
 * @method string              getDesignation()         Returns the current record's "designation" value
 * @method boolean             getStocable()            Returns the current record's "stocable" value
 * @method integer             getIdUnite()             Returns the current record's "id_unite" value
 * @method integer             getIdTypestock()         Returns the current record's "id_typestock" value
 * @method integer             getIdFamille()           Returns the current record's "id_famille" value
 * @method string              getCodefamille()         Returns the current record's "codefamille" value
 * @method decimal             getStockmin()            Returns the current record's "stockmin" value
 * @method decimal             getStocksecurite()       Returns the current record's "stocksecurite" value
 * @method decimal             getStockalert()          Returns the current record's "stockalert" value
 * @method decimal             getStockmax()            Returns the current record's "stockmax" value
 * @method string              getCodeabc()             Returns the current record's "codeabc" value
 * @method integer             getIdModele()            Returns the current record's "id_modele" value
 * @method decimal             getDelai()               Returns the current record's "delai" value
 * @method bit                 getBlocappro()           Returns the current record's "blocappro" value
 * @method string              getComptegenerale()      Returns the current record's "comptegenerale" value
 * @method integer             getIdMethode()           Returns the current record's "id_methode" value
 * @method decimal             getStockreel()           Returns the current record's "stockreel" value
 * @method decimal             getStockreelvaleur()     Returns the current record's "stockreelvaleur" value
 * @method decimal             getEnlinstance()         Returns the current record's "enlinstance" value
 * @method decimal             getSenqteenle()          Returns the current record's "senqteenle" value
 * @method integer             getIdFabriquant()        Returns the current record's "id_fabriquant" value
 * @method decimal             getAht()                 Returns the current record's "aht" value
 * @method integer             getIdTva()               Returns the current record's "id_tva" value
 * @method decimal             getAttc()                Returns the current record's "attc" value
 * @method decimal             getQtetheorique()        Returns the current record's "qtetheorique" value
 * @method integer             getIdSousfamille()       Returns the current record's "id_sousfamille" value
 * @method string              getCodesf()              Returns the current record's "codesf" value
 * @method integer             getIdNature()            Returns the current record's "id_nature" value
 * @method string              getCodenature()          Returns the current record's "codenature" value
 * @method decimal             getPamp()                Returns the current record's "pamp" value
 * @method Utilisateur         getUtilisateur()         Returns the current record's "Utilisateur" value
 * @method Unitemarche         getUnitemarche()         Returns the current record's "Unitemarche" value
 * @method Typearticle         getTypearticle()         Returns the current record's "Typearticle" value
 * @method Famillearticle      getFamillearticle()      Returns the current record's "Famillearticle" value
 * @method Modeleapro          getModeleapro()          Returns the current record's "Modeleapro" value
 * @method Methodevalorisation getMethodevalorisation() Returns the current record's "Methodevalorisation" value
 * @method Fabricant           getFabricant()           Returns the current record's "Fabricant" value
 * @method Tva                 getTva()                 Returns the current record's "Tva" value
 * @method Sousfamillearticle  getSousfamillearticle()  Returns the current record's "Sousfamillearticle" value
 * @method Tva                 getTva10()               Returns the current record's "Tva_10" value
 * @method Naturearticle       getNaturearticle()       Returns the current record's "Naturearticle" value
 * @method Doctrine_Collection getStock()               Returns the current record's "Stock" collection
 * @method Doctrine_Collection getLignedocachat()       Returns the current record's "Lignedocachat" collection
 * @method Doctrine_Collection getLigneinventaire()     Returns the current record's "Ligneinventaire" collection
 * @method Doctrine_Collection getLignecararticle()     Returns the current record's "Lignecararticle" collection

 * @method Article             setDatecreation()        Sets the current record's "datecreation" value
 * @method Article             setNumero()              Sets the current record's "numero" value
 * @method Article             setIdUser()              Sets the current record's "id_user" value
 * @method Article             setCodeart()             Sets the current record's "codeart" value
 * @method Article             setDesignation()         Sets the current record's "designation" value
 * @method Article             setIdUnite()             Sets the current record's "id_unite" value
 * @method Article             setIdTypestock()         Sets the current record's "id_typestock" value
 * @method Article             setIdFamille()           Sets the current record's "id_famille" value
 * @method Article             setCodefamille()         Sets the current record's "codefamille" value
 * @method Article             setStockmin()            Sets the current record's "stockmin" value
 * @method Article             setStocksecurite()       Sets the current record's "stocksecurite" value
 * @method Article             setStockalert()          Sets the current record's "stockalert" value
 * @method Article             setStockmax()            Sets the current record's "stockmax" value
 * @method Article             setCodeabc()             Sets the current record's "codeabc" value
 * @method Article             setIdModele()            Sets the current record's "id_modele" value
 * @method Article             setDelai()               Sets the current record's "delai" value
 * @method Article             setBlocappro()           Sets the current record's "blocappro" value
 * @method Article             setId()                  Sets the current record's "id" value
 * @method Article             setComptegenerale()      Sets the current record's "comptegenerale" value
 * @method Article             setIdMethode()           Sets the current record's "id_methode" value
 * @method Article             setStockreel()           Sets the current record's "stockreel" value
 * @method Article             setStockreelvaleur()     Sets the current record's "stockreelvaleur" value
 * @method Article             setEnlinstance()         Sets the current record's "enlinstance" value
 * @method Article             setSenqteenle()          Sets the current record's "senqteenle" value
 * @method Article             setIdFabriquant()        Sets the current record's "id_fabriquant" value
 * @method Article             setAht()                 Sets the current record's "aht" value
 * @method Article             setIdTva()               Sets the current record's "id_tva" value
 * @method Article             setAttc()                Sets the current record's "attc" value
 * @method Article             setQtetheorique()        Sets the current record's "qtetheorique" value
 * @method Article             setIdSousfamille()       Sets the current record's "id_sousfamille" value
 * @method Article             setCodesf()              Sets the current record's "codesf" value
 * @method Article             setIdNature()            Sets the current record's "id_nature" value
 * @method Article             setCodenature()          Sets the current record's "codenature" value
 * @method Article             setPamp()                Sets the current record's "pamp" value
 * @method Article             setUtilisateur()         Sets the current record's "Utilisateur" value
 * @method Article             setUnitemarche()         Sets the current record's "Unitemarche" value
 * @method Article             setTypearticle()         Sets the current record's "Typearticle" value
 * @method Article             setFamillearticle()      Sets the current record's "Famillearticle" value
 * @method Article             setModeleapro()          Sets the current record's "Modeleapro" value
 * @method Article             setMethodevalorisation() Sets the current record's "Methodevalorisation" value
 * @method Article             setFabricant()           Sets the current record's "Fabricant" value
 * @method Article             setTva()                 Sets the current record's "Tva" value
 * @method Article             setSousfamillearticle()  Sets the current record's "Sousfamillearticle" value
 * @method Article             setTva10()               Sets the current record's "Tva_10" value
 * @method Article             setNaturearticle()       Sets the current record's "Naturearticle" value
 * @method Article             setStock()               Sets the current record's "Stock" collection
 * @method Article             setLignedocachat()       Sets the current record's "Lignedocachat" collection
 * @method Article             setLigneinventaire()     Sets the current record's "Ligneinventaire" collection
 * @method Article             setLignecararticle()     Sets the current record's "Lignecararticle" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArticle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('article');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'article_id',
             'length' => 4,
             ));
        $this->hasColumn('datecreation', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_user', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('codeart', 'string', 100, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('designation', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
        $this->hasColumn('id_unite', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_typestock', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_famille', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('codefamille', 'string', 100, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('stockmin', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('stocksecurite', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('stockalert', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('stockmax', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('codeabc', 'string', 18, array(
             'type' => 'string',
             'fixed' => 18,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_modele', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('delai', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('blocappro', 'bit', 1, array(
             'type' => 'bit',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('comptegenerale', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('id_methode', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('stockreel', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('stockreelvaleur', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('enlinstance', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('senqteenle', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_fabriquant', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('aht', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_tva', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('attc', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('qtetheorique', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_sousfamille', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('codesf', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 10,
             ));
        $this->hasColumn('id_nature', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('codenature', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 10,
             ));
        $this->hasColumn('pamp', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
			 $this->hasColumn('stocable', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Utilisateur', array(
             'local' => 'id_user',
             'foreign' => 'id'));

        $this->hasOne('Unitemarche', array(
             'local' => 'id_unite',
             'foreign' => 'id'));

        $this->hasOne('Typearticle', array(
             'local' => 'id_typestock',
             'foreign' => 'id'));

        $this->hasOne('Famillearticle', array(
             'local' => 'id_famille',
             'foreign' => 'id'));

        $this->hasOne('Modeleapro', array(
             'local' => 'id_modele',
             'foreign' => 'id'));

        $this->hasOne('Methodevalorisation', array(
             'local' => 'id_methode',
             'foreign' => 'id'));

        $this->hasOne('Fabricant', array(
             'local' => 'id_fabriquant',
             'foreign' => 'id'));

        $this->hasOne('Tva', array(
             'local' => 'id_tva',
             'foreign' => 'id'));

        $this->hasOne('Sousfamillearticle', array(
             'local' => 'id_sousfamille',
             'foreign' => 'id'));

        $this->hasOne('Tva as Tva_10', array(
             'local' => 'id_tva',
             'foreign' => 'id'));

        $this->hasOne('Naturearticle', array(
             'local' => 'id_nature',
             'foreign' => 'id'));

        $this->hasMany('Stock', array(
             'local' => 'id',
             'foreign' => 'id_article'));

        $this->hasMany('Lignedocachat', array(
             'local' => 'id',
             'foreign' => 'id_articlestock'));

        $this->hasMany('Ligneinventaire', array(
             'local' => 'id',
             'foreign' => 'id_article'));

        $this->hasMany('Lignecararticle', array(
             'local' => 'id',
             'foreign' => 'id_article'));
    }
}