<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Contribitionpatronale', 'doctrine');

/**
 * BaseContribitionpatronale
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $libelle
 * @property decimal $taux
 * 
 * @method integer               getId()      Returns the current record's "id" value
 * @method string                getCode()    Returns the current record's "code" value
 * @method string                getLibelle() Returns the current record's "libelle" value
 * @method decimal               getTaux()    Returns the current record's "taux" value
 * @method Contribitionpatronale setId()      Sets the current record's "id" value
 * @method Contribitionpatronale setCode()    Sets the current record's "code" value
 * @method Contribitionpatronale setLibelle() Sets the current record's "libelle" value
 * @method Contribitionpatronale setTaux()    Sets the current record's "taux" value
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContribitionpatronale extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contribitionpatronale');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'contribitionpatronale_id',
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
       $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('taux', 'decimal', 18, array(
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
        
    }
}