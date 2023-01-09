<?php
$action = "";
$idExp = 36;
$user = $sf_user->getAttribute('userB2m');
if (!$form->getObject()->isNew())
    if ($form->getObject()->getIdUser() != null)
        $expdest = $form->getObject()->getUtilisateur()->getExpdestinataire();
    else
        $expdest = $user->getExpdestinataire();
else {
    $expdest = $user->getExpdestinataire();
}
$parameter_exp = Doctrine_Core::getTable('parametreexpedition')->findByIdTypecourrierAndIdDest($idtype, $expdest->getId());
if (!$form->getObject()->isNew()) {
    $mouvementcourrier = Doctrine_Core::getTable('parcourcourier')->findOneByIdCourrierdestAndIdRec($form->getObject()->getId(), $expdest->getId());
    if ($mouvementcourrier && $mouvementcourrier->getIdExp())
        $idExp = $mouvementcourrier->getIdExp();
}
?>
<td><span>Expéditeur</span></td>
<td>
    <div class="col-lg-9">
        <select name="courrier_expdest" id="courrier_expdest">
            <option value="0">Sélectionnez</option>
            <?php foreach ($parameter_exp as $expdest) { ?>
                <option <?php if ($idExp == $expdest->getIdExp()) echo 'selected="selected"' ?>  value="<?php echo $expdest->getIdExp(); ?>"><?php echo $expdest->getExpdest() ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-lg-2">
        <a href="#my-modal" role="button" ng-click="AfficheExpediteur(<?php echo $idtype ?>);" class="btn btn-xs btn-primary" data-toggle="modal">
            <i class="ace-icon fa fa-plus"></i>
        </a>
    </div>
    <div id="my-modal" class="modal fade" tabindex="-1" >
        <div id="sf_admin_container">
            <div class="modal-dialog" style="width: 90%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="smaller lighter blue no-margin">Nouvel expéditeur</h3>
                    </div>
                    <div class="modal-body">
                        <?php
                        $formexp = new ExpdestForm();
                        include_partial('expdest/formlist', array('form' => $formexp, 'idtype' => $idtype, 'type' => 'reception'))
                        ?>

                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                fermer
                            </button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
</td>
<td style="color:#c36017;font-size: 18px; text-align: center;"> <?php echo $action ?> ===>> </td>