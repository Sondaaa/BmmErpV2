<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typefamille', 'doctrine');

/**
 * BaseTypefamille
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $code
 * @property string $libelle
 * @property Doctrine_Collection $Famille
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method integer             getCode()    Returns the current record's "code" value
 * @method string              getLibelle() Returns the current record's "libelle" value
 * @method Doctrine_Collection getFamille() Returns the current record's "Famille" collection
 * @method Typefamille         setId()      Sets the current record's "id" value
 * @method Typefamille         setCode()    Sets the current record's "code" value
 * @method Typefamille         setLibelle() Sets the current record's "libelle" value
 * @method Typefamille         setFamille() Sets the current record's "Famille" collection
 * 
 * @package    InventaireTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypefamille extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typefamille');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('code', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 254, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 254,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Famille', array(
             'local' => 'id',
             'foreign' => 'id_typefamille'));
    }
}