<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Sousfamille', 'doctrine');

/**
 * BaseSousfamille
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $sousfamille
 * @property integer $id_famille
 * @property string $description
 * @property Famille $Famille
 * @property Doctrine_Collection $Immobilisation
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getSousfamille()    Returns the current record's "sousfamille" value
 * @method integer             getIdFamille()      Returns the current record's "id_famille" value
 * @method string              getDescription()    Returns the current record's "description" value
 * @method Famille             getFamille()        Returns the current record's "Famille" value
 * @method Doctrine_Collection getImmobilisation() Returns the current record's "Immobilisation" collection
 * @method Sousfamille         setId()             Sets the current record's "id" value
 * @method Sousfamille         setSousfamille()    Sets the current record's "sousfamille" value
 * @method Sousfamille         setIdFamille()      Sets the current record's "id_famille" value
 * @method Sousfamille         setDescription()    Sets the current record's "description" value
 * @method Sousfamille         setFamille()        Sets the current record's "Famille" value
 * @method Sousfamille         setImmobilisation() Sets the current record's "Immobilisation" collection
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSousfamille extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sousfamille');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('sousfamille', 'string', 500, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 500,
             ));
        $this->hasColumn('id_famille', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', 2147483647, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 2147483647,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Famille', array(
             'local' => 'id_famille',
             'foreign' => 'id'));

        $this->hasMany('Immobilisation', array(
             'local' => 'id',
             'foreign' => 'id_sousfamille'));
    }
}