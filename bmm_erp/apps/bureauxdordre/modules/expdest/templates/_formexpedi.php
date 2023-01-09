<fieldset class="col-lg-12">
    <div class="col-lg-12">
        <div class="col-lg-6 pull-left">
            <fieldset><legend>Liste des Destinataires  </legend>

                <table id="dynamic-table" style="width: 100%">
                    <thead>
                        <tr> 
                            <th style="width: 2%;"><input type="checkbox" id="selecte_all_compte" class="disabledbutton"></th>
                            <th>Nom responsable</th>               

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (($idtype == 2 || $idtype == 1) || ($idtype == 3 && $type == "envoi") || ($idtype == 4 && $type == "reception")):
//                    $listes = Doctrine_Query::create()
//                                    ->select("*")
//                                    ->from('expdest')
//                                    ->where('id_frs is null and id_agent is not null')->execute();
                            $listes = Doctrine_Query::create()
                                            ->select("*")
                                            ->from('expdest')
                                            ->where('id_frs is not null OR id_agent is null')->execute();
                            $exp = new Expdest();
                            foreach ($listes as $l):
                                $exp = $l;
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="list_checbox_facture"
                                               idientifiant="<?php echo $exp->getId() ?>"  id="check_<?php echo $exp->getId() ?>"
                                               ng-click="AjouterParameterExp(<?php echo $exp->getId() ?>,<?php echo $idtype ?>, '<?php echo $type ?>', '0')"></td>
                                    <td><?php echo $exp ?></td>

                                </tr>
                                <?php
                            endforeach;
                            $famille_expediteur = FamexpdesTable::getInstance()->getForTransfert();
                            ?>
                            <?php foreach ($famille_expediteur as $famille): ?>
                                <tr>
                                    <td><input type="checkbox"  class="list_checbox_facture"
                                               ng-click="AjouterParameterExp(<?php echo $famille->getId() ?>,<?php echo $idtype ?>, '<?php echo $type ?>', '1')"></td>
                                    <td><?php echo $famille ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php
                        if (($idtype == 3 && $type == "reception") || ($idtype == 4 && $type == "envoi")):
                            $listes = Doctrine_Query::create()
                                            ->select("*")
                                            ->from('expdest')
                                            ->where('id_agent is null ')->execute();
                            $exp = new Expdest();
                            foreach ($listes as $l):
                                $exp = $l;
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="list_checbox_facture" ng-click="AjouterParameterExp(<?php echo $exp->getId() ?>,<?php echo $idtype ?>, '<?php echo $type ?>', '0')"></td>
                                    <td><?php echo $exp->getNpresponsable() . ' ' . $exp->getFournisseur() ?></td>

                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </div> 
        <div class="col-lg-6 pull-right">

            <fieldset><legend>Nouveau Destinataire</legend>
                <table class="table  table-bordered table-hover"  style="width: 100%;margin-top: 20px">
                    <tr>
                        <td>
                            <label>Famille Destinataire</label>
                            <?php echo $form['id_famille'] ?>
                        </td>
                        <td>
                            <label>Type Destinataire</label>
                            <?php echo $form['id_type'] ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if (($idtype == 3 && $type == "reception") || ($idtype == 4 && $type == "envoi")): ?>
                            <td>
                                <label>Fournisseur</label>
                                <?php echo $form['id_frs'] ?>
                            </td>
                        <?php endif; ?>
                        <?php if (($idtype == 2 || $idtype == 1) || ($idtype == 3 && $type == "envoi") || ($idtype == 4 && $type == "reception")): ?>
                            <td>
                                <label>Agent concerné</label>
                                <?php echo $form['id_agent'] ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom et Prénom du responsable</label>
                            <?php echo $form['npresponsable'] ?>
                        </td>
                    </tr>
                </table>

            </fieldset>
            <button class="btn btn-sm btn-success pull-right" data-dismiss="modal" ng-click="AjouterExpediteur(<?php echo $idtype ?>, '<?php echo $type ?>')">
                <i class="ace-icon fa fa-save"></i>
                Valider
            </button>
        </div>  
    </div>

</fieldset>

<script>

//            $('#selecte_all_compte').change(function () {
//
//    $('#loading_select_icon').fadeIn();
//            if ($('#selecte_all_compte').is(':checked')) {
//
//    $('.list_checbox_facture[type=checkbox]:checked').each(function () {
//    var id = $(this).attr('idientifiant');
//            $('#check_' + id).prop("checked", true);
//    });
//    }
//    }
</script>
<style>
    .table{margin-bottom: 2px;}
</style>