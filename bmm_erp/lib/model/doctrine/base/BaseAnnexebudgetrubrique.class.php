<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Annexebudgetrubrique', 'doctrine');

/**
 * BaseAnnexebudgetrubrique
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $datecreation
 * @property string $description
 * @property string $contenu
 * @property decimal $total
 * @property integer $id_annexebudget
 * @property integer $id_ligprotitrub
 * @property Annexebudget $Annexebudget
 * @property Ligprotitrub $Ligprotitrub
 * 
 * @method integer              getId()              Returns the current record's "id" value
 * @method date                 getDatecreation()    Returns the current record's "datecreation" value
 * @method string               getDescription()     Returns the current record's "description" value
 * @method string               getContenu()         Returns the current record's "contenu" value
 * @method decimal              getTotal()           Returns the current record's "total" value
 * @method integer              getIdAnnexebudget()  Returns the current record's "id_annexebudget" value
 * @method integer              getIdLigprotitrub()  Returns the current record's "id_ligprotitrub" value
 * @method Annexebudget         getAnnexebudget()    Returns the current record's "Annexebudget" value
 * @method Ligprotitrub         getLigprotitrub()    Returns the current record's "Ligprotitrub" value
 * @method Annexebudgetrubrique setId()              Sets the current record's "id" value
 * @method Annexebudgetrubrique setDatecreation()    Sets the current record's "datecreation" value
 * @method Annexebudgetrubrique setDescription()     Sets the current record's "description" value
 * @method Annexebudgetrubrique setContenu()         Sets the current record's "contenu" value
 * @method Annexebudgetrubrique setTotal()           Sets the current record's "total" value
 * @method Annexebudgetrubrique setIdAnnexebudget()  Sets the current record's "id_annexebudget" value
 * @method Annexebudgetrubrique setIdLigprotitrub()  Sets the current record's "id_ligprotitrub" value
 * @method Annexebudgetrubrique setAnnexebudget()    Sets the current record's "Annexebudget" value
 * @method Annexebudgetrubrique setLigprotitrub()    Sets the current record's "Ligprotitrub" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAnnexebudgetrubrique extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('annexebudgetrubrique');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'annexebudgetrubrique_id',
             'length' => 4,
             ));
        $this->hasColumn('datecreation', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('contenu', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('total', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '0',
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_annexebudget', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_ligprotitrub', 'integer', 4, array(
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
        $this->hasOne('Annexebudget', array(
             'local' => 'id_annexebudget',
             'foreign' => 'id'));

        $this->hasOne('Ligprotitrub', array(
             'local' => 'id_ligprotitrub',
             'foreign' => 'id'));
    }
}