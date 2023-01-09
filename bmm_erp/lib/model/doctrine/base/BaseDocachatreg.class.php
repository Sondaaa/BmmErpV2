<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Docachatreg', 'doctrine');

/**
 * BaseDocachatreg
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_docreg
 * @property integer $id_demandeur
 * @property integer $id_bci
 * @property integer $id_useracheteur
 * @property Demandeur $Demandeur
 * @property Documentachat $Documentachat
 * @property Documentachat $Documentachat_3
 * @property Utilisateur $Utilisateur
 * 
 * @method integer       getId()              Returns the current record's "id" value
 * @method integer       getIdDocreg()        Returns the current record's "id_docreg" value
 * @method integer       getIdDemandeur()     Returns the current record's "id_demandeur" value
 * @method integer       getIdBci()           Returns the current record's "id_bci" value
 * @method integer       getIdUseracheteur()  Returns the current record's "id_useracheteur" value
 * @method Demandeur     getDemandeur()       Returns the current record's "Demandeur" value
 * @method Documentachat getDocumentachat()   Returns the current record's "Documentachat" value
 * @method Documentachat getDocumentachat3()  Returns the current record's "Documentachat_3" value
 * @method Utilisateur   getUtilisateur()     Returns the current record's "Utilisateur" value
 * @method Docachatreg   setId()              Sets the current record's "id" value
 * @method Docachatreg   setIdDocreg()        Sets the current record's "id_docreg" value
 * @method Docachatreg   setIdDemandeur()     Sets the current record's "id_demandeur" value
 * @method Docachatreg   setIdBci()           Sets the current record's "id_bci" value
 * @method Docachatreg   setIdUseracheteur()  Sets the current record's "id_useracheteur" value
 * @method Docachatreg   setDemandeur()       Sets the current record's "Demandeur" value
 * @method Docachatreg   setDocumentachat()   Sets the current record's "Documentachat" value
 * @method Docachatreg   setDocumentachat3()  Sets the current record's "Documentachat_3" value
 * @method Docachatreg   setUtilisateur()     Sets the current record's "Utilisateur" value
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocachatreg extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('docachatreg');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'docachatreg_id',
             'length' => 4,
             ));
        $this->hasColumn('id_docreg', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_demandeur', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_bci', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_useracheteur', 'integer', 4, array(
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
        $this->hasOne('Demandeur', array(
             'local' => 'id_demandeur',
             'foreign' => 'id'));

        $this->hasOne('Documentachat', array(
             'local' => 'id_bci',
             'foreign' => 'id'));

        $this->hasOne('Documentachat as Documentachat_3', array(
             'local' => 'id_docreg',
             'foreign' => 'id'));

        $this->hasOne('Utilisateur', array(
             'local' => 'id_useracheteur',
             'foreign' => 'id'));
    }
}