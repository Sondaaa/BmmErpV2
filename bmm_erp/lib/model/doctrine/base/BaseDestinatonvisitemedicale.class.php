<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Destinatonvisitemedicale', 'doctrine');

/**
 * BaseDestinatonvisitemedicale
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property string $nbrjour
 * @property Doctrine_Collection $Visitemedicale
 * 
 * @method integer                  getId()             Returns the current record's "id" value
 * @method string                   getLibelle()        Returns the current record's "libelle" value
 * @method string                   getNbrjour()        Returns the current record's "nbrjour" value
 * @method Doctrine_Collection      getVisitemedicale() Returns the current record's "Visitemedicale" collection
 * @method Destinatonvisitemedicale setId()             Sets the current record's "id" value
 * @method Destinatonvisitemedicale setLibelle()        Sets the current record's "libelle" value
 * @method Destinatonvisitemedicale setNbrjour()        Sets the current record's "nbrjour" value
 * @method Destinatonvisitemedicale setVisitemedicale() Sets the current record's "Visitemedicale" collection
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDestinatonvisitemedicale extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('destinatonvisitemedicale');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'destinatonvisitemedicale_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('nbrjour', 'string', 20, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 20,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Visitemedicale', array(
             'local' => 'id',
             'foreign' => 'id_destination'));
    }
}