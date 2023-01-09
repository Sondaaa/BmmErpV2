<div id="sf_admin_container" ng-controller="CtrlDemandeprix">
    <h1>Nouvelle Fiche Facture</h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);

    $liste_tauxfodec = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('tauxfodec')
        ->orderBy('id')
        ->execute();
    $taux_tva = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('tva')
        ->orderBy('libelle')->execute();

    ?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php echo 'active' ?>">
                    <a href="#profile" data-toggle="tab" aria-expanded="true" ng-controller="Ctrlfacturation" ng-init="InialiserChamps()">
                        Formulaire De Traitement Facture</a>
                </li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content ">
                <div class="tab-pane <?php echo 'fade active in' ?>" id="profile">

                    <table style="margin-bottom: 0px;">

                        <tr>
                            <td>Référence</br>
                                <?php echo $form['reference']->renderError() ?>
                                <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
                            </td>

                            <td class="disabledbutton">Date Création</br>
                                <input type="date" id="documentachat_datecreation" value="<?php echo date('Y-m-d') ?>" readonly="true">
                            </td>
                            <td>Date Fature</br>

                                <input type="date" id="date_facture">
                            </td>
                            <td>Numéro Système</br>
                                <input type="text" readonly="true" id="numero_sys" value="<?php echo $numero_systeme ?>">
                                <input type="hidden" value="<?php echo $numero_sys_hidden; ?>" id="numero_sys_hidden">
                            </td>

                        </tr>
                        <tr>
                            <td>Numéro Fac</br>
                                <input type="text" id="num_facture" value="">
                            </td>
                            <td>Pèriode<bR>
                                <input type="text" id="periode" value="">
                            </td>

                        </tr>

                        <tr>
                            <td colspan="4">Raison sociale
                                <input type="text" value="" id="fournisseur_raison_horsbci" ng-model="fournisseur.text" ng-change="AfficheFournisseurHorbci('#fournisseur_raison', '#id_fournisseur')">
                                <input type="hidden" value="" id="id_fournisseur_horbci">
                            </td>
                        </tr>
                        <tr>
                            <td>T.H.T:</br>
                                <input class="align_right" type="text" id="txt_mnttotal_htax" value="" />
                            </td>
                            <td>Taux T.V.A</br>
                                <select id="tvasysFac">

                                    <?php foreach ($taux_tva as $tva) : ?>
                                        <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>Droit de Timbre
                                <input type="checkbox" id="droit_timbre" ng-click="ValiderDroitTimbreHrobci()" class="pull-right">
                                <input type="text" id="valeurdroit_societe" readonly="true">

                            </td>


                            <td>Montant Total TTC :</br>
                                <input class="align_right" type="text" id="txt_mnttotal_ttc" value="" />
                            </td>
                        </tr>
                    </table>




                </div>
            </div>
        </div>
    </div>
    <fieldset style="margin-left: 50%">
        <legend>Action Fiche Facture</legend>
        <div>

            <input id="btn_retour" onclick="document.location.href = '<?php echo url_for('documentachat/index?idtype=15&typefac=horbci') ?>'" type="button" value="Retour à La liste  " class="btn btn-outline btn-success" />
            <input id="btnvalider" ng-click="AjouterFacture()" type="button" value="Valider Factue... " class="btn btn-outline btn-danger" style="margin-left: 2px;" />
        </div>
    </fieldset>
</div>
<script type="text/javascript">
    function miseAjour(element_input) {
        var norgdre = $('#' + element_input.id).attr('ordre');
        var p = $('#' + element_input.id).attr('provisoire');
        //        alert(norgdre);
        //        if (p != '')
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne1(norgdre);
        //        else
        //            angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
    }
</script>
<style>
    #ul_compte {
        min-width: 130px;
    }
</style>