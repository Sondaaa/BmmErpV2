<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Recapdeponse', 'doctrine');

/**
 * BaseRecapdeponse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_rubrique
 * @property string $lib_rubrique
 * @property integer $id_titre
 * @property integer $mois
 * @property date $datecreation
 * @property decimal $mnt_caisse
 * @property decimal $mnt_banque
 * @property decimal $mnt_ant
 * @property integer $id_ligprotitre
 * @property Rubrique $Rubrique
 * @property Titrebudjet $Titrebudjet
 * @property Ligprotitrub $Ligprotitrub
 * 
 * @method integer      getId()             Returns the current record's "id" value
 * @method integer      getIdRubrique()     Returns the current record's "id_rubrique" value
 * @method string       getLibRubrique()    Returns the current record's "lib_rubrique" value
 * @method integer      getIdTitre()        Returns the current record's "id_titre" value
 * @method integer      getMois()           Returns the current record's "mois" value
 * @method date         getDatecreation()   Returns the current record's "datecreation" value
 * @method decimal      getMntCaisse()      Returns the current record's "mnt_caisse" value
 * @method decimal      getMntBanque()      Returns the current record's "mnt_banque" value
 * @method decimal      getMntAnt()         Returns the current record's "mnt_ant" value
 * @method integer      getIdLigprotitre()  Returns the current record's "id_ligprotitre" value
 * @method Rubrique     getRubrique()       Returns the current record's "Rubrique" value
 * @method Titrebudjet  getTitrebudjet()    Returns the current record's "Titrebudjet" value
 * @method Ligprotitrub getLigprotitrub()   Returns the current record's "Ligprotitrub" value
 * @method Recapdeponse setId()             Sets the current record's "id" value
 * @method Recapdeponse setIdRubrique()     Sets the current record's "id_rubrique" value
 * @method Recapdeponse setLibRubrique()    Sets the current record's "lib_rubrique" value
 * @method Recapdeponse setIdTitre()        Sets the current record's "id_titre" value
 * @method Recapdeponse setMois()           Sets the current record's "mois" value
 * @method Recapdeponse setDatecreation()   Sets the current record's "datecreation" value
 * @method Recapdeponse setMntCaisse()      Sets the current record's "mnt_caisse" value
 * @method Recapdeponse setMntBanque()      Sets the current record's "mnt_banque" value
 * @method Recapdeponse setMntAnt()         Sets the current record's "mnt_ant" value
 * @method Recapdeponse setIdLigprotitre()  Sets the current record's "id_ligprotitre" value
 * @method Recapdeponse setRubrique()       Sets the current record's "Rubrique" value
 * @method Recapdeponse setTitrebudjet()    Sets the current record's "Titrebudjet" value
 * @method Recapdeponse setLigprotitrub()   Sets the current record's "Ligprotitrub" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRecapdeponse extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('recapdeponse');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'recapdeponse_id',
             'length' => 4,
             ));
        $this->hasColumn('id_rubrique', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('lib_rubrique', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_titre', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('mois', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
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
        $this->hasColumn('mnt_caisse', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('mnt_banque', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('mnt_ant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_ligprotitre', 'integer', 4, array(
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
        $this->hasOne('Rubrique', array(
             'local' => 'id_rubrique',
             'foreign' => 'id'));

        $this->hasOne('Titrebudjet', array(
             'local' => 'id_titre',
             'foreign' => 'id'));

        $this->hasOne('Ligprotitrub', array(
             'local' => 'id_ligprotitre',
             'foreign' => 'id'));
    }
}