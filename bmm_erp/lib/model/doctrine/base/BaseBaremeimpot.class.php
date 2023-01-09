<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Baremeimpot', 'doctrine');

/**
 * BaseBaremeimpot
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property decimal $montantdebut
 * @property decimal $montantfin
 * @property integer $pourcentage
 * @property string $libelle
 * 
 * @method integer     getId()           Returns the current record's "id" value
 * @method decimal     getMontantdebut() Returns the current record's "montantdebut" value
 * @method decimal     getMontantfin()   Returns the current record's "montantfin" value
 * @method integer     getPourcentage()  Returns the current record's "pourcentage" value
 * @method string      getLibelle()      Returns the current record's "libelle" value
 * @method Baremeimpot setId()           Sets the current record's "id" value
 * @method Baremeimpot setMontantdebut() Sets the current record's "montantdebut" value
 * @method Baremeimpot setMontantfin()   Sets the current record's "montantfin" value
 * @method Baremeimpot setPourcentage()  Sets the current record's "pourcentage" value
 * @method Baremeimpot setLibelle()      Sets the current record's "libelle" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBaremeimpot extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('baremeimpot');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'baremeimpot_id',
             'length' => 4,
             ));
        $this->hasColumn('montantdebut', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantfin', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('pourcentage', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}