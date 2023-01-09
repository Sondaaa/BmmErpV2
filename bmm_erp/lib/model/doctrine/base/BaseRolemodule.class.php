<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Rolemodule', 'doctrine');

/**
 * BaseRolemodule
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_module
 * @property integer $id_role
 * @property integer $id_user
 * @property Moduleerp $Moduleerp
 * @property Role $Role
 * @property Utilisateur $Utilisateur
 * 
 * @method integer     getId()          Returns the current record's "id" value
 * @method integer     getIdModule()    Returns the current record's "id_module" value
 * @method integer     getIdRole()      Returns the current record's "id_role" value
 * @method integer     getIdUser()      Returns the current record's "id_user" value
 * @method Moduleerp   getModuleerp()   Returns the current record's "Moduleerp" value
 * @method Role        getRole()        Returns the current record's "Role" value
 * @method Utilisateur getUtilisateur() Returns the current record's "Utilisateur" value
 * @method Rolemodule  setId()          Sets the current record's "id" value
 * @method Rolemodule  setIdModule()    Sets the current record's "id_module" value
 * @method Rolemodule  setIdRole()      Sets the current record's "id_role" value
 * @method Rolemodule  setIdUser()      Sets the current record's "id_user" value
 * @method Rolemodule  setModuleerp()   Sets the current record's "Moduleerp" value
 * @method Rolemodule  setRole()        Sets the current record's "Role" value
 * @method Rolemodule  setUtilisateur() Sets the current record's "Utilisateur" value
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRolemodule extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rolemodule');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_module', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_role', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_user', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Moduleerp', array(
             'local' => 'id_module',
             'foreign' => 'id'));

        $this->hasOne('Role', array(
             'local' => 'id_role',
             'foreign' => 'id'));

        $this->hasOne('Utilisateur', array(
             'local' => 'id_user',
             'foreign' => 'id'));
    }
}