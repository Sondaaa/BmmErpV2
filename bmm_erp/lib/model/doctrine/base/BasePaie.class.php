<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Paie', 'doctrine');

/**
 * BasePaie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property integer $id_codesociale
 * @property integer $id_contribution
 * @property integer $id_bareme
 * @property integer $id_historiqueretenue
 * @property integer $mois
 * @property integer $annee
 * @property decimal $assurance
 * @property boolean $irpp
 * @property boolean $cnss
 * @property decimal $salairebrut
 * @property decimal $netsociale
 * @property decimal $abattement
 * @property decimal $abattementfraaisprof
 * @property decimal $abattementenfant
 * @property decimal $abatementcheffamille
 * @property decimal $salaireimposable
 * @property decimal $imposablemensuel
 * @property decimal $retenueimposable
 * @property integer $id_lignecodesociale
 * @property decimal $salairenet
 * @property decimal $totalacompte
 * @property decimal $totalretenue
 * @property decimal $netapayyer
 * @property boolean $tfp
 * @property boolean $foprolos
 * @property integer $id_dossier
 * @property integer $id_annepaie
 * @property decimal $salairedebase
 * @property decimal $contribitionsociale
 * @property integer $id_contrat
 * @property integer $nbrjtravaille
 * @property integer $nbrjconge
 * @property integer $nbabscenceir
 * @property integer $nbrjf
 * @property integer $id_presence
 * @property decimal $montantsociale
 * @property decimal $salairebrutannuel
 * @property decimal $montantirpp
 * @property decimal $montantsocialemensuel
 * @property decimal $salaireteorique
 * @property string $noterendement
 * @property string $notepresence
 * @property decimal $sbrutderniermois
 * @property decimal $basecalculprime
 * @property decimal $brutprime
 * @property Agents $Agents
 * @property Exercice $Exercice
 * @property Baremeimpot $Baremeimpot
 * @property Codesociale $Codesociale
 * @property Contrat $Contrat
 * @property Contribitionpatronale $Contribitionpatronale
 * @property Dossiercomptable $Dossiercomptable
 * @property Historiqueretenue $Historiqueretenue
 * @property Presence $Presence
 * @property Lignecodesociale $Lignecodesociale
 * 
 * @method integer               getId()                    Returns the current record's "id" value
 * @method integer               getIdAgents()              Returns the current record's "id_agents" value
 * @method integer               getIdCodesociale()         Returns the current record's "id_codesociale" value
 * @method integer               getIdContribution()        Returns the current record's "id_contribution" value
 * @method integer               getIdBareme()              Returns the current record's "id_bareme" value
 * @method integer               getIdHistoriqueretenue()   Returns the current record's "id_historiqueretenue" value
 * @method integer               getMois()                  Returns the current record's "mois" value
 * @method integer               getAnnee()                 Returns the current record's "annee" value
 * @method decimal               getAssurance()             Returns the current record's "assurance" value
 * @method boolean               getIrpp()                  Returns the current record's "irpp" value
 * @method boolean               getCnss()                  Returns the current record's "cnss" value
 * @method decimal               getSalairebrut()           Returns the current record's "salairebrut" value
 * @method integer               getIdLignecodesociale()    Returns the current record's "id_lignecodesociale" value
 * @method decimal               getNetsociale()            Returns the current record's "netsociale" value
 * @method decimal               getAbattement()            Returns the current record's "abattement" value
 * @method decimal               getAbattementfraaisprof()  Returns the current record's "abattementfraaisprof" value
 * @method decimal               getAbattementenfant()      Returns the current record's "abattementenfant" value
 * @method decimal               getAbatementcheffamille()  Returns the current record's "abatementcheffamille" value
 * @method decimal               getSalaireimposable()      Returns the current record's "salaireimposable" value
 * @method decimal               getImposablemensuel()      Returns the current record's "imposablemensuel" value
 * @method decimal               getRetenueimposable()      Returns the current record's "retenueimposable" value
 * @method decimal               getSalairenet()            Returns the current record's "salairenet" value
 * @method decimal               getTotalacompte()          Returns the current record's "totalacompte" value
 * @method decimal               getTotalretenue()          Returns the current record's "totalretenue" value
 * @method decimal               getNetapayyer()            Returns the current record's "netapayyer" value
 * @method boolean               getTfp()                   Returns the current record's "tfp" value
 * @method boolean               getFoprolos()              Returns the current record's "foprolos" value
 * @method Lignecodesociale      getLignecodesociale()      Returns the current record's "Lignecodesociale" value
 * @method integer               getIdDossier()             Returns the current record's "id_dossier" value
 * @method integer               getIdAnnepaie()            Returns the current record's "id_annepaie" value
 * @method decimal               getSalairedebase()         Returns the current record's "salairedebase" value
 * @method decimal               getContribitionsociale()   Returns the current record's "contribitionsociale" value
 * @method integer               getIdContrat()             Returns the current record's "id_contrat" value
 * @method integer               getNbrjtravaille()         Returns the current record's "nbrjtravaille" value
 * @method integer               getNbrjconge()             Returns the current record's "nbrjconge" value
 * @method integer               getNbabscenceir()          Returns the current record's "nbabscenceir" value
 * @method integer               getNbrjf()                 Returns the current record's "nbrjf" value
 * @method integer               getIdPresence()            Returns the current record's "id_presence" value
 * @method decimal               getMontantsociale()        Returns the current record's "montantsociale" value
 * @method decimal               getSalairebrutannuel()     Returns the current record's "salairebrutannuel" value
 * @method decimal               getMontantirpp()           Returns the current record's "montantirpp" value
 * @method decimal               getMontantsocialemensuel() Returns the current record's "montantsocialemensuel" value
 * @method decimal               getSalaireteorique()       Returns the current record's "salaireteorique" value
 * @method string                getNoterendement()         Returns the current record's "noterendement" value
 * @method string                getNotepresence()          Returns the current record's "notepresence" value
 * @method decimal               getSbrutderniermois()      Returns the current record's "sbrutderniermois" value
 * @method decimal               getBasecalculprime()       Returns the current record's "basecalculprime" value
 * @method decimal               getBrutprime()             Returns the current record's "brutprime" value
 * @method Agents                getAgents()                Returns the current record's "Agents" value
 * @method Exercice              getExercice()              Returns the current record's "Exercice" value
 * @method Baremeimpot           getBaremeimpot()           Returns the current record's "Baremeimpot" value
 * @method Codesociale           getCodesociale()           Returns the current record's "Codesociale" value
 * @method Contrat               getContrat()               Returns the current record's "Contrat" value
 * @method Contribitionpatronale getContribitionpatronale() Returns the current record's "Contribitionpatronale" value
 * @method Dossiercomptable      getDossiercomptable()      Returns the current record's "Dossiercomptable" value
 * @method Historiqueretenue     getHistoriqueretenue()     Returns the current record's "Historiqueretenue" value
 * @method Presence              getPresence()              Returns the current record's "Presence" value
 * @method Paie                  setId()                    Sets the current record's "id" value
 * @method Paie                  setIdAgents()              Sets the current record's "id_agents" value
 * @method Paie                  setIdCodesociale()         Sets the current record's "id_codesociale" value
 * @method Paie                  setIdContribution()        Sets the current record's "id_contribution" value
 * @method Paie                  setIdBareme()              Sets the current record's "id_bareme" value
 * @method Paie                  setIdHistoriqueretenue()   Sets the current record's "id_historiqueretenue" value
 * @method Paie                  setMois()                  Sets the current record's "mois" value
 * @method Paie                  setAnnee()                 Sets the current record's "annee" value
 * @method Paie                  setAssurance()             Sets the current record's "assurance" value
 * @method Paie                  setIrpp()                  Sets the current record's "irpp" value
 * @method Paie                  setCnss()                  Sets the current record's "cnss" value
 * @method Paie                  setSalairebrut()           Sets the current record's "salairebrut" value
 * @method Paie                  setNetsociale()            Sets the current record's "netsociale" value
 * @method Paie                  setAbattement()            Sets the current record's "abattement" value
 * @method Paie                  setAbattementfraaisprof()  Sets the current record's "abattementfraaisprof" value
 * @method Paie                  setAbattementenfant()      Sets the current record's "abattementenfant" value
 * @method Paie                  setAbatementcheffamille()  Sets the current record's "abatementcheffamille" value
 * @method Paie                  setSalaireimposable()      Sets the current record's "salaireimposable" value
 * @method Paie                  setImposablemensuel()      Sets the current record's "imposablemensuel" value
 * @method Paie                  setRetenueimposable()      Sets the current record's "retenueimposable" value
 * @method Paie                  setSalairenet()            Sets the current record's "salairenet" value
 * @method Paie                  setTotalacompte()          Sets the current record's "totalacompte" value
 * @method Paie                  setTotalretenue()          Sets the current record's "totalretenue" value
 * @method Paie                  setNetapayyer()            Sets the current record's "netapayyer" value
 * @method Paie                  setTfp()                   Sets the current record's "tfp" value
 * @method Paie                  setFoprolos()              Sets the current record's "foprolos" value
 * @method Paie                  setIdDossier()             Sets the current record's "id_dossier" value
 * @method Paie                  setIdAnnepaie()            Sets the current record's "id_annepaie" value
 * @method Paie                  setSalairedebase()         Sets the current record's "salairedebase" value
 * @method Paie                  setContribitionsociale()   Sets the current record's "contribitionsociale" value
 * @method Paie                  setIdContrat()             Sets the current record's "id_contrat" value
 * @method Paie                  setNbrjtravaille()         Sets the current record's "nbrjtravaille" value
 * @method Paie                  setNbrjconge()             Sets the current record's "nbrjconge" value
 * @method Paie                  setNbabscenceir()          Sets the current record's "nbabscenceir" value
 * @method Paie                  setNbrjf()                 Sets the current record's "nbrjf" value
 * @method Paie                  setIdPresence()            Sets the current record's "id_presence" value
 * @method Paie                  setMontantsociale()        Sets the current record's "montantsociale" value
 * @method Paie                  setSalairebrutannuel()     Sets the current record's "salairebrutannuel" value
 * @method Paie                  setIdLignecodesociale()    Sets the current record's "id_lignecodesociale" value
 * @method Paie                  setMontantirpp()           Sets the current record's "montantirpp" value
 * @method Paie                  setMontantsocialemensuel() Sets the current record's "montantsocialemensuel" value
 * @method Paie                  setSalaireteorique()       Sets the current record's "salaireteorique" value
 * @method Paie                  setNoterendement()         Sets the current record's "noterendement" value
 * @method Paie                  setNotepresence()          Sets the current record's "notepresence" value
 * @method Paie                  setSbrutderniermois()      Sets the current record's "sbrutderniermois" value
 * @method Paie                  setBasecalculprime()       Sets the current record's "basecalculprime" value
 * @method Paie                  setBrutprime()             Sets the current record's "brutprime" value
 * @method Paie                  setAgents()                Sets the current record's "Agents" value
 * @method Paie                  setLignecodesociale()    Sets the current record's "Lignecodesociale" value
 * @method Paie                  setExercice()              Sets the current record's "Exercice" value
 * @method Paie                  setBaremeimpot()           Sets the current record's "Baremeimpot" value
 * @method Paie                  setCodesociale()           Sets the current record's "Codesociale" value
 * @method Paie                  setContrat()               Sets the current record's "Contrat" value
 * @method Paie                  setContribitionpatronale() Sets the current record's "Contribitionpatronale" value
 * @method Paie                  setDossiercomptable()      Sets the current record's "Dossiercomptable" value
 * @method Paie                  setHistoriqueretenue()     Sets the current record's "Historiqueretenue" value
 * @method Paie                  setPresence()              Sets the current record's "Presence" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePaie extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('paie');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'paie_id',
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
        $this->hasColumn('id_codesociale', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_contribution', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_bareme', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_historiqueretenue', 'integer', 4, array(
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
        $this->hasColumn('annee', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('assurance', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('irpp', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('cnss', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('salairebrut', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('netsociale', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('abattement', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('abattementfraaisprof', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('abattementenfant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('abatementcheffamille', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('salaireimposable', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('imposablemensuel', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('retenueimposable', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('salairenet', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('totalacompte', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('totalretenue', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('netapayyer', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('tfp', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('foprolos', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_dossier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_annepaie', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('salairedebase', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('contribitionsociale', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_contrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrjtravaille', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrjconge', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbabscenceir', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nbrjf', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_presence', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantsociale', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('salairebrutannuel', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantirpp', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantsocialemensuel', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('salaireteorique', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('noterendement', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('notepresence', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('sbrutderniermois', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('basecalculprime', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('brutprime', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
			 $this->hasColumn('id_lignecodesociale', 'integer', 4, array(
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

        $this->hasOne('Exercice', array(
             'local' => 'id_annepaie',
             'foreign' => 'id'));

        $this->hasOne('Baremeimpot', array(
             'local' => 'id_bareme',
             'foreign' => 'id'));

        $this->hasOne('Codesociale', array(
             'local' => 'id_codesociale',
             'foreign' => 'id'));

        $this->hasOne('Contrat', array(
             'local' => 'id_contrat',
             'foreign' => 'id'));

        $this->hasOne('Contribitionpatronale', array(
             'local' => 'id_contribution',
             'foreign' => 'id'));

        $this->hasOne('Dossiercomptable', array(
             'local' => 'id_dossier',
             'foreign' => 'id'));

        $this->hasOne('Historiqueretenue', array(
             'local' => 'id_historiqueretenue',
             'foreign' => 'id'));

        $this->hasOne('Presence', array(
             'local' => 'id_presence',
             'foreign' => 'id'));
		$this->hasOne('Lignecodesociale', array(
             'local' => 'id_lignecodesociale',
             'foreign' => 'id'));
    }
}