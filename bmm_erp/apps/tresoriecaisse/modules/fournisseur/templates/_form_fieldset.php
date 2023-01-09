<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset) : ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
</fieldset>

<fieldset ng-init="InialiserChamps(<?php echo  $sf_user->getAttribute('userB2m')->getId() ?>)">
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
                <td colspan="3" class="disabledbutton">
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
<fieldset>
    <legend>DONNEES DE BASE</legend>
    <table>
        <tbody>
            <tr>
                <td><label>Activité</label></td>
                <td colspan="3" class="disabledbutton">
                    <?php echo $form['id_activite']->renderError() ?>
                    <?php echo $form['id_activite'] ?>
                </td>
                <td>
                    <label>Famille Article</label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['id_famillearticle']->renderError() ?>
                    <?php echo $form['id_famillearticle'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Matricule Fiscale</label></td>
                <td>
                    <?php echo $form['codefrs']->renderError() ?>
                    <?php echo $form['codefrs'] ?>
                </td>
                <td>
                    <label>Raison Sociale </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['rs']->renderError() ?>
                    <?php echo $form['rs'] ?>
                </td>
                <td>
                    <label>A Contacter <br>(nom et prénom) </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['nom']->renderError() ?>
                    <?php echo $form['nom'] ?>
                    <?php echo $form['prenom']->renderError() ?>
                    <?php echo $form['prenom'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Tél</label></td>
                <td class="disabledbutton">
                    <?php echo $form['tel']->renderError() ?>
                    <?php echo $form['tel'] ?>
                </td>
                <td>
                    <label>Fax </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['gsm']->renderError() ?>
                    <?php echo $form['gsm'] ?>
                </td>
                <td>
                    <label>E-Mail </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['mail']->renderError() ?>
                    <?php echo $form['mail'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Adresse </label>
                </td>
                <td colspan="3" class="disabledbutton">
                    <?php echo $form['adr']->renderError() ?>
                    <?php echo $form['adr'] ?>
                </td>
                <td>
                    <label>Gouvernorat </label>
                </td>
                <td class="disabledbutton">
                    <?php echo $form['id_gouv']->renderError() ?>
                    <?php echo $form['id_gouv'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset id="noscript4">
    <legend>DONNEES COMPTABLES & FINANCIAIRES</legend>
    <table>
        <tbody>
        <tr>
                <td><label>Nature Compte :</label></td>
                <td class="disabledbutton">
                    <?php echo $form['id_naturecompte']->renderError() ?>
                    <?php echo $form['id_naturecompte'] ?>
                </td>
                <td><label> Banque</label></td>
                <td class="disabledbutton">
                    <?php echo $form['id_banque']->renderError() ?>
                    <?php echo $form['id_banque'] ?>
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
                    <?php echo $form['compteg']->renderError() ?>
                    <?php echo $form['compteg'] ?>
                </td>
                <td><label>Compte Analytique</label></td>
                <td class="disabledbutton">
                    <?php echo $form['comptean']->renderError() ?>
                    <?php echo $form['comptean'] ?>
                </td>
                <td><label>Assujetti tva</label></td>
                <td class="disabledbutton">
                    <?php echo $form['assujtva']->renderError() ?>
                    <?php echo $form['assujtva'] ?>
                </td>
                <td><label>Fodec</label></td>
                <td class="disabledbutton">
                    <?php echo $form['fodec']->renderError() ?>
                    <?php echo $form['fodec'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Observation</label></td>
                <td colspan="7" class="disabledbutton">
                    <?php echo $form['observation']->renderError() ?>
                    <?php echo $form['observation'] ?>
                </td>
            </tr>

        </tbody>
    </table>
    <?php
    $rib_banques = RibbancaireTable::getInstance()->findByFrsId($form->getObject()->getId());
    ?>
    <table>
        <thead>
            <tr>
                <th>Nature compte</th>
                <th>Banque</th>
                <th>Rib</th>
                <th>Etat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rib_banques as $rib) : ?>

                <tr>
                    <td><?php echo $rib->getRib() ?></td>
                    <td><?php echo $rib->getNaturebanque() ?></td>
                    <td><?php echo $rib->getBanque() ?></td>
                    <td><?php echo $rib->getEtatRib() ?></td>
                    <td>
                        <a ng-click="ValiderCompte(<?php echo $rib->getId() ?>,<?php echo $form->getObject()->getId()?>)" class="btn btn-xs btn-default">
                            <i class="fa fa-plus"></i> Valider compte
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</fieldset>