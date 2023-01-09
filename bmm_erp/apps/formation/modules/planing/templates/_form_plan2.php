<div id="sf_admin_container" ng-controller="CtrlFormation" ng-init="intiliser()">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Plan Définitif : Suivi des Règlements</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table>
                        <tr>
                            <td><label>Déterminez l'année du Plan</label></td>
                            <td>
                                <div>
                                    <select id="annee2" class="chosen-select form-control" data-placeholder="Déterminez l'année">
                                        <option value=""></option>
                                        <?php $plaing = PlaningTable::getInstance()->findAll(); ?>
                                        <?php foreach ($plaing as $pl): ?>
                                            <option value="<?php echo $pl->getId() ?>"><?php echo $pl->getAnnee() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <label id="label_error" style="margin-top: 15px; color: #C00808; display: none;">Veuillez déterminez l'année du Plan !</label>
                </fieldset>
                <div class="row"></div>
                <br>
                <div class="modal-footer">

                    <button id="btnfermer"  class="btn  pull-right" data-dismiss="modal" onclick="annuler2()">
                        Fermer
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 10px" onclick="voirplan2()">Suivi des Règlements</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function annuler2() {
        $('#my-modalplan2').removeClass('in');
        $('#my-modalplan2').css('display', 'none');
    }
    function voirplan2() {
        if ($('#annee2').val() != '')
            document.location.href = "<?php echo url_for('planing/facturation') . '?iddoc=' ?>" + $('#annee2').val();
        else
            $('#label_error').show();
    }
</script>