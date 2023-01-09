<fieldset>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $user = $sf_user->getAttribute('userB2m');
    ?>
    <input type="hidden" id="idmarche" value="<?php
    if (!$form->getObject()->isNew())
        echo $form->getObject()->getId();
    else
        echo '';
    ?>"
</fieldset>
<div class="col-sm-12">
    <div class="tabbable tabs-left">
        <ul class="nav nav-tabs" id="myTab3">
            <li class="active">
                <a data-toggle="tab" href="#home3">
                    Fiche Marché
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#profile3" ng-click="InialiserCampsFianancement()" >
                    Financement
                </a>
            </li>
            <?php
            if (!$form->getObject()->isNew() && $form->getObject()->getNbrebinificaire()) {
                $nbrlot = $form->getObject()->getNbrebinificaire();
                for ($i = 1; $i <= $nbrlot; $i++) {
                    ?>
                    <li>
                        <a data-toggle="tab" href="#<?php echo "lot" . $i ?>" ng-click="AfficheLot(<?php echo $i ?>)">
                            Bénéficiaire <?php echo $i ?>
                        </a>
                    </li> 
                    <?php
                }
            }
            ?>
        </ul>

        <div class="tab-content">
            <div id="home3" class="tab-pane in active <?php if (!$user->getAcceesDroit("formulaire marches")) echo "disabledbutton" ?>" >
                <fieldset >
                    <legend>Identification du responsable des marchés Publics</legend>
                    <table >
                        <tbody>
                            <tr>
                                <td ><label>Acheteur Public</label></td>
                                <td colspan="3">
                                    <input type="text" class="form-control disabledbutton" value="<?php echo $societe ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Responsable cellule des marchés</label></td>
                                <td colspan="2">
                                    <input type="hidden" id="iduser" value="<?php echo $user->getId() ?>">
                                    <?php echo $form['id_user']->renderError() ?>
                                    <?php echo $form['id_user'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td ><label>Tél</label></td>
                                <td>
                                    <input type="text" class="form-control disabledbutton" value="<?php echo $societe->getTel() ?>">
                                </td>
                                <td ><label>Fax</label></td>
                                <td>
                                    <input type="text" class="form-control disabledbutton" value="<?php echo $societe->getFax() ?>">
                                </td>
                            </tr>
                            <tr>
                                <td ><label>E-mail</label></td>
                                <td>
                                    <input type="text" class="form-control disabledbutton" value="<?php echo $societe->getMail() ?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </fieldset>
                <fieldset>
                    <legend>Information sur le marché</legend>
                    <table >
                        <tbody>
                            <tr>
                        <input type="hidden" id="iddocumentachat" value="<?php
                        if (isset($_REQUEST['iddoc']))
                            echo $_REQUEST['iddoc'];
                        else if (!$form->getObject()->isNew())
                            echo $form->getObject()->getIdDocumentachat();
                        else
                            echo '';
                        ?>">
                        <td><label>Bon de commande interne Marchés Public</label></td>
                        <td>
                            <?php echo $form['id_documentachat']->renderError() ?>
                            <?php echo $form['id_documentachat'] ?>
                        </td>
                        <td ><label>Projet</label></td>
                        <td colspan="3">
                            <?php echo $form['id_projet']->renderError() ?>
                            <?php echo $form['id_projet'] ?>
                        </td>
                        </tr>
                        <tr>
                            <td><label>Fournisseur</label></td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <?php echo $form['id_frs']->renderError() ?>
                                            <?php echo $form['id_frs'] ?> 
                                        </td>
                                        <td>
                                            <a href="#my-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
                                                &nbsp; + &nbsp;
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td ><label>date création fiche marché</label></td>
                            <td>
                                <?php echo $form['datecreation']->renderError() ?>
                                <?php echo $form['datecreation'] ?>
                            </td>
                            <td ><label>Numéro fiche marché</label></td>
                            <td colspan="2">
                                <?php echo $form['numero']->renderError() ?>
                                <?php echo $form['numero']->render(array('value' => $marches->NumeroSeqMarches(), 'class' => 'disabledbutton')) ?>
                            </td>
                        </tr>
                        <tr>
                            <td ><label>Nature du Marché</label></td>
                            <td >
                                <?php echo $form['id_nature']->renderError() ?>
                                <?php echo $form['id_nature'] ?> 
                            </td>

                            <td ><label>Délai contractuel (Délai par Jour)</label></td>
                            <td>
                                <?php echo $form['delai']->renderError() ?>
                                <?php echo $form['delai'] ?> 
                            </td>
                        </tr>
                        <tr>
                            <td ><label>Procédure de passation</label></td>
                            <td>
                                <?php echo $form['id_passaction']->renderError() ?>
                                <?php echo $form['id_passaction'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td ><label>Marché réservé au PME</label></td>
                            <td>
                                <?php echo $form['mrpme']->renderError() ?>
                                <?php echo $form['mrpme'] ?> 
                            </td>
                            <td ><label>Nombre de LOTS</label></td>
                            <td>
                                <?php echo $form['nbrelot']->renderError() ?>
                                <?php echo $form['nbrelot'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td ><label>Titulaire du marché</label></td>
                            <td>
                                <?php echo $form['titulaire']->renderError() ?>
                                <?php echo $form['titulaire'] ?> 
                            </td>
                            <td ><label>Nombre de Bénificiaires</label></td>
                            <td>
                                <?php echo $form['nbrebinificaire']->renderError() ?>
                                <?php echo $form['nbrebinificaire'] ?>
                            </td>


                        </tr>
                        <tr>

                            <td ><label>Objet du Marché</label></td>
                            <td colspan="6">
                                <?php echo $form['object']->renderError() ?>
                                <?php echo $form['object'] ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td ><label>Montant Global TTC</label></td>
                                <td colspan="4">
                                    <?php echo $form['mntttc']->renderError() ?>
                                    <?php echo $form['mntttc'] ?>
                                </td>
                            </tr>
                            <tr>

                                <td ><label>Cautionnement définitif%</label></td>
                                <td >
                                    <?php echo $form['cautionement']->renderError() ?>
                                    <?php echo $form['cautionement'] ?>
                                </td>
                                <td ><label>Retenue de garantie%</label></td>
                                <td >
                                    <?php echo $form['retenuegaraentie']->renderError() ?>
                                    <?php echo $form['retenuegaraentie'] ?>
                                </td>

                            </tr>
                            <tr>
                                <td ><label>Avance%</label></td>
                                <td >
                                    <?php echo $form['avance']->renderError() ?>
                                    <?php echo $form['avance'] ?>
                                </td>
                                <td ><label>Pénalité de RETARD%/Jour</label></td>
                                <td >
                                    <?php echo $form['penalite']->renderError() ?>
                                    <?php echo $form['penalite'] ?>
                                </td>
                            </tr>
                            <tr>

                                <td ><label>Max Pénalité de RETARD%</label></td>
                                <td >
                                    <?php echo $form['maxpinalite']->renderError() ?>
                                    <?php echo $form['maxpinalite'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <?php include_partial('marches/form_actions', array('marches' => $marches, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
            </div>

            <div id="profile3" class="tab-pane <?php if (!$user->getAcceesDroit("formulaire budget")) echo "disabledbutton" ?> ">

                <?php
                $formf = new FinancementForm();
                $financement = $formf->getObject();
                include_partial('financement/form', array('financement' => $financement, 'form' => $formf))
                ?>

            </div>
            <?php
            if (!$form->getObject()->isNew() && $form->getObject()->getNbrebinificaire()) {
                $nbrlot = $form->getObject()->getNbrebinificaire();
                for ($i = 1; $i <= $nbrlot; $i++) {
                    ?>
                    <div id="<?php echo "lot" . $i ?>" class="tab-pane <?php if (!$user->getAcceesDroit("formulaire marches")) echo "disabledbutton" ?> ">

                        <?php
                        $formlot = new LotsForm();
                        $lots = $formlot->getObject();
                        include_partial('lots/form_fieldset', array('lots' => $lots, 'form' => $formlot, 'lot' => $i))
                        ?>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</div><!-- /.col -->

<div id="my-modal" class="modal fade" tabindex="-1">
    <?php
    include_partial('fournisseur/form_frs', array());
    ?>
</div>