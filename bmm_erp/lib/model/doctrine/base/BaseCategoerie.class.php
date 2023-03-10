<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Categoerie', 'doctrine');

/**
 * BaseCategoerie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $categorie
 * @property string $codecategoeie
 * @property Doctrine_Collection $Famille
 * @property Doctrine_Collection $Immobilisation
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getCategorie()      Returns the current record's "categorie" value
 * @method string              getCodecategoeie()  Returns the current record's "codecategoeie" value
 * @method Doctrine_Collection getFamille()        Returns the current record's "Famille" collection
 * @method Doctrine_Collection getImmobilisation() Returns the current record's "Immobilisation" collection
 * @method Categoerie          setId()             Sets the current record's "id" value
 * @method Categoerie          setCategorie()      Sets the current record's "categorie" value
 * @method Categoerie          setCodecategoeie()  Sets the current record's "codecategoeie" value
 * @method Categoerie          setFamille()        Sets the current record's "Famille" collection
 * @method Categoerie          setImmobilisation() Sets the current record's "Immobilisation" collection
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCategoerie extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('categoerie');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('categorie', 'string', 500, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 500,
             ));
        $this->hasColumn('codecategoeie', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Famille', array(
             'local' => 'id',
             'foreign' => 'id_categorie'));

        $this->hasMany('Immobilisation', array(
             'local' => 'id',
             'foreign' => 'id_categorie'));
    }
}