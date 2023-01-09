<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Discipline', 'doctrine');

/**
 * BaseDiscipline
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property integer $id_typediscipline
 * @property string $source
 * @property date $date
 * @property string $explication
 * @property integer $id_naturediscipline
 * @property integer $nbrejour
 * @property Agents $Agents
 * @property Naturediscipline $Naturediscipline
 * @property Typediscipline $Typediscipline
 * 
 * @method integer          getId()                  Returns the current record's "id" value
 * @method integer          getIdAgents()            Returns the current record's "id_agents" value
 * @method integer          getIdTypediscipline()    Returns the current record's "id_typediscipline" value
 * @method string           getSource()              Returns the current record's "source" value
 * @method date             getDate()                Returns the current record's "date" value
 * @method string           getExplication()         Returns the current record's "explication" value
 * @method integer          getIdNaturediscipline()  Returns the current record's "id_naturediscipline" value
 * @method integer          getNbrejour()            Returns the current record's "nbrejour" value
 * @method Agents           getAgents()              Returns the current record's "Agents" value
 * @method Naturediscipline getNaturediscipline()    Returns the current record's "Naturediscipline" value
 * @method Typediscipline   getTypediscipline()      Returns the current record's "Typediscipline" value
 * @method Discipline       setId()                  Sets the current record's "id" value
 * @method Discipline       setIdAgents()            Sets the current record's "id_agents" value
 * @method Discipline       setIdTypediscipline()    Sets the current record's "id_typediscipline" value
 * @method Discipline       setSource()              Sets the current record's "source" value
 * @method Discipline       setDate()                Sets the current record's "date" value
 * @method Discipline       setExplication()         Sets the current record's "explication" value
 * @method Discipline       setIdNaturediscipline()  Sets the current record's "id_naturediscipline" value
 * @method Discipline       setNbrejour()            Sets the current record's "nbrejour" value
 * @method Discipline       setAgents()              Sets the current record's "Agents" value
 * @method Discipline       setNaturediscipline()    Sets the current record's "Naturediscipline" value
 * @method Discipline       setTypediscipline()      Sets the current record's "Typediscipline" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDiscipline extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('discipline');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'discipline_id',
             'length' => 4,
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_typediscipline', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('source', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('explication', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('id_naturediscipline', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrejour', 'integer', 4, array(
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
        $this->hasOne('Agents', array(
             'local' => 'id_agents',
             'foreign' => 'id'));

        $this->hasOne('Naturediscipline', array(
             'local' => 'id_naturediscipline',
             'foreign' => 'id'));

        $this->hasOne('Typediscipline', array(
             'local' => 'id_typediscipline',
             'foreign' => 'id'));
    }
}