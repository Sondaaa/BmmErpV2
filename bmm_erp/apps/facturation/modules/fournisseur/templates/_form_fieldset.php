<?php
$user = new Utilisateur();
$user = $sf_user->getAttribute('userB2m');
$activites = Doctrine_Core::getTable('Activitetiers')->createQuery('a')->WHERE('parent_id is null')->execute();
?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset) : ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
</fieldset>

<fieldset class="<?php
if ($user->getAcceesDroit("achat_et_validation_frs"))
    echo 'disabledbutton'
    ?>" 
<?php if ($form->getObject()->isNew()) { ?> 
              ng-init="InialiserChamps(<?php echo $user->getId() ?>)"
          <?php } if (!$form->getObject()->isNew()) { ?>
              ng-init="InialiserChampsUserUpdate(<?php echo $user->getId() ?>)"
          <?php } ?>>
    <legend>DONNEES DE FICHE</legend>
    <table>
        <tbody>
            <tr>

                <td><label>Numéro Fiche</label></td>
                <td class="disabledbutton">
                    <?php echo $form['nfiche']->renderError() ?>
                    <?php echo $form['nfiche'] ?>
                </td>
                <td><label>Date création</label></td>
                <td class="disabledbutton">
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
                <td>
                    <label>Updated User </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['user_updated']->renderError() ?>
                    <?php echo $form['user_updated'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset  
<?php if ($form->getObject()->isNew()) : ?>
        ng-init="InialiserChamps(<?php echo $user->getId() ?>)" 
    <?php
    endif;
    if (!$form->getObject()->isNew()) {
        ?>
        ng-init="InialiserChampsUserUpdate(<?php echo $user->getId() ?>)"
<?php } ?>
    >
    <legend>DONNEES DE BASE</legend>
    <table>
        <tbody>
            <tr>

                <td>
                    <div class="row">
                        <div class="col-md-5">
                            <label>Activité</label>
                            <select id="activite">
                                <option></option>
                                <?php foreach ($activites as $activite) : ?>
                                    <option value="<?php echo $activite->getId() ?>"><?php echo $activite ?></option>
<?php endforeach ?>
                            </select>

                        </div>
                        <div class="col-md-5">
                            <label>Sous Activité
                                <a href="#my-modal" role="button" class="label label-danger" data-toggle="modal">
                                    <i class="fa fa-plus"></i> Ajouter Activité
                                </a></label>
                            <?php echo $form['id_activite']->renderError() ?>
<?php echo $form['id_activite'] ?>
                        </div>
                        <div class="col-md-2">

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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <label>Famille Article <a href="#famille-modal" role="button" class="label label-danger" data-toggle="modal">
                                    <i class="fa fa-plus"></i> Ajouter famille
                                </a></label>
                            <?php echo $form['id_famillearticle']->renderError() ?>
<?php echo $form['id_famillearticle'] ?>

                        </div>
                        <div class="col-md-2">

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
                        </div>
                    </div>
                </td>


                <td>
                    <label>Matricule Fiscale</label>
                    <?php echo $form['matriculefiscale']->renderError() ?>
                    <?php echo $form['matriculefiscale'] ?>
                    <label>Raison Sociale </label>
                    <?php echo $form['rs']->renderError() ?>
<?php echo $form['rs'] ?>
                </td>
            </tr>

            <tr>

                <td colspan="2">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Code Fournisseur</label>
<!----render(array('value' => $form->getObject()->getCurrentCodeFRS()))-->
                            <?php echo $form['codefrs']->renderError() ?>
                            <?php echo $form['codefrs'] ?>
                        </div>
                        <div class="col-md-6">
                            <label>A Contacter <br>(nom et prénom) </label>
                            <?php echo $form['nom']->renderError() ?>
                            <?php echo $form['nom'] ?>
                            <?php echo $form['prenom']->renderError() ?>
<?php echo $form['prenom'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Tél</label>
                            <?php echo $form['tel']->renderError() ?>
<?php echo $form['tel'] ?>
                        </div>
                        <div class="col-md-4">
                            <label>Fax </label>
                            <?php echo $form['gsm']->renderError() ?>
<?php echo $form['gsm'] ?>
                        </div>
                        <div class="col-md-4">
                            <label>E-Mail </label>
                            <?php echo $form['mail']->renderError() ?>
<?php echo $form['mail'] ?>
                        </div>
                    </div>
                </td>

            </tr>

            <tr>

                <td colspan="2">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Adresse </label>
                            <?php echo $form['adr']->renderError() ?>
<?php echo $form['adr'] ?>
                        </div>
                        <div class="col-md-4">
                            <label>Gouvernorat </label>
                            <?php echo $form['id_gouv']->renderError() ?>
<?php echo $form['id_gouv'] ?>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <label>Assujetti tva</label>
                                <?php echo $form['assujtva']->renderError() ?>
<?php echo $form['assujtva'] ?>
                            </div>
                            <div class="col-md-6">
                                <label>Fodec</label>
                                <?php echo $form['fodec']->renderError() ?>
<?php echo $form['fodec']->render(array('ng-click' => 'ValiderFodec()')) ?>
                                <div id="valfodec" colspan="2">
                                    <label>Valeur Fodec</label>
                                    <?php echo $form['valeurfodec']->renderError() ?>
<?php echo $form['valeurfodec'] ?>
                                </div>
                            </div>



                        </div>
                    </div>

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

                <td class="disabledbutton">
                    <label>Banque :</label>
                    <?php echo $form['id_banque']->renderError() ?>
<?php echo $form['id_banque'] ?>
                    <label>Compte Bancaire/CCP :</label>

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

                <td class="disabledbutton">
                    <label>Compte Analytique</label>
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
    <?php
    if ($form->getObject()->getId())
        $rib_banques = RibbancaireTable::getInstance()->findByFrsId($form->getObject()->getId());
    ?>
    <table>
        <thead>
            <tr>
                <th>Nature compte</th>
                <th>Banque</th>
                <th>Rib</th>
                <th>Etat</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($form->getObject()->getId()) {
                if ($rib_banques):
                    foreach ($rib_banques as $rib) :
                        ?>

                        <tr>
                            <td><?php echo $rib->getRib() ?></td>
                            <td><?php echo $rib->getNaturebanque() ?></td>
                            <td><?php echo $rib->getBanque() ?></td>
                            <td><?php echo $rib->getEtatRib() ?></td>

                        </tr>
                        <?php
                    endforeach;
                endif;
            }
            ?>
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