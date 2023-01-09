<div id="sf_admin_container" ng-init="InialiserPopup()">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Nouvelle Fiche Tâche</h3>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td><label>Poste</label></td>
                        <td><?php $magtaches = Doctrine_Core::getTable('posterh')->findAll(); ?>
                            <select id="magTaches">
                                <option></option>
                                <?php foreach ($magtaches as $magT) { ?>
                                    <option value="<?php echo $magT->getId() ?>"><?php echo $magT; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Libelle Tâche </label></td>
                        <td><input type="text" id="libelle"></td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterTache()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>
                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    fermer
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>