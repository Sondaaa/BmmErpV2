<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Sousfamillearticle', 'doctrine');

/**
 * BaseSousfamillearticle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_famille
 * @property string $code
 * @property Famillearticle $Famillearticle
 * @property Doctrine_Collection $Article
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getLibelle()        Returns the current record's "libelle" value
 * @method integer             getIdFamille()      Returns the current record's "id_famille" value
 * @method string              getCode()           Returns the current record's "code" value
 * @method Famillearticle      getFamillearticle() Returns the current record's "Famillearticle" value
 * @method Doctrine_Collection getArticle()        Returns the current record's "Article" collection
 * @method Sousfamillearticle  setId()             Sets the current record's "id" value
 * @method Sousfamillearticle  setLibelle()        Sets the current record's "libelle" value
 * @method Sousfamillearticle  setIdFamille()      Sets the current record's "id_famille" value
 * @method Sousfamillearticle  setCode()           Sets the current record's "code" value
 * @method Sousfamillearticle  setFamillearticle() Sets the current record's "Famillearticle" value
 * @method Sousfamillearticle  setArticle()        Sets the current record's "Article" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSousfamillearticle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sousfamillearticle');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'sousfamillearticle_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('id_famille', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Famillearticle', array(
             'local' => 'id_famille',
             'foreign' => 'id'));

        $this->hasMany('Article', array(
             'local' => 'id',
             'foreign' => 'id_sousfamille'));
    }
}