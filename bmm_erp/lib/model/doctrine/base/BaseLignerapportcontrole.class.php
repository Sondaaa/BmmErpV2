<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignerapportcontrole', 'doctrine');

/**
 * BaseLignerapportcontrole
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $numero
 * @property string $designation
 * @property string $unite
 * @property string $quantite
 * @property decimal $prixunitaire
 * @property decimal $prixtotal
 * @property string $observation
 * @property integer $id_rapportcontrole
 * @property Rapportcontrole $Rapportcontrole
 * 
 * @method integer              getId()                 Returns the current record's "id" value
 * @method integer              getNumero()             Returns the current record's "numero" value
 * @method string               getDesignation()        Returns the current record's "designation" value
 * @method string               getUnite()              Returns the current record's "unite" value
 * @method string              getQuantite()           Returns the current record's "quantite" value
 * @method decimal              getPrixunitaire()       Returns the current record's "prixunitaire" value
 * @method decimal              getPrixtotal()          Returns the current record's "prixtotal" value
 * @method string               getObservation()        Returns the current record's "observation" value
 * @method integer              getIdRapportcontrole()  Returns the current record's "id_rapportcontrole" value
 * @method Rapportcontrole      getRapportcontrole()    Returns the current record's "Rapportcontrole" value
 * @method Lignerapportcontrole setId()                 Sets the current record's "id" value
 * @method Lignerapportcontrole setNumero()             Sets the current record's "numero" value
 * @method Lignerapportcontrole setDesignation()        Sets the current record's "designation" value
 * @method Lignerapportcontrole setUnite()              Sets the current record's "unite" value
 * @method Lignerapportcontrole setQuantite()           Sets the current record's "quantite" value
 * @method Lignerapportcontrole setPrixunitaire()       Sets the current record's "prixunitaire" value
 * @method Lignerapportcontrole setPrixtotal()          Sets the current record's "prixtotal" value
 * @method Lignerapportcontrole setObservation()        Sets the current record's "observation" value
 * @method Lignerapportcontrole setIdRapportcontrole()  Sets the current record's "id_rapportcontrole" value
 * @method Lignerapportcontrole setRapportcontrole()    Sets the current record's "Rapportcontrole" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignerapportcontrole extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignerapportcontrole');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignerapportcontrole_id',
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('designation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('unite', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('quantite', 'string', null, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('prixunitaire', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('prixtotal', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('observation', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_rapportcontrole', 'integer', 4, array(
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
        $this->hasOne('Rapportcontrole', array(
             'local' => 'id_rapportcontrole',
             'foreign' => 'id'));
    }
}