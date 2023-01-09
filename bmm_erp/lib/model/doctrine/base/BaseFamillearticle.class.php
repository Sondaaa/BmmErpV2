<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Famillearticle', 'doctrine');

/**
 * BaseFamillearticle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $libelle
 * @property Doctrine_Collection $Article
 * @property Doctrine_Collection $Sousfamillearticle
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getCode()               Returns the current record's "code" value
 * @method string              getLibelle()            Returns the current record's "libelle" value
 * @method Doctrine_Collection getArticle()            Returns the current record's "Article" collection
 * @method Doctrine_Collection getSousfamillearticle() Returns the current record's "Sousfamillearticle" collection
 * @method Famillearticle      setId()                 Sets the current record's "id" value
 * @method Famillearticle      setCode()               Sets the current record's "code" value
 * @method Famillearticle      setLibelle()            Sets the current record's "libelle" value
 * @method Famillearticle      setArticle()            Sets the current record's "Article" collection
 * @method Famillearticle      setSousfamillearticle() Sets the current record's "Sousfamillearticle" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFamillearticle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('famillearticle');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'famillearticle_id',
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
        $this->hasColumn('libelle', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Article', array(
             'local' => 'id',
             'foreign' => 'id_famille'));

        $this->hasMany('Sousfamillearticle', array(
             'local' => 'id',
             'foreign' => 'id_famille'));
    }
}