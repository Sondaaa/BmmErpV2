<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Stock', 'doctrine');

/**
 * BaseStock
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_article
 * @property integer $id_mag
 * @property date $datedentre
 * @property decimal $qtereel
 * @property decimal $qtetheorique
 * @property decimal $valeurreel
 * @property decimal $stockmax
 * @property decimal $stockmin
 * @property decimal $stocksecurite
 * @property decimal $stockalert
 * @property integer $id_store
 * @property decimal $puht
 * @property Article $Article
 * @property Magasin $Magasin
 * @property Storemag $Storemag
 * 
 * @method integer  getId()            Returns the current record's "id" value
 * @method integer  getIdArticle()     Returns the current record's "id_article" value
 * @method integer  getIdMag()         Returns the current record's "id_mag" value
 * @method date     getDatedentre()    Returns the current record's "datedentre" value
 * @method decimal  getQtereel()       Returns the current record's "qtereel" value
 * @method decimal  getQtetheorique()  Returns the current record's "qtetheorique" value
 * @method decimal  getValeurreel()    Returns the current record's "valeurreel" value
 * @method decimal  getStockmax()      Returns the current record's "stockmax" value
 * @method decimal  getStockmin()      Returns the current record's "stockmin" value
 * @method decimal  getStocksecurite() Returns the current record's "stocksecurite" value
 * @method decimal  getStockalert()    Returns the current record's "stockalert" value
 * @method integer  getIdStore()       Returns the current record's "id_store" value
 * @method decimal  getPuht()          Returns the current record's "puht" value
 * @method Article  getArticle()       Returns the current record's "Article" value
 * @method Magasin  getMagasin()       Returns the current record's "Magasin" value
 * @method Storemag getStoremag()      Returns the current record's "Storemag" value
 * @method Stock    setId()            Sets the current record's "id" value
 * @method Stock    setIdArticle()     Sets the current record's "id_article" value
 * @method Stock    setIdMag()         Sets the current record's "id_mag" value
 * @method Stock    setDatedentre()    Sets the current record's "datedentre" value
 * @method Stock    setQtereel()       Sets the current record's "qtereel" value
 * @method Stock    setQtetheorique()  Sets the current record's "qtetheorique" value
 * @method Stock    setValeurreel()    Sets the current record's "valeurreel" value
 * @method Stock    setStockmax()      Sets the current record's "stockmax" value
 * @method Stock    setStockmin()      Sets the current record's "stockmin" value
 * @method Stock    setStocksecurite() Sets the current record's "stocksecurite" value
 * @method Stock    setStockalert()    Sets the current record's "stockalert" value
 * @method Stock    setIdStore()       Sets the current record's "id_store" value
 * @method Stock    setPuht()          Sets the current record's "puht" value
 * @method Stock    setArticle()       Sets the current record's "Article" value
 * @method Stock    setMagasin()       Sets the current record's "Magasin" value
 * @method Stock    setStoremag()      Sets the current record's "Storemag" value
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStock extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('stock');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'stock_id',
             'length' => 4,
             ));
        $this->hasColumn('id_article', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_mag', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('datedentre', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('qtereel', 'decimal', 18, array(
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
        $this->hasColumn('valeurreel', 'decimal', 18, array(
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
        $this->hasColumn('id_store', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('puht', 'decimal', 18, array(
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
        $this->hasOne('Article', array(
             'local' => 'id_article',
             'foreign' => 'id'));

        $this->hasOne('Magasin', array(
             'local' => 'id_mag',
             'foreign' => 'id'));

        $this->hasOne('Storemag', array(
             'local' => 'id_store',
             'foreign' => 'id'));
    }
}