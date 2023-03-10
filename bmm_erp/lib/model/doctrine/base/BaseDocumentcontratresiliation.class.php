<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Documentcontratresiliation', 'doctrine');

/**
 * BaseDocumentcontratresiliation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property date $dateresiliation
 * @property integer $id_user
 * @property string $motifresiliattion
 * @property boolean $valide_budget
 * @property integer $id_docachat
 * @property integer $id_doccontrat
 * @property decimal $montantconsomme
 * @property decimal $montantrestant
 * @property Utilisateur $Utilisateur
 * @property Documentachat $Documentachat
 * @property Contratachat $Contratachat
 * 
 * @method integer                    getId()                Returns the current record's "id" value
 * @method date                       getDateresiliation()   Returns the current record's "dateresiliation" value
 * @method integer                    getIdUser()            Returns the current record's "id_user" value
 * @method string                     getMotifresiliattion() Returns the current record's "motifresiliattion" value
 * @method boolean                    getValideBudget()      Returns the current record's "valide_budget" value
 * @method integer                    getIdDocachat()        Returns the current record's "id_docachat" value
 * @method integer                    getIdDoccontrat()      Returns the current record's "id_doccontrat" value
 * @method decimal                    getMontantconsomme()   Returns the current record's "montantconsomme" value
 * @method decimal                    getMontantrestant()    Returns the current record's "montantrestant" value
 * @method Utilisateur                getUtilisateur()       Returns the current record's "Utilisateur" value
 * @method Documentachat              getDocumentachat()     Returns the current record's "Documentachat" value
 * @method Contratachat               getContratachat()      Returns the current record's "Contratachat" value
 * @method Documentcontratresiliation setId()                Sets the current record's "id" value
 * @method Documentcontratresiliation setDateresiliation()   Sets the current record's "dateresiliation" value
 * @method Documentcontratresiliation setIdUser()            Sets the current record's "id_user" value
 * @method Documentcontratresiliation setMotifresiliattion() Sets the current record's "motifresiliattion" value
 * @method Documentcontratresiliation setValideBudget()      Sets the current record's "valide_budget" value
 * @method Documentcontratresiliation setIdDocachat()        Sets the current record's "id_docachat" value
 * @method Documentcontratresiliation setIdDoccontrat()      Sets the current record's "id_doccontrat" value
 * @method Documentcontratresiliation setMontantconsomme()   Sets the current record's "montantconsomme" value
 * @method Documentcontratresiliation setMontantrestant()    Sets the current record's "montantrestant" value
 * @method Documentcontratresiliation setUtilisateur()       Sets the current record's "Utilisateur" value
 * @method Documentcontratresiliation setDocumentachat()     Sets the current record's "Documentachat" value
 * @method Documentcontratresiliation setContratachat()      Sets the current record's "Contratachat" value
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocumentcontratresiliation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('documentcontratresiliation');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
			 'sequence' => 'documentcontratresiliation_id',
             'length' => 4,
             ));
        $this->hasColumn('dateresiliation', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_user', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('motifresiliattion', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('valide_budget', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_docachat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_doccontrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantconsomme', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantrestant', 'decimal', 18, array(
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
        $this->hasOne('Utilisateur', array(
             'local' => 'id_user',
             'foreign' => 'id'));

        $this->hasOne('Documentachat', array(
             'local' => 'id_docachat',
             'foreign' => 'id'));

        $this->hasOne('Contratachat', array(
             'local' => 'id_doccontrat',
             'foreign' => 'id'));
    }
}