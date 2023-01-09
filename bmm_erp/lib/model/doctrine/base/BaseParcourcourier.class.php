<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Parcourcourier', 'doctrine');

/**
 * BaseParcourcourier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $datecreation
 * @property date $mdreponse
 * @property integer $id_exp
 * @property integer $id_rec
 * @property integer $id_action
 * @property string $description
 * @property integer $id_courier
 * @property integer $id_famexpdes
 * @property integer $id_user
 * @property integer $id_courrierdest
 * @property integer $ordredetransfer
 * @property Actionparcour $Actionparcour
 * @property Courrier $Courrier
 * @property Expdest $Expdest
 * @property Expdest $Expdest_4
 * @property Utilisateur $Utilisateur
 * @property Courrier $Courrier_6
 * @property Typecourrier $Typecourrier
 * @property Doctrine_Collection $Piecejoint
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method date                getDatecreation()    Returns the current record's "datecreation" value
 * @method date                getMdreponse()       Returns the current record's "mdreponse" value
 * @method integer             getIdExp()           Returns the current record's "id_exp" value
 * @method integer             getIdRec()           Returns the current record's "id_rec" value
 * @method integer             getIdAction()        Returns the current record's "id_action" value
 * @method string              getDescription()     Returns the current record's "description" value
 * @method integer             getIdCourier()       Returns the current record's "id_courier" value
 * @method integer             getIdUser()          Returns the current record's "id_user" value
 * @method integer             getIdCourrierdest()  Returns the current record's "id_courrierdest" value
 * @method integer             getIdFamexpdes()     Returns the current record's "id_famexpdes" value
 * @method integer             getOrdredetransfer() Returns the current record's "ordredetransfer" value
 * @method integer             getIdTypecourrier()  Returns the current record's "id_typecourrier" value
 * @method Actionparcour       getActionparcour()   Returns the current record's "Actionparcour" value
 * @method Courrier            getCourrier()        Returns the current record's "Courrier" value
 * @method Expdest             getExpdest()         Returns the current record's "Expdest" value
 * @method Expdest             getExpdest4()        Returns the current record's "Expdest_4" value
 * @method Utilisateur         getUtilisateur()     Returns the current record's "Utilisateur" value
 * @method Typecourrier        getTypecourrier()    Returns the current record's "Typecourrier" value
 * @method Courrier            getCourrier6()       Returns the current record's "Courrier_6" value
 * @method Doctrine_Collection getPiecejoint()      Returns the current record's "Piecejoint" collection
 * @method Parcourcourier      setId()              Sets the current record's "id" value
 * @method Parcourcourier      setDatecreation()    Sets the current record's "datecreation" value
 * @method Parcourcourier      setMdreponse()       Sets the current record's "mdreponse" value
 * @method Parcourcourier      setIdExp()           Sets the current record's "id_exp" value
 * @method Parcourcourier      setIdRec()           Sets the current record's "id_rec" value
 * @method Parcourcourier      setIdAction()        Sets the current record's "id_action" value
 * @method Parcourcourier      setDescription()     Sets the current record's "description" value
 * @method Parcourcourier      setIdCourier()       Sets the current record's "id_courier" value
 * @method Parcourcourier      setIdUser()          Sets the current record's "id_user" value
 * @method Parcourcourier      setIdTypecourrier()  Sets the current record's "id_typecourrier" value
 * @method Parcourcourier      setIdCourrierdest()  Sets the current record's "id_courrierdest" value
  * @method Parcourcourier      setIdFamexpdes()     Sets the current record's "id_famexpdes" value
 * @method Parcourcourier      setOrdredetransfer() Sets the current record's "ordredetransfer" value
 * @method Parcourcourier      setActionparcour()   Sets the current record's "Actionparcour" value
 * @method Parcourcourier      setCourrier()        Sets the current record's "Courrier" value
 * @method Parcourcourier      setExpdest()         Sets the current record's "Expdest" value
 * @method Parcourcourier      setExpdest4()        Sets the current record's "Expdest_4" value
 * @method Parcourcourier      setUtilisateur()     Sets the current record's "Utilisateur" value
 * @method Parcourcourier      setCourrier6()       Sets the current record's "Courrier_6" value
 * @method Parcourcourier      setTypecourrier()    Sets the current record's "Typecourrier" value
 * @method Parcourcourier      setPiecejoint()      Sets the current record's "Piecejoint" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseParcourcourier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('parcourcourier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'parcourcourier_id',
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
        $this->hasColumn('mdreponse', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_exp', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_rec', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_action', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_courier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_user', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_courrierdest', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('ordredetransfer', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
         $this->hasColumn('id_typecourrier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
			   $this->hasColumn('id_famexpdes', 'integer', 4, array(
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
        $this->hasOne('Actionparcour', array(
             'local' => 'id_action',
             'foreign' => 'id'));

        $this->hasOne('Courrier', array(
             'local' => 'id_courier',
             'foreign' => 'id'));

        $this->hasOne('Expdest', array(
             'local' => 'id_exp',
             'foreign' => 'id'));

        $this->hasOne('Expdest as Expdest_4', array(
             'local' => 'id_rec',
             'foreign' => 'id'));

        $this->hasOne('Utilisateur', array(
             'local' => 'id_user',
             'foreign' => 'id'));

        $this->hasOne('Courrier as Courrier_6', array(
             'local' => 'id_courrierdest',
             'foreign' => 'id'));
	    $this->hasOne('Famexpdes', array(
             'local' => 'id_famexpdes',
             'foreign' => 'id'));

        $this->hasMany('Piecejoint', array(
             'local' => 'id',
             'foreign' => 'id_parcour'));
        $this->hasOne('Typecourrier', array(
             'local' => 'id_typecourrier',
             'foreign' => 'id'));
    }
}