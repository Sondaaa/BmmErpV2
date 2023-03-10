<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Historiquesitautionadministrative', 'doctrine');

/**
 * BaseHistoriquesitautionadministrative
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_contrat
 * @property date $datesysteme
 * @property integer $id_typecontrat
 * @property Contrat $Contrat
 * @property Typecontrat $Typecontrat
 * 
 * @method integer                           getId()             Returns the current record's "id" value
 * @method integer                           getIdContrat()      Returns the current record's "id_contrat" value
 * @method date                              getDatesysteme()    Returns the current record's "datesysteme" value
 * @method integer                           getIdTypecontrat()  Returns the current record's "id_typecontrat" value
 * @method Contrat                           getContrat()        Returns the current record's "Contrat" value
 * @method Typecontrat                       getTypecontrat()    Returns the current record's "Typecontrat" value
 * @method Historiquesitautionadministrative setId()             Sets the current record's "id" value
 * @method Historiquesitautionadministrative setIdContrat()      Sets the current record's "id_contrat" value
 * @method Historiquesitautionadministrative setDatesysteme()    Sets the current record's "datesysteme" value
 * @method Historiquesitautionadministrative setIdTypecontrat()  Sets the current record's "id_typecontrat" value
 * @method Historiquesitautionadministrative setContrat()        Sets the current record's "Contrat" value
 * @method Historiquesitautionadministrative setTypecontrat()    Sets the current record's "Typecontrat" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHistoriquesitautionadministrative extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('historiquesitautionadministrative');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'historiquesitautionadministrative_id',
             'length' => 4,
             ));
        $this->hasColumn('id_contrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('datesysteme', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_typecontrat', 'integer', 4, array(
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
        $this->hasOne('Contrat', array(
             'local' => 'id_contrat',
             'foreign' => 'id'));

        $this->hasOne('Typecontrat', array(
             'local' => 'id_typecontrat',
             'foreign' => 'id'));
    }
}