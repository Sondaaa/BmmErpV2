datecorespondanse<div>
    <fieldset>
        <legend>Données de base </legend>
        <div class="col-xs-9">
            <table >
                <tr>
                    <td><span>Date de Création</span></td>
                    <td><?php echo $form['datecreation']->renderError() ?>
                        <?php echo $form['datecreation']->render(array('class' => 'form-control ')) ?></td>
                    <td><span>Numéro</span></td>
                    <?php
                    $idtype = "";
                    $user = $sf_user->getAttribute('userB2m');
                    if (isset($_REQUEST['idtype'])) {
                        $idtype = $_REQUEST['idtype'];
                    }
                    if (!$form->getObject()->isNew()) {
                        $idtype = $form->getObject()->getIdType();
                    }
                    if ($idtype != "") {
                        $type = Doctrine_Core::getTable('typecourrier')->findOneById($idtype);
                        ?> 
                        <td style="width: 60px;border: none;"><input type="text" class="form-control disabledbutton" value="<?php echo $type->getPrefix() ?>" style="width: 60px">
                        </td>  <?php } ?>
                    <td><input type="text" class="form-control disabledbutton" value="<?php echo $user->getId() ?>" style="width: 60px"></td>
                    <td ><?php echo $form['numero']->renderError() ?>

                        <?php echo $form['numero']->render(array('class' => 'form-control disabledbutton', "style" => "width: 100px")) ?></td>

                </tr>
                <tr>
                    <td><span>Numéro Correspondance</span></td>
                    <td><?php echo $form['numeroseq']->renderError() ?>
                        <?php echo $form['numeroseq'] ?></td>
                </tr>
            </table>
            <table >
                <tr>
                    <?php include_partial('courrier/exppartype', array('form' => $form, 'idtype' => $idtype)) ?>

                    <td><span>Utilisateur && Bureau</span></td>
                    <td ><?php echo $form['id_user']->renderError() ?>
                        <?php echo $form['id_user']->render(array('class' => 'form-control disabledbutton')) ?>
                        <?php echo $form['id_bureaux']->renderError() ?>
                        <?php echo $form['id_bureaux']->render(array('class' => 'form-control disabledbutton')) ?>
                    </td>







                </tr>
                <tr>
                    <td><span>Type</span></td>
                    <td ><?php echo $form['id_type']->renderError() ?>
                        <?php echo $form['id_type']->render(array('class' => 'form-control disabledbutton')) ?></td>
                    <td><span>Réference Courrier</span></td>
                    <td colspan="2"><?php echo $form['referencecourrier']->renderError() ?>
                        <?php echo $form['referencecourrier']->render(array('class' => 'form-control')) ?></td>
                </tr>
                <tr>
                    <td><span>Mode ENV.||REC.</span></td>
                    <td><?php echo $form['id_mode']->renderError() ?>
                        <?php echo $form['id_mode'] ?></td>
                    <td><span>Date Correspondance </span></td>
                    <td colspan="2">
                        <?php echo $form['datecorespondanse']->renderError() ?>
                        <?php if (!$form->getObject()->isNew()) { ?>
                            <?php echo $form['datecorespondanse']->render(array('value' => trim($form->getObject()->getDatecorespondanse()))) ?>
                        <?php } else { ?>
                            <?php echo $form['datecorespondanse'] ?>
                        <?php } ?>
                    </td>

                </tr>
                <tr>

                    <td><span>Type d'envoi</span></td>
                    <td colspan="4"><?php echo $form['id_typeparamcourrier']->renderError() ?>
                        <?php echo $form['id_typeparamcourrier']->render(array('class' => 'form-control')) ?></td>

                </tr>

            </table>
        </div>
        <div class="col-xs-3 <?php if ($form->getObject()->isNew()) echo "disabledbutton"; ?>" >
            <table>
                <tr>
                    <td colspan="2"><span>Notes Courrier</span></td>
                </tr>
                <?php
                $listesnotes = Doctrine_Core::getTable('famillecourrier')->findAll();
                foreach ($listesnotes as $note) {
                    ?>
                    <tr>
                        <td><?php echo $note ?></td>
                        <td><input <?php if (!$form->getObject()->isNew() && $form->getObject()->getIdFamille() == $note->getId()) echo 'checked="checked" '; ?>  type="checkbox" id="id_note<?php echo $note->getId(); ?>" ng-click="AffecterNoteCourrier(<?php echo $note->getId(); ?>,<?php if (!$form->getObject()->isNew()) echo $form->getObject()->getId(); ?>)" ></td>
                    </tr>
                <?php } ?>
            </table>
            <div style="display: none">
                <?php echo $form['id_famille']; ?>
            </div>
        </div>


    </fieldset>
    <fieldset>
        <legend>Corps du Courrier </legend>

        <ul class="nav nav-tabs">
            <?php if ($form->getObject()->getCourriersource()) { ?>
                <li>
                    <a href="#donneessources" data-toggle="tab" >Données Sources</a>
                </li>
            <?php } ?>
            <li  >
                <a href="#donneescontenue"  class="active" data-toggle="tab" >Contenu </a>
            </li>

        </ul>
        <div class="tab-content">
            <?php if ($form->getObject()->getCourriersource()) { ?>
                <div  id="donneessources" class="tab-pane fade" style="padding: 2%">
                    <?php $courriersource = $form->getObject()->getCourriersource(); ?>
                    <table>
                        <tr>
                            <td><span>Titre</span></td>
                            <td><?php echo $courriersource->getTitre() ?></td>
                            <td><span>Object</span></td>
                            <td ><?php echo $courriersource->getObject() ?></td>

                        </tr>

                        <tr>
                            <td><span>Sujet</span></td>
                            <td colspan="2" ><?php echo $courriersource->getSujet() ?></td>


                        </tr>
                        <tr>
                            <td><span>Description du courrier</span></td>
                            <td colspan="3"><?php echo html_entity_decode($courriersource->getDescription()) ?></td>


                        </tr>

                    </table>
                    <table>

                        <tr>
                            <?php
                            $piecejoints = Doctrine_Core::getTable('piecejoint')->findByIdCourrier($courriersource->getId());
                            foreach ($piecejoints as $piecejoint):
                                ?>
                                <td><a style="border: none;background-color: none;"  target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">
                                        <?php echo $piecejoint->getChemin() ?>
                                    </a></td>
                            <?php endforeach; ?>

                        </tr>

                    </table>
                </div>
            <?php } ?>
            <div  id="donneescontenue" class="tab-pane fade  active in" style="padding: 2%">
                <table>
                    <tr>
                        <td><span>Titre</span></td>
                        <td><?php echo $form['titre']->renderError() ?>
                            <?php echo $form['titre']->render(array('class' => 'form-control')) ?></td>
                        <td><span>Object</span></td>
                        <td ><?php echo $form['object']->renderError() ?>
                            <?php echo $form['object']->render(array('class' => 'form-control')) ?></td>

                    </tr>

                    <tr>
                        <td><span>Sujet</span></td>
                        <td colspan="2" ><?php echo $form['sujet']->renderError() ?>
                            <?php echo $form['sujet']->render(array('class' => 'form-control')) ?></td>


                    </tr>
                    <tr>
                        <td><span>Description du courrier</span></td>
                        <td colspan="3"><?php echo $form['description']->renderError() ?>
                            <?php echo $form['description']->render(array('class' => 'form-control')) ?></td>


                    </tr>

                </table>

            </div>

        </div>


    </fieldset>
</div>
<style>

    td>span{
        color: #740808;
        font-size: small;
        font-style: italic;
    }

</style>


