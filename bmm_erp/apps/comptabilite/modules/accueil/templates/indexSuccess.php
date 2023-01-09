<?php
//$user = $_SESSION['user'];
$user = $sf_user->getAttribute('userB2m');

if (!isset($_SESSION['exercice'])):
    $_SESSION['exercice'] = null;
endif;
?>
<?php if ($_SESSION['exercice'] == null): ?>
    <div id="sf_admin_container">
        <h1 id="replacediv"> Accueil 
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i> 
                Choix du dosssier Comptable
            </small>
        </h1>
    </div>

    <div class="row" style="margin-top: 50px;" >
        <div class="col-sm-5 col-xs-push-3">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dossier & exercice comptable courant</h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <form>
                            <!-- <legend>Form</legend> -->
                            <fieldset>
                                <label>Dossier comptable</label>
                                <select class="chosen-select form-control" id="dossier_courant" data-placeholder="Déterminez le dossier courant" onchange="getExerciceByDossier()">
                                    <option value=""></option>
                                    <?php foreach ($dossiers as $dossier): ?>
                                        <option value="<?php echo $dossier->getId() ?>"><?php echo trim($dossier->getCode()) . ' - ' . trim($dossier->getRaisonsociale()); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>

                            <fieldset>
                                <label>Exercice comptable</label>
                                <select class="chosen-select form-control" id="exercice_courant" data-placeholder="Déterminez l'exercice courant">

                                </select>
                            </fieldset>

                            <div class="form-actions center">
                                <button type="button" class="btn btn-sm btn-success" onclick="validerDossierCourant()">
                                    Valider
                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script  type="text/javascript">

        function validerDossierCourant() {
            if ($('#exercice_courant').val() != '' && $("#dossier_courant").val() != '') {
                $('#exercice_courant').css('border', '');
                $('#dossier_courant').css('border', '');
                $.ajax({
                    url: '<?php echo url_for('@validerDossierCourant') ?>',
                    data: 'exercice_id=' + $('#exercice_courant').val() +
                            '&dossier_id=' + $('#dossier_courant').val(),
                    success: function (data) {
                        document.location.reload();
                    }
                });
            } else {
                if ($('#exercice_courant').val() == '') {
                    $('#exercice_courant_chosen').css('border', '3px solid #e65454');
                    $('#exercice_courant_chosen').css('border-radius', '6px');
                }

            }
        }

        function getExerciceByDossier() {
            if ($('#dossier_courant').val() != '') {
                $.ajax({
                    url: '<?php echo url_for('accueil/getExerciceByDossier'); ?>',
                    data: 'dossier_id=' + $('#dossier_courant').val(),
                    success: function (data) {
                        $("#exercice_courant").html(data);
                        $("#exercice_courant").trigger("liszt:updated");
                        $("#exercice_courant").trigger("chosen:updated");
                    }
                });
            }
        }

    </script>
<?php else: ?>
    <div id="sf_admin_container">
        <h1 id="replacediv"> Accueil 
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i> 
                Exercice <?php echo $_SESSION['exercice']; ?>
            </small>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-8">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <i class="ace-icon fa fa-folder-open-o bigger-120"></i>
                            <h4 class="widget-title">DOSSIER COMPTABLE : <?php echo $dossier->getRaisonsociale() ?> - <?php echo $_SESSION['exercice']; ?></h4>
                        </div>

                        <div class="widget-body" style="font-size: 14px;" >
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="grey-background">
                                            <ul>
                                                <li class="line25"><b>

                                                        Société :</b> <?php echo $dossier->getRaisonsociale() ?></li>
                                                <li class="line25"><b>Matricule Fiscale :</b> <?php echo $dossier->getMatriculeFiscale(); ?></li>
                                                <li class="line25"><b>Registre de Commerce :</b> <?php echo $dossier->getRegistreCommerce(); ?></li>
                                                <li class="line25"><b>Forme Juridique :</b> <?php echo $dossier->getFormejuridique()->getLibelle(); ?></li>
                                                <li class="line25"><b>Secteur d'Activité :</b> <?php echo $dossier->getSecteuractivite()->getLibelle(); ?></li>
                                                <li class="line25"><b>Activité :</b> <?php //echo $dossier->getActivitetiers()->getLibelle(); ?></li>
                                            </ul>

                                            <hr style="border-top: 1px solid #ddd;"/>
                                            <address style='margin-left: 25px;font-family: Menlo,Monaco,Consolas,"Courier New",monospace;'>
                                                <strong><?php echo $dossier->getRaisonsociale() ?></strong>
                                                <?php $adresse = $dossier->getAdresse(); ?>
                                                <?php if ($adresse != null): ?>
                                                    <?php echo $adresse->getAdresse(); ?>
                                                    <br />
                                                    <?php
                                                    if ($adresse->getIdCouvernera() != null):
                                                        $ville = GouverneraTable::getInstance()->find($adresse->getIdCouvernera());
                                                        ?>
                                                        <?php if ($ville != null): ?>
                                                            <?php echo $ville->getPays()->getPays(); ?>, <?php echo $ville->getGouvernera() . ' ' . $adresse->getCodePostal(); ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <br />
                                                <?php endif; ?>
                                                <abbr title="Téléphone">Tél:</abbr> 
                                                <?php echo $dossier->getTelephoneUn(); ?>
                                                <br>
                                                <?php if ($dossier->getTelephoneDeux()): ?>
                                                    <abbr title="Téléphone">Tél 2:</abbr> 
                                                    <?php echo $dossier->getTelephoneDeux(); ?>
                                                <?php endif; ?>
                                                <br>
                                                <abbr title="Fax">Fax:</abbr> 
                                                <?php echo $dossier->getFax(); ?>
                                            </address>

                                            <address style='margin-left: 25px;font-family: Menlo,Monaco,Consolas,"Courier New",monospace;'>
                                                <abbr title="Email">Email:</abbr> <?php echo $dossier->getRaisonsociale() ?>
                                                <br />
                                                <a href="#"><?php echo $dossier->getEmail(); ?></a>
                                            </address>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="grey-background">
                                            <?php $journaux = JournalcomptableTable::getInstance()->getAllByDossierAndExercice($dossier->getId(), $_SESSION['exercice_id']); ?>
                                            <legend style="margin-bottom: 10px;">Journaux Comptables - <?php echo $_SESSION['exercice']; ?></legend>
                                            <ol style="margin-left: 50px;">
                                                <?php foreach ($journaux as $journal): ?>
                                                    <li class="line25"><?php echo $journal->getLibelle(); ?></li>
                                                <?php endforeach; ?>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">
                                <i class="ace-icon fa fa-lock bigger-120"></i>
                                Clôturer Exercice : <?php echo $_SESSION['exercice']; ?>
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <blockquote>
                                            <p class="line-height-125" style="text-align: justify;">
                                                Clôture comptable : 
                                                <span style="font-size: 14px; line-height: 23px;">
                                                    C'est une procédure comptable et une fonctionnalité de 
                                                    notre système d'information pour figer les comptes et 
                                                    passer à l'année suivante.
                                                </span>
                                            </p>

                                            <small>
                                                Plus d'informations 
                                                <cite title="Comptabilité">
                                                    <a href="#my-modal" data-toggle="modal">Afficher</a>
                                                </cite>
                                            </small>
                                        </blockquote>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <legend style="font-size: 16px;">Démarche de Clôture :</legend>
                                        <ol start="0" style="font-size: 14px;">
                                            <li class="text-warning">
                                                <div style="height: 30px;">
                                                    Préparation de l'exercice suivant
                                                </div>
                                                <div style="height: 30px;">
                                                    <i class="ace-icon fa fa-caret-right"></i> Créer l'exercice <?php echo $_SESSION['exercice'] + 1; ?>
                                                    <?php
                                                    $exercice_suivant = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
                                                    $dossierexercice = DossierexerciceTable::getInstance()->getByAnneAndDossier($_SESSION['exercice'] + 1, $_SESSION['dossier_id'])
                                                    ?>
                                                    <?php if ($exercice_suivant == null):
                                                        ?>
                                                        <button onclick="ajouterExercice()" class="btn btn-xs btn-default pull-right">
                                                            <i class="ace-icon fa fa-magic" style="margin-right: 3px;"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <i class="ace-icon fa fa-check pull-right" style="margin-right: 10px;"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <!--                                                <div style="height: 30px;">
                                                <?php // $count_comptes = PlandossiercomptableTable::getInstance()->getCountPlanComptable($dossier->getId(), $_SESSION['exercice_id']); ?>
                                                                                                    <i class="ace-icon fa fa-caret-right"></i> Actualiser le plan comptable (<?php // echo $count_comptes->getTotal();         ?>)
                                                <?php // if (sizeof($dossierexercice) >= 1): ?>
                                                <?php // if (sizeof($exercice_suivant->getPlandossiercomptable()) == 0): ?>
                                                                                                        <button onclick="exportPlanComptable()" class="btn btn-xs btn-default pull-right">
                                                                                                            <i class="ace-icon fa fa-share" style="margin-right: 2px;"></i>
                                                                                                        </button>
                                                <?php // else: ?>
                                                                                                        <i class="ace-icon fa fa-check pull-right" style="margin-right: 10px;"></i>
                                                <?php // endif; ?>
                                                <?php // endif; ?>
                                                                                                </div>-->
                                                <!--                                                <div style="height: 30px;">
                                                                                                    <i class="ace-icon fa fa-caret-right"></i> Exporter les journaux comptables (<?php echo $journaux->count(); ?>)-->
                                                <?php
//                                                    if (sizeof($dossierexercice) == 0):
//                                                        $journalomptable = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $dossierexercice->getFirst()->getIdExrcice());
                                                ?>

                                                <?php // if (sizeof($journalomptable) == 0): ?>
                                                <!--                                                        <button onclick="exportJournauxComptable()" class="btn btn-xs btn-default pull-right">
                                                                                                            <i class="ace-icon fa fa-share" style="margin-right: 2px;"></i>
                                                                                                        </button>-->
                                                <?php
//                                                    else:
//                                                        $journalomptable = JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $dossierexercice->getFirst()->getIdExercice());
                                                ?>
                                                <?php // if (sizeof($journalomptable) == 0): ?>
                                                <!--                                                            <button onclick="exportJournauxComptable()" class="btn btn-xs btn-default pull-right">
                                                                                                                <i class="ace-icon fa fa-share" style="margin-right: 2px;"></i>
                                                                                                            </button>-->
                                                <?php // else: ?>    
                                                                                                            <!--<i class="ace-icon fa fa-check pull-right" style="margin-right: 10px;"></i>-->
                                                <?php // endif; ?>
                                                                                <!--<i class="ace-icon fa fa-check pull-right" style="margin-right: 10px;"></i>-->
                                                <?php // endif; ?>
                                                <?php // endif;  ?>
                                                <!--</div>-->
                                                <?php $maquettes = MaquetteTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']); ?>
                                                <div style="height: 30px;">
                                                    <i class="ace-icon fa fa-caret-right"></i> Actualiser les Maquette de saisies (<?php echo $maquettes->count(); ?>)
                                                    <?php
                                                    if (sizeof($dossierexercice) >= 1):
                                                        $maquettes_prochain = MaquetteTable::getInstance()->getAllByDossierAndExercice($_SESSION['dossier_id'], $dossierexercice->getFirst()->getIdExercice());
                                                        ?>
                                                        <?php if ($maquettes->count() > 0 && $maquettes_prochain->count() < $maquettes->count()): ?>
                                                            <button onclick="exportMaquetteComptable()" class="btn btn-xs btn-default pull-right">
                                                                <i class="ace-icon fa fa-share" style="margin-right: 2px;"></i>
                                                            </button>
                                                        <?php else : ?>    
                                                            <i class="ace-icon fa fa-check pull-right" style="margin-right: 10px;"></i>
                                                        <?php
                                                        endif;
                                                    endif;
                                                    ?>

                                                </div>

                                                <hr style="margin-top: 10px; margin-bottom: 10px;">
                                            </li>
                                            <li style="margin-bottom: 10px;" >
                                                Valider les journaux comptables
                                                <?php $journaux_invalide = JournalcomptableTable::getInstance()->findNotValideByIdDossierAndIdExercice($_SESSION['dossier_id'], $_SESSION['exercice_id']); ?>
                                                <?php  if ($journaux_invalide->count() != 0): ?>
                                                    <button onclick="validerJournauxComptable()" class="btn btn-xs btn-success pull-right">
                                                        <i class="ace-icon fa fa-check"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <i class="ace-icon fa fa-check green pull-right" style="margin-right: 10px;"></i>
                                                <?php endif; ?>
                                            </li>
                                            <li class="text-success">
                                                Édition des états
                                                <ul class="list-unstyled">
                                                    <li style="color: #000; height: 30px; margin-top: 5px;">
                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                        Bilan ( Actif / Passif )
                                                        <a href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=1'); ?>" target="_blank" class="btn btn-xs btn-primary pull-right">
                                                            <i class="ace-icon fa fa-print"></i>
                                                        </a>
                                                        <span class="pull-right" style="width: 20px; text-align: center;"> / </span>
                                                        <a href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=0'); ?>" target="_blank" class="btn btn-xs btn-primary pull-right">
                                                            <i class="ace-icon fa fa-print"></i>
                                                        </a>
                                                    </li>

                                                    <li style="color: #000; height: 30px;">
                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                        État de Résultat
                                                        <a href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=2'); ?>" target="_blank" class="btn btn-xs btn-primary pull-right">
                                                            <i class="ace-icon fa fa-print"></i>
                                                        </a>
                                                    </li>

                                                    <li style="color: #000; height: 30px;">
                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                        État de flux de trésorerie (Flux MA)
                                                        <a href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=3'); ?>" target="_blank" class="btn btn-xs btn-primary pull-right">
                                                            <i class="ace-icon fa fa-print"></i>
                                                        </a>
                                                    </li>

                                                    <li style="color: #000; height: 30px;">
                                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                                        Solde intermediaire de gestion (SIG)
                                                        <a href="<?php echo url_for('fiche_Bilan/imprimerBilan?type=4'); ?>" target="_blank" class="btn btn-xs btn-primary pull-right">
                                                            <i class="ace-icon fa fa-print"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <hr>
                                            <li class="text-success" style="height: 30px;">
                                                <div style="height: 30px;">
                                                    
                                                     <i class="ace-icon fa fa-caret-right"></i> Générer les soldes de Clôture <?php // echo $count_comptes->getTotal();         ?>
                                                    <?php $valide='true';
                                                    if ($exercice_suivant) {
                                                        $plandoss = PlandossiercomptableTable::getInstance()->findByIdDossierAndIdExercice($_SESSION['dossier_id'], $exercice_suivant->getId());
                                                        foreach ($plandoss as $plando):
                                                            if ($plando->getSoldeouv() == null)
                                                                $valide = 'false';
                                                        endforeach;
                                                    }
                                                    $count_comptes = PlandossiercomptableTable::getInstance()->getCountPlanComptable($dossier->getId(), $_SESSION['exercice_id']);
                                                    ?>
                                                    <?php if ($exercice_suivant) {if ($exercice_suivant && $valide == 'false') : ?>
                                                       
                                                        <button onclick="actulaiserlplandossiercomptable()" class="btn btn-xs btn-default pull-right">
                                                            <i class="ace-icon fa fa-share" style="margin-right: 2px;"></i>
                                                        </button>                                                         
                                                    <?php else: ?>

                                                        <i class="ace-icon fa fa-check red pull-right" style="margin-right: 10px;"></i>

                                                    <?php endif;} ?>

                                                </div>
                                            </li>
                                            <li class="text-primary" style="height: 30px;">
                                                Édition du Report à Nouveau
                                                <?php // if ($journaux_invalide->count() == 0): ?>
                                                <?php $exercice_anterieur = DossierexerciceTable::getInstance()->getByDossierAndExercice($dossier->getId(), $_SESSION['exercice_id'])->getFirst(); ?>
                                                <?php // if ($exercice_anterieur->getExporte() == null || $exercice_anterieur->getExporte() == false): ?>
                                                <?php
                                                $exercice_suiv = $_SESSION['exercice'] + 1;
//                                                $type='comptabilite';
                                                $exercice_suivant = ExerciceTable::getInstance()->getByLibelle($_SESSION['exercice'] + 1)->getFirst();
//                                                die(($exercice_suivant).'pp');
                                                if ($exercice_suivant != '')
                                                    $piece = PiececomptableTable::getInstance()->getPieceRAN($exercice_suivant->getId())->getFirst();
                                                ?>  

                                                <?php if (sizeof($piece) <= 1): ?>
                                                    <a href="<?php echo url_for('journal/reportNouveau') ?>" target="_blank" class="btn btn-xs btn-warning pull-right">
                                                        <i class="ace-icon fa fa-file-text" style="margin-right: 3px;"></i>
                                                    </a>
                                                <?php elseif (sizeof($piece) > 1): ?>
                                                    <i class="ace-icon fa fa-check blue pull-right" style="margin-right: 10px;"></i>
                                                <?php endif; ?>
                                                <?php // endif;           ?>
                                            </li>
                                            <li class="text-danger">
                                                Achever la Clôture du <?php echo $_SESSION['exercice']; ?>
                                                <?php if ($journaux_invalide->count() == 0): ?>
                                                    <?php if ($exercice_anterieur->getExporte() == true): ?>
                                                        <?php if ($exercice_anterieur->getCloture() == null || $exercice_anterieur->getCloture() == false): ?>
                                                            <button onclick="cloturerExercice()" class="btn btn-xs btn-danger pull-right">
                                                                <i class="ace-icon fa fa-lock" style="margin-right: 5px;"></i>
                                                            </button>
                                                        <?php else: ?>
                                                            <i class="ace-icon fa fa-check red pull-right" style="margin-right: 10px;"></i>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </li>
                                        </ol>

                                        <hr>
                                        <div class="grey-background" style="font-size: 14px; text-align: justify;">
                                            <span style="color: #a94442;">Attention :</span> l'étape initiale "0" est nécessaire pour exporter <i><u>le report à nouveau</u></i> ( les soldes à reporter ) vers l'exercice suivant.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 pull-right">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title smaller">
                                <i class="ace-icon fa fa-lock bigger-120"></i>
                                Annuler Clôture Exercice : <?php echo $_SESSION['exercice']; ?>
                            </h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul>
                                            <li class="text-primary1">
                                                Annuler Clôture du <?php
                                                echo $_SESSION['exercice'];

                                                //die($journaux_invalide->count().'ff'.$exercice_anterieur->getExporte().'ffc'.$exercice_anterieur->getCloture()); 
                                                ?>
                                                <?php // if ($journaux_invalide->count() == 0):  ?>
                                                <?php if ($exercice_anterieur->getExporte() == true): ?>
                                                    <?php if ($exercice_anterieur->getExporte() == true && $exercice_anterieur->getCloture() == true): ?>
                                                        <button onclick="annulerCloture()" class="btn btn-xs  pull-right">
                                                            <i class="ace-icon fa fa-file-text" style="margin-right: 5px;"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <i class="ace-icon fa fa-check red pull-right" style="margin-right: 5px;"></i>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php // endif;            ?>
                                            </li>
                                        </ul> 
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_partial('info_cloture'); ?>


    <script  type="text/javascript">


        function annulerCloture() {

            $.ajax({
                url: '<?php echo url_for('accueil/annulercloture') ?>',
                data: '',
                success: function (data) {
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;'> " + " Annulation clôture avec succès !</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    document.location.reload();
                }
            });
        }


        function validerJournauxComptable() {
            $.ajax({
                url: '<?php echo url_for('accueil/validerJournauxComptable') ?>',
                data: '',
                success: function (data) {
                    document.location.reload();
                }
            });
        }

        function actulaiserlplandossiercomptable() {
            $.ajax({
                url: '<?php echo url_for('accueil/actulaiserlplandossiercomptable') ?>',
                data: '',
                success: function (data) {
                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;'> " + " Plan comptable est actualisé avec succès  !!</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
//                    document.location.reload();
                }
            });
        }
        function cloturerExercice() {
            $.ajax({
                url: '<?php echo url_for('accueil/cloturerExercice') ?>',
                data: '',
                success: function (data) {
                    document.location.reload();
                }
            });
        }

        function ajouterExercice() {
            $.ajax({
                url: '<?php echo url_for('accueil/ajouterExercice') ?>',
                data: '',
                success: function (data) {
                    document.location.reload();
                }
            });
        }

        function exportPlanComptable() {
            $.ajax({
                url: '<?php echo url_for('accueil/exportPlanComptable') ?>',
                data: '',
                success: function (data) {
                    document.location.reload();
                }
            });
        }

        function exportJournauxComptable() {
            $.ajax({
                url: '<?php echo url_for('accueil/exportJournauxComptable') ?>',
                data: '',
                success: function (data) {
                    document.location.reload();
                }
            });
        }

        function exportMaquetteComptable() {
            $.ajax({
                url: '<?php echo url_for('accueil/exportMaquetteComptable') ?>',
                data: '',
                success: function (data) {
                  //  document.location.reload();
                }
            });
        }
    </script>

    <style>

        .grey-background{
            padding: 9.5px;
            margin: 0 0 0px;
            font-size: 14px;
            word-break: break-word;
            word-wrap: break-word;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .line25{
            line-height: 25px;
            font-family: Menlo,Monaco,Consolas,"Courier New",monospace;
            font-size: 14px;
        }

    </style>
<?php endif; ?>