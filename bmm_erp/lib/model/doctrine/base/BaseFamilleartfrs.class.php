<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Familleartfrs', 'doctrine');

/**
 * BaseFamilleartfrs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Fournisseur
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getLibelle()     Returns the current record's "libelle" value
 * @method Doctrine_Collection getFournisseur() Returns the current record's "Fournisseur" collection
 * @method Familleartfrs       setId()          Sets the current record's "id" value
 * @method Familleartfrs       setLibelle()     Sets the current record's "libelle" value
 * @method Familleartfrs       setFournisseur() Sets the current record's "Fournisseur" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFamilleartfrs extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('familleartfrs');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'familleartfrs_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 250, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 250,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Fournisseur', array(
             'local' => 'id',
             'foreign' => 'id_famillearticle'));
    }
}