<div id="sf_admin_container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Plan Définitif </h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table>
                        <tr>
                            <td><label>Déterminez l'année du Plan</label></td>
                            <td>
                                <div>
                                    <select id="annee" class="chosen-select form-control" data-placeholder="Déterminez l'année">
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
               
                <div class="modal-footer">
                   
                    <button id="btnfermer"  class="btn  pull-right" data-dismiss="modal" onclick="annuler()">
                        Fermer
                    </button>
                     <button type="button" class="btn btn-primary pull-right" style="margin-right: 10px" onclick="voirplan()">Voir Plan Définitif</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function annuler() {
        $('#my-modalplan').removeClass('in');
        $('#my-modalplan').css('display', 'none');
    }
    function voirplan() {
        if ($('#annee').val() != '')
             document.location.href = "<?php echo url_for('planing/showPlan') . '?iddoc=' ?>" + $('#annee').val();
        else
            $('#label_error').show();
    }
</script>