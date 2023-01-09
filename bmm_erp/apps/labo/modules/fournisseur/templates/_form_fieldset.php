<?php

$user = new Utilisateur();
$user = $sf_user->getAttribute('userB2m');
?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
</fieldset>

<fieldset class="<?php if ($user->getAcceesDroit("achat_et_validation_frs")) echo 'disabledbutton' ?>"  ng-init="InialiserChamps(<?php echo $user->getId() ?>)">
    <legend>DONNEES DE FICHE</legend>
    <table>
        <tbody>
            <tr>
                 
                <td><label>Numéro Fiche</label></td>
                <td style="">
                    <?php echo $form['nfiche']->renderError() ?>
                    <?php echo $form['nfiche'] ?>
                </td>
                <td><label>Date création</label></td>
                <td colspan="3">
                    <?php echo $form['datecreation']->renderError() ?>
                    <?php echo $form['datecreation'] ?>
                </td>
                <td>
                    <label>Emetteur </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['id_user']->renderError() ?>
                    <?php echo $form['id_user'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset ng-init="InialiserChamps(<?php echo $user->getId() ?>)"  class="<?php if ($user->getAcceesDroit("achat_et_validation_frs")) echo 'disabledbutton' ?>">
    <legend>DONNEES DE BASE</legend>
    <table>
        <tbody>
            <tr>
                <td><label>Activité</label></td>
                <td colspan="2">
                    <?php echo $form['id_activite']->renderError() ?>
                    <?php echo $form['id_activite'] ?>
                </td>
                <td>
                    <a href="#my-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
                        &nbsp; + &nbsp;
                    </a>
                    <div id="my-modal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="smaller lighter blue no-margin">Nouvelle Activité</h3>
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td><label>Nom de l'activité</label></td>
                                            <td><input type="text" id="activite_libelle"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 1%;">
                                        <i class="ace-icon fa fa-times"></i>
                                        fermer
                                    </button>
                                    <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterActiviter()">
                                        <i class="ace-icon fa fa-plus"></i>
                                        Ajouter
                                    </button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </td>
                <td><label>Matricule Fiscale</label></td>
                <td>
                    <?php echo $form['matriculefiscale']->renderError() ?>
                    <?php echo $form['matriculefiscale'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Famille Article</label>
                </td>
                <td colspan="2">
                    <?php echo $form['id_famillearticle']->renderError() ?>
                    <?php echo $form['id_famillearticle'] ?>
                </td>
                <td> 
                    <a href="#famille-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
                        &nbsp; + &nbsp;
                    </a>
                    <div id="famille-modal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="smaller lighter blue no-margin">Nouvelle Famille Article</h3>
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td><label>Famille</label></td>
                                            <td><input type="text" id="famille_libelle"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal" style="margin-left: 1%;">
                                        <i class="ace-icon fa fa-times"></i>
                                        fermer
                                    </button>
                                    <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterFamille()">
                                        <i class="ace-icon fa fa-plus"></i>
                                        Ajouter
                                    </button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </td>
                <td><label>Raison Sociale </label></td>
                <td>
                    <?php echo $form['rs']->renderError() ?>
                    <?php echo $form['rs'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Code Fournisseur</label></td>
                <td>
                    <?php echo $form['codefrs']->renderError() ?>
                    <?php echo $form['codefrs'] ?>
                </td>
                <td></td>
                <td><label>A Contacter <br>(nom et prénom) </label></td>
                <td colspan="2">
                    <?php echo $form['nom']->renderError() ?>
                    <?php echo $form['nom'] ?>
                    <?php echo $form['prenom']->renderError() ?>
                    <?php echo $form['prenom'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Tél</label></td>
                <td>
                    <?php echo $form['tel']->renderError() ?>
                    <?php echo $form['tel'] ?>
                </td>
                <td><label>Fax </label></td>
                <td>
                    <?php echo $form['gsm']->renderError() ?>
                    <?php echo $form['gsm'] ?>
                </td>
                <td><label>E-Mail </label></td>
                <td>
                    <?php echo $form['mail']->renderError() ?>
                    <?php echo $form['mail'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Adresse </label></td>
                <td colspan="3">
                    <?php echo $form['adr']->renderError() ?>
                    <?php echo $form['adr'] ?>
                </td>
                <td><label>Gouvernorat </label></td>
                <td>
                    <?php echo $form['id_gouv']->renderError() ?>
                    <?php echo $form['id_gouv'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Assujetti tva</label></td>
                <td>
                    <?php echo $form['assujtva']->renderError() ?>
                    <?php echo $form['assujtva'] ?>
                </td>
                <td><label>Fodec</label></td>
                <td>
                    <?php echo $form['fodec']->renderError() ?>
                    <?php echo $form['fodec']->render(array('ng-click'=>'ValiderFodec()')) ?>
                </td>
                <td id="valfodec" colspan="2">
                    <label>Valeur Fodec</label>
                    <?php echo $form['valeurfodec']->renderError() ?>
                    <?php echo $form['valeurfodec'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset id="noscript4">
    <legend>DONNEES BANCAIRES & COMPTABLES</legend>
    <table class="disabledbutton">
        <tbody>
            <tr>
                <td><label>Nature Compte :</label></td>
                <td class="disabledbutton">
                    <?php echo $form['id_naturecompte']->renderError() ?>
                    <?php echo $form['id_naturecompte'] ?>
                </td>
                <td><label>Compte Bancaire/CCP :</label></td>
                <td class="disabledbutton">
                    <?php echo $form['rib']->renderError() ?>
                    <?php echo $form['rib'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Compte comptable</label></td>
                <td class="disabledbutton">
                    <?php echo $form['id_plancomptable']->renderError() ?>
                    <?php echo $form['id_plancomptable'] ?>
                </td>
                <td><label>Compte Analytique</label></td>
                <td class="disabledbutton">
                    <?php echo $form['id_plancomptable']->renderError() ?>
                    <?php echo $form['id_plancomptable'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Observation</label></td>
                <td colspan="7">
                    <?php echo $form['observation']->renderError() ?>
                    <?php echo $form['observation'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset id="noscript4">
    <legend>DONNEES DE VALIDATION</legend>
    <table class="<?php if (!$user->getAcceesDroit("achat_et_validation_frs")) echo 'disabledbutton' ?>">
        <tbody>
            <tr>
                <td><label>Etat Fournisseur :</label></td>
                <td>
                    <?php echo $form['etatfrs']->renderError() ?>
                    <?php echo $form['etatfrs'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Note Cloture :</label></td>
                <td>
                    <?php echo $form['notecloture']->renderError() ?>
                    <?php echo $form['notecloture'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>