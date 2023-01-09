<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Familletiers', 'doctrine');

/**
 * BaseFamilletiers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Lignefrsfamillesousfamille
 * @property Doctrine_Collection $Sousfamilletiers
 * 
 * @method integer             getId()                         Returns the current record's "id" value
 * @method string              getLibelle()                    Returns the current record's "libelle" value
 * @method Doctrine_Collection getLignefrsfamillesousfamille() Returns the current record's "Lignefrsfamillesousfamille" collection
 * @method Doctrine_Collection getSousfamilletiers()           Returns the current record's "Sousfamilletiers" collection
 * @method Familletiers        setId()                         Sets the current record's "id" value
 * @method Familletiers        setLibelle()                    Sets the current record's "libelle" value
 * @method Familletiers        setLignefrsfamillesousfamille() Sets the current record's "Lignefrsfamillesousfamille" collection
 * @method Familletiers        setSousfamilletiers()           Sets the current record's "Sousfamilletiers" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFamilletiers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('familletiers');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
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
        $this->hasMany('Lignefrsfamillesousfamille', array(
             'local' => 'id',
             'foreign' => 'id_famille'));

        $this->hasMany('Sousfamilletiers', array(
             'local' => 'id',
             'foreign' => 'id_famille'));
    }
}