<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Piecemonnaie', 'doctrine');

/**
 * BasePiecemonnaie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property decimal $valeur
 * @property Doctrine_Collection $Caiseepiecemonnaie
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getLibelle()            Returns the current record's "libelle" value
 * @method decimal             getValeur()             Returns the current record's "valeur" value
 * @method Doctrine_Collection getCaiseepiecemonnaie() Returns the current record's "Caiseepiecemonnaie" collection
 * @method Piecemonnaie        setId()                 Sets the current record's "id" value
 * @method Piecemonnaie        setLibelle()            Sets the current record's "libelle" value
 * @method Piecemonnaie        setValeur()             Sets the current record's "valeur" value
 * @method Piecemonnaie        setCaiseepiecemonnaie() Sets the current record's "Caiseepiecemonnaie" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePiecemonnaie extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('piecemonnaie');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'piecemonnaie_id',
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
        $this->hasColumn('valeur', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => 'NULL::numeric',
             'primary' => false,
             'length' => 18,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Caiseepiecemonnaie', array(
             'local' => 'id',
             'foreign' => 'id_piece'));
    }
}