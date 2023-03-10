<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignemouvemententetestock', 'doctrine');

/**
 * BaseLignemouvemententetestock
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                        $id                                                Type: integer(4), primary key
 * @property int                        $id_mouvement                                      Type: integer(4)
 * @property string                     $libelle                                           Type: string
 * @property int                        $id_article                                        Type: integer(4)
 * @property float                      $qte_entere                                        Type: decimal(18)
 * @property float                      $qte_sortie                                        Type: decimal(18)
 * @property float                      $stock_final                                       Type: decimal(18)
 * @property float                      $puachat                                           Type: decimal(18)
 * @property float                      $cump                                              Type: decimal(18)
 * @property float                      $stock_valeur                                      Type: decimal(18)
 * @property string                      $created_at                                       Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @property Mouvemententetestock       $Mouvemententetestock                              
 * @property Article                    $Article                                           
 *  
 * @method int                          getId()                                            Type: integer(4), primary key
 * @method int                          getIdMouvement()                                   Type: integer(4)
 * @method string                       getLibelle()                                       Type: string
 * @method int                          getIdArticle()                                     Type: integer(4)
 * @method float                        getQteEntere()                                     Type: decimal(18)
 * @method float                        getQteSortie()                                     Type: decimal(18)
 * @method float                        getStockFinal()                                    Type: decimal(18)
 * @method float                        getPuachat()                                       Type: decimal(18)
 * @method float                        getCump()                                          Type: decimal(18)
 * @method float                        getStockValeur()                                   Type: decimal(18)
 * @method Mouvemententetestock         getMouvemententetestock()                          
 * @method Article                      getArticle()    
 * @method Date                      getCreatedAt()                                       Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 *  
 * @method Lignemouvemententetestock    setId(int $val)                                    Type: integer(4), primary key
 * @method Lignemouvemententetestock    setIdMouvement(int $val)                           Type: integer(4)
 * @method Lignemouvemententetestock    setLibelle(string $val)                            Type: string
 * @method Lignemouvemententetestock    setIdArticle(int $val)                             Type: integer(4)
 * @method Lignemouvemententetestock    setQteEntere(float $val)                           Type: decimal(18)
 * @method Lignemouvemententetestock    setQteSortie(float $val)                           Type: decimal(18)
 * @method Lignemouvemententetestock    setStockFinal(float $val)                          Type: decimal(18)
 * @method Lignemouvemententetestock    setPuachat(float $val)                             Type: decimal(18)
 * @method Lignemouvemententetestock    setCump(float $val)                                Type: decimal(18)
* @method Lignemouvemententetestock    setCreatedAt(date $val)                              Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @method Lignemouvemententetestock    setStockValeur(float $val)                         Type: decimal(18)
 * @method Lignemouvemententetestock    setMouvemententetestock(Mouvemententetestock $val) 
 * @method Lignemouvemententetestock    setArticle(Article $val)                           
 *  
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignemouvemententetestock extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignemouvemententetestock');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignemouvemententetestock_id',
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
        $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_article', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('qte_entere', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('qte_sortie', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('stock_final', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('puachat', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('cump', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
             $this->hasColumn('created_at', 'date', 25, array(
               'type' => 'date',
               'fixed' => 0,
               'unsigned' => false,
               'notnull' => false,
               'primary' => false,
               'length' => 25,
               ));
        $this->hasColumn('stock_valeur', 'decimal', 18, array(
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
        $this->hasOne('Mouvemententetestock', array(
             'local' => 'id_mouvement',
             'foreign' => 'id'));

        $this->hasOne('Article', array(
             'local' => 'id_article',
             'foreign' => 'id'));
    }
}