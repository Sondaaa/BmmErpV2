<?php
$is_valideReg = $user->getVailderegrouppement();
$naturedoc = NaturedocachatTable::getInstance()->findAll();
$nature = null;
foreach ($naturedoc as $nnature) {
    if ($nnature->getIdUser() && $nnature->getIdUser()!='NULL') {
      
        $array = json_decode($nnature->getIdUser());
        if (in_array($user->getId(), $array)) {
            $nature = $nnature;
        }
    }
}
$utilisateur = UtilisateurTable::getInstance()->getByAdminachat($user->getId()); ?>
<div class="container-fluid" ng-controller="CtrlDemandeprix">

    <div class="row" ng-init="AfficheLignedocBCIVersDemandeAchatBCi('<?php //echo $idss 
                                                                        ?>')">
        <div id="sf_admin_container">
            <h1 id="replacediv">
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Liste des Bons de Commandes Internes (D.I.)
                </small>
            </h1>
        </div>
        <form id='liste_bci'>
            <input type="hidden" id="ids" name="ids">
        </form>

        <div class="col-xs-8 widget-container-col" style="height: 270px;" id="widget-container-col-1">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">Recherche</h4>
                </div>

                <table class="table table-bordered table-hover" style="min-height: 100%">
                    <tbody>
                        <tr>
                            <td>
                                <div class="col-md-12">
                                    <label style="font-size: 15px;">Choisir date debut et date fin de l'operation</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_debut" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_fin" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-6">
                                    <label class=" bigger-80 succees" style="font-size: 15px;">Listes des labos ou Administration</label>
                                    <select multiple id="labo_id">
                                        <?php foreach ($listlabos as $labo) : ?>
                                            <option value="<?php echo $labo->getId() ?>"><?php echo $labo ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-6">
                                    <label class=" bigger-80 succees" style="font-size: 15px;">Listes des demandeur</label>
                                    <select multiple id="demandeur_id">
                                        <?php foreach ($demandeurs as $demandeur) : ?>
                                            <option value="<?php echo $demandeur->getId() ?>"><?php echo $demandeur->getAgents() ?></option>

                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>


        <div class="col-xs-8 widget-container-col" id="widget-container-col-1">
            <div class="widget-box" id="widget-box-1">
                <div class="widget-header">
                    <h5 class="widget-title">Affichage listes des D.I. par les filtres suivant</h5>
                </div>
                <table>
                    <tr>
                        <td>
                            <div class="col-md-8">
                                <label class="bigger-80 succees" style="font-size: 15px;">Listes des D.I. </label>
                                <a target="_blanc" type="button" onclick="printListDocAchats()" class="btn-sm btn-xs danger  pull-rigth">
                                    Exporter PDF Liste des BCI
                                </a>
                                <select multiple id="bci_id">
                                    <?php foreach ($bcis as $bci) : ?>
                                        <option value="<?php echo $bci->getId() ?>">
                                            <?php
                                            if ($bci->getIdEmplacement())
                                                echo $bci->getNumerodocumentachat() . ' MNT:  ' . $bci->getMontantestimatiftofloat() . ' LABO:' . $bci->getEtage();
                                            else
                                                echo $bci->getNumerodocumentachat() . ' MNT:  ' . $bci->getMontantestimatiftofloat();
                                            ?></option>

                                    <?php endforeach ?>
                                </select>

                            </div>
                            <?php //$is_valideReg == false
                            if ($user->getIdMagasin() && $nature &&   $nature->getId() == 2) :
                            ?>
                                <div class="pull-right" style="padding-right: 10px;">
                                    <select id="id_reception">
                                        <option value="0"></option>
                                        <?php foreach ($utilisateur as $user) : ?>
                                            <option value="<?php echo $user->getId() ?>"><?php echo $user ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    </br>
                                    <input type="button" id="btn_envoi" value="Envoi BCI Pour Regroupement " class="btn btn-primary" ng-click="EnvoieBCiPourRegroupperDA('')">
                                </div>
                            <?php
                            endif; ?>
                        </td>
                    </tr>
                    <?php
                    if ($is_valideReg == true) : ?>
                        <tr>
                            <td>
                                <div class="col-md-8">
                                    <label class="bigger-80 succees" style="font-size: 15px;">Listes des D.I. Re??u </label>
                                    <a target="_blanc" type="button" onclick="printListDocAchatsRecu()" class="btn-sm btn-xs danger  pull-rigth">
                                        Exporter PDF Liste des BCI
                                    </a>
                                    <select multiple id="bci_id_recu">
                                        <?php foreach ($bcis_recu as $bci) : ?>
                                            <option value="<?php echo $bci->getId() ?>"><?php echo $bci->getNumerodocumentachat() . ' MNT:  ' . $bci->getMontantestimatiftofloat() . ' LABO:' . $bci->getEtage() ?></option>

                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <?php if ($is_valideReg == true) : ?>
                                    <div class="pull-right" style="padding-right: 10px;">
                                        <input type="button" value="Annulation Regroup et Envoie ?? l'unit?? achat" class="btn btn-xs btn-danger" id='btn_annulerReg' ng-click="AnnulationEnvoieBCiPourRegroupperDA('')">
                                    </div>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endif;
                    if ($user->getIdMagasin()) :
                        if ($nature &&  $nature->getId() == 2) {  ?>
                            <tr>
                                <td>
                                    <div class="col-md-8">
                                        <label class="bigger-80 succees" style="font-size: 15px;">Listes des D.I. Rejet??(s) Par Regroupement </label>
                                        <a target="_blanc" type="button" onclick="printListDocAchatsRjete()" class="btn-sm btn-xs danger  pull-rigth">
                                            Exporter PDF Liste des BCI
                                        </a>
                                        <select multiple id="bci_id_rejete">
                                            <?php foreach ($bcis_rejete as $bci) : ?>
                                                <option value="<?php echo $bci->getId() ?>"><?php echo $bci->getNumerodocumentachat() . ' MNT:' . $bci->getMontantestimatiftofloat() . ' LABO:' . $bci->getEtage() ?></option>

                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    endif; ?>
                </table>
                <div class="pull-rigth">
                    <a type="button" value="Effacer" class="btn btn-white btn-primary" href="/achats_dev.php/documentachat/bcis/action?_reset">Effacer</a>
                    <input type="button" value="Valider" class="btn btn-xs btn-success" onclick="AfficherListeLignedoc()">
                </div>
            </div>
        </div>



    </div>
    <form id='liste_bci' action="<?php echo url_for('documentachat/ExporterDAregroupe') ?>" method="POST">
        <input type="hidden" id="array_bci_1" name="array_bci_1" value="10">
    </form>
    <div class="mws-panel-body">
        <div>
            <input type="hidden" id="type_tri" value="">
            <input type="hidden" id="tri" value="">
            <table id="listPiece" style="max-width: 100%">
                <thead>
                    <tr id="list_tri" style="border-bottom: 1px solid #000000" role="row">
                        <th class="sorting" name="tri" style="width: 10%;">N??Ordre</th>
                        <!-- <th class="sorting" name="tri" style="width: 10%;">D.I.</th> -->

                        <th style="width: 20%; text-align: center;">Article </th>
                        <th style="width: 10%; text-align: center;">Qte</th>
                        <!-- <th style="width: 18%;">Projet</th> -->
                    </tr>

                </thead>
                <tfoot id="listPiece_footer">

                </tfoot>
                <tbody>
                    <?php //include_partial("documentachat/liste", array("pager" => $pager, "page" => $page)) 
                    ?>
                </tbody>

            </table>
        </div>
    </div>



    <div class="pull-right" style="padding-right: 10px;">
        <input type="button" value="Exporter En Demande Achat" class="btn btn-primary" ng-click="ValiderDAchatRegroupperBCI('')">

    </div>
    <div class="col-xs-12 widget-container-col" id="div_ligne" style="display: none;">
        <div class="widget-box">
            <div class="widget-header">
                <h5 class="widget-title">Affichage listes des Lignes des D.I. S??lectionnes</h5>
            </div>
            <table>
                <tr>
                    <td >
                        <div>
                            <label class="text-warning bigger-80 succees">Listes des Article Du BCI </label>
                            <div style="overflow-y: auto; max-height: 110px; width:100%">

                                <table id="liste_ligne" style="overflow-y: auto;
                                                width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </td>
                    <?php if ($is_valideReg == true) : ?>
                        <td >
                            <div>
                                <label class="text-warning bigger-80 succees">Listes des Article des BCI Re??u</label>
                                <div style="overflow-y: auto; max-height: 110px; width:100%">

                                    <table id="liste_ligne_bci_recu" style="overflow-y: auto;
                                                width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </td>
                    <?php endif; ?>
                    <?php //$is_valideReg == false
                    if ($user->getIdMagasin()  && $nature &&  $nature->getId() == 2) :
                    ?>
                        <td >
                            <div>
                                <label class="text-warning bigger-80 succees">Listes des Article des BCI Rejet??(s) Par Regr. </label>
                                <div style="overflow-y: auto; max-height: 110px; width:100%">

                                    <table id="liste_ligne_bci_rejete" style="overflow-y: auto;
                                                width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </td>
                    <?php
                    endif; ?>
                </tr>
            </table>
        </div>
    </div>
    <input type="hidden" id="array_bci" name="array_bci">
    <?php //if ($pager->getResults()->getFirst()->getIdEtatdoc() == 1) { 
    ?>
    <?php //if ($pager->getResults()->getFirst()->getIdNaturedoc() == 2 || $pager->getResults()->getFirst()->getIdNaturedoc() == 1) { 
    ?>

    <?php // }
    //} 
    ?>
</div>
</div>

<script>
    function ExporterDARegrouppe() {
        if ($('#array_bci').val() == '') {
            bootbox.dialog({
                message: "Veuillez choisir des BCIS !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm",
                    }
                }
            });
        } else {

            console.log($('#array_bci').val(), 'fr');
            $('#liste_bci').empty();
            $('#liste_bci').append(`<input type="hidden" value="${$('#array_bci').val()}" name="ids">`);
            $('#liste_bci').submit();
            console.log($('#array_bci').val(), 'vv');
        }

    }


    function AfficherListeLignedoc() {
        if ($('#bci_id_recu').val() != '' || $('#bci_id').val() != '' || $('#bci_id_rejete').val() != '') {
            allbci_recue = null; allbci_rejete = null;
            if (!isNaN(parseInt($('#bci_id_recu').val())))
                allbci_recue = $('#bci_id_recu').val();
            if (!isNaN(parseInt($('#bci_id_rejete').val())))
                allbci_rejete = $('#bci_id_rejete').val();
            $.ajax({
                url: '<?php echo url_for('documentachat/AfficherParFiltrage'); ?>',
                data: 'bci_id=' + $('#bci_id').val() + '&bci_id_recu=' + allbci_recue + '&bci_id_rejete=' + allbci_rejete,
                success: function(data) {
                    $('#listPiece tbody').html(data);

                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir au mois une D.I..Syst??me !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm",
                    }
                }
            });

        }
    }
</script>
<script>
    function printListDocAchats() {
        var url = '';
        if ($('#bci_id').val() != '') {
            url = '?bci_id=' + $('#bci_id').val();
        }
        url = '<?php echo url_for('documentachat/imprimerlistedocumentbciselectionne') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function printListDocAchatsRecu() {
        var url = '';
        if ($('#bci_id_recu').val() != '') {
            url = '?bci_id=' + $('#bci_id_recu').val();
        }
        url = '<?php echo url_for('documentachat/imprimerlistedocumentbciselectionne') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function printListDocAchatsRjete() {
        var url = '';
        if ($('#bcis_rejete').val() != '') {
            url = '?bci_id=' + $('#bcis_rejete').val();
        }
        url = '<?php echo url_for('documentachat/imprimerlistedocumentbciselectionne') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>
<style>
    table thead {
        height: 10px !important;
    }
</style>