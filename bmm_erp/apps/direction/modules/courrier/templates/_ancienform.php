<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form" ng-controller="CtrlCourrier" <?php if($form->getObject()->isNew()) {?>ng-init="NumeroCourrier()" <?php } ?>>


    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li <?php if (!isset($_REQUEST['panel'])) echo 'class="active"';
else if (isset($_REQUEST['panel']) && ($_REQUEST['panel'] == 1||$_REQUEST['panel'] == 2)) echo ''; ?> >
                <a href="#dbase" data-toggle="tab" ng-click="ChargerDossier();">Données de base</a>
            </li>
            <li <?php if (!isset($_REQUEST['panel'])) echo '';
else if (isset($_REQUEST['panel']) && $_REQUEST['panel'] == 1) echo 'class="active"'; ?>>
                <a href="#dtransfert" <?php if (isset($_REQUEST['panel']) && $_REQUEST['panel'] == 1) {?> ng-init="ChargerParcour(<?php echo $form->getObject()->getIdType() ?>,<?php echo $form->getObject()->getId() ?>)" <?php } ?> ng-click="ChargerParcour(<?php echo $form->getObject()->getIdType() ?>,<?php echo $form->getObject()->getId() ?>)" data-toggle="tab" class="<?php if ($form->getObject()->isNew()) echo 'disabledbutton' ?>">Données de transfert</a>
            </li>
            <li <?php if (!isset($_REQUEST['panel'])) echo '';
else if (isset($_REQUEST['panel']) && $_REQUEST['panel'] == 2) echo 'class="active"'; ?>>
                <a href="#dged" <?php if (isset($_REQUEST['panel']) && $_REQUEST['panel'] == 2) {?> ng-init="ChargerDocument(<?php echo $form->getObject()->getId() ?>)" <?php } ?>  ng-click="ChargerDocument(<?php echo $form->getObject()->getId() ?>)" data-toggle="tab" class="<?php if ($form->getObject()->isNew()) echo 'disabledbutton' ?>">Documents</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div <?php if (!isset($_REQUEST['panel'])) echo 'class="tab-pane fade  active in"';
else if (isset($_REQUEST['panel']) && ($_REQUEST['panel'] == 1||$_REQUEST['panel'] == 2)) echo 'class="tab-pane fade"'; ?> id="dbase">
                <h4></h4>
                <?php echo form_tag_for($form, '@courrier') ?>
                <?php echo $form->renderHiddenFields(false) ?>
                <input type="hidden" name="idtype" id="typecourrier" value="<?php
                if (isset($_REQUEST['idtype']))
                    echo $_REQUEST['idtype'];
                else
                if (!$form->getObject()->isNew())
                    echo $form->getObject()->getIdType();
                ?>">
<?php if ($form->hasGlobalErrors()): ?>
                    <?php echo $form->renderGlobalErrors() ?>
                <?php endif; ?>
                <input type="hidden" id="iduser" value="<?php echo $sf_user->getAttribute('userB2m')->getId(); ?>" >
                <input type="hidden"  id="objet" value="<?php
                if (!$form->getObject()->isnew())
                    echo "1";
                else
                    echo '0';
                ?>">
                <input type="hidden" id="idcourrierParent" value="<?php
                if ($form->getObject()->isNew() && isset($_REQUEST['id_parent']))
                    echo $_REQUEST['id_parent'];
                else
                    echo "";
                ?>">
                       <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
    <?php include_partial('courrier/form_fieldset', array('courrier' => $courrier, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
<?php endforeach; ?>
<?php include_partial('courrier/form_actions', array('courrier' => $courrier, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
                </form>
            </div>
            <div <?php if (!isset($_REQUEST['panel'])) echo 'class="tab-pane fade"';
else if ( $_REQUEST['panel'] == 1) echo '"class="tab-pane fade  active in"';else if ( $_REQUEST['panel'] == 2) echo 'class="tab-pane fade"'; ?>  id="dtransfert">
                <h4>courrier numéro: <?php if (!$form->getObject()->isNew()) echo $form->getObject()->getNumero(); ?></h4>
                <?php if (!$form->getObject()->isNew()) { ?>
                    <?php
                    $formparcourcourrier = new ParcourcourierForm();

                    $listesparcour = Doctrine_Core::getTable('parcourcourier')->findByIdCourierAndIdUser($form->getObject()->getId(), $sf_user->getAttribute('userB2m')->getId());

                    include_partial('PCourrier/form', array('form' => $formparcourcourrier, 'parcourcouriers' => $listesparcour, 'idtype' => $form->getObject()->getIdType(), 'idcourrier' => $form->getObject()->getId()));
                }
                ?>
            </div>
            <div <?php if (!isset($_REQUEST['panel'])) echo 'class="tab-pane fade"';
else if ( $_REQUEST['panel'] == 2) echo '"class="tab-pane fade  active in"';else if ( $_REQUEST['panel'] == 1) echo 'class="tab-pane fade"'; ?> id="dged">
                <h4>courrier numéro: <?php if (!$form->getObject()->isNew()) echo $form->getObject()->getNumero(); ?></h4>
                <?php if (!$form->getObject()->isNew()) { ?>
                    <?php
                    $id = $form->getObject()->getId();
                    $courrier = $form->getObject();
                    include_partial('Scan/formscan', array('id' => $id, 'courrier' => $courrier));
                }
                ?>
            </div>
        </div>
    </div>



</form>
</div>
<?php
if (($form->getObject()->isNew() && isset($_REQUEST['idtype']) && $_REQUEST['idtype'] == 1) || (!$form->getObject()->isNew() && $form->getObject()->getIdType() == 1)) {
    $courriersource = null;
    if ($form->getObject()->getIdCourrier())
        $courriersource = Doctrine_Core::getTable('courrier')->findOneById($form->getObject()->getIdCourrier());
    $idExp = 36;
    $expediteurExt = Doctrine_Core::getTable('expdest')->findByIdType(8);
    $user = new Utilisateur();
    $user = $sf_user->getAttribute('userB2m');
    $expdest = $user->getExpdestinataire();
    if ($courriersource) {
        if (!$form->getObject()->isNew()) {


            $mouvementcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourierAndIdRec($courriersource->getId(), $expdest->getId());
            if ($mouvementcourrier && $mouvementcourrier->getIdExp()) {
                $idExp = $mouvementcourrier->getIdExp();
                $action = $mouvementcourrier->getActionparcour();
            }
        }
    } else {
        $mouvementcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourierAndIdRec($form->getObject()->getId(), $expdest->getId());

        if ($mouvementcourrier && $mouvementcourrier->getIdExp()) {
            $idExp = $mouvementcourrier->getIdExp();
            $action = $mouvementcourrier->getActionparcour();
        }
    }

    if ($idExp != "36")
        $expediteurExt = Doctrine_Core::getTable('expdest')->findById($idExp);
    ?>

    <td><span>Expéditeur</span></td>
    <td>
        <select name="expdest">

            <?php foreach ($expediteurExt as $expdest) { ?>
                <option <?php if ($idExp == $expdest->getId()) echo 'selected="selected"' ?>  value="<?php echo $expdest->getId(); ?>"><?php echo $expdest ?></option>

            <?php } ?>
        </select>
    </td>
<?php } ?>
<?php
if (($form->getObject()->isNew() && isset($_REQUEST['idtype']) && $_REQUEST['idtype'] == 2) || (!$form->getObject()->isNew() && $form->getObject()->getIdType() == 2)) {
    if ($form->getObject()->getIdCourrier())
        $courriersource = Doctrine_Core::getTable('courrier')->findOneById($form->getObject()->getIdCourrier());
    $idExp = 36;
    $expediteurExt = Doctrine_Core::getTable('expdest')->findByIdFamille(8);
    if (!$form->getObject()->isNew()) {
        $user = new Utilisateur();
        $user =$sf_user->getAttribute('userB2m');
        $expdest = $user->getExpdestinataire();
        if ($courriersource) {
            $mouvementcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourierAndIdRec($courriersource->getId(), $expdest->getId());

            if ($mouvementcourrier && $mouvementcourrier->getIdExp()) {
                $idExp = $mouvementcourrier->getIdExp();
                $action = $mouvementcourrier->getActionparcour();
            }
        } else {
            $mouvementcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourierAndIdRec($form->getObject()->getId(), $expdest->getId());

            if ($mouvementcourrier && $mouvementcourrier->getIdExp()) {
                $idExp = $mouvementcourrier->getIdExp();
                $action = $mouvementcourrier->getActionparcour();
            }
        }
    }
    if ($idExp != "36")
        $expediteurExt = Doctrine_Core::getTable('expdest')->findById($idExp);
    ?>

    <td><span>Expéditeur</span></td>
    <td>
        <select name="expdest">

            <?php foreach ($expediteurExt as $expdest) { ?>
                <option <?php if ($idExp == $expdest->getId()) echo 'selected="selected"' ?>  value="<?php echo $expdest->getId(); ?>"><?php echo $expdest ?></option>

            <?php } ?>
        </select>
    </td>
<?php } ?>