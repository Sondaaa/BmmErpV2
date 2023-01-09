<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Echelle', 'doctrine');

/**
 * BaseEchelle
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_categorie
 * @property Categorierh $Categorierh
 * 
 * @method integer     getId()           Returns the current record's "id" value
 * @method string      getLibelle()      Returns the current record's "libelle" value
 * @method integer     getIdCategorie()  Returns the current record's "id_categorie" value
 * @method Categorierh getCategorierh()  Returns the current record's "Categorierh" value
 * @method Echelle     setId()           Sets the current record's "id" value
 * @method Echelle     setLibelle()      Sets the current record's "libelle" value
 * @method Echelle     setIdCategorie()  Sets the current record's "id_categorie" value
 * @method Echelle     setCategorierh()  Sets the current record's "Categorierh" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEchelle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('echelle');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'echelle_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 5, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 5,
             ));
        $this->hasColumn('id_categorie', 'integer', 4, array(
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
        $this->hasOne('Categorierh', array(
             'local' => 'id_categorie',
             'foreign' => 'id'));
    }
}