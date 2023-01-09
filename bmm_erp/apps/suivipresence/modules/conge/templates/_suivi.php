<div id="sf_admin_container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Suivi Consommation du Congé Individuel</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table>
                        <tr>
                            <td style="width: 20%"><label>Déterminez l'agents </label></td>
                            <td>
                                <div>
                                    <select id="conge" class="chosen-select form-control" data-placeholder="Déterminez l'agents">
                                        <option value=""></option>
                                        <?php $conge = CongeTable::getInstance()->findAll(); ?>
                                        <?php foreach ($conge as $pl): ?>
                                            <option value="<?php echo $pl->getId() ?>"><?php echo $pl->getAnnee()." - " .$pl->getAgents()->getNomcomplet() . " " . $pl->getAgents()->getPrenom()."-".  $pl->getTypeconge()->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <label id="label_error" style="margin-top: 15px; color: #C00808; display: none;">Veuillez déterminez le demandeur du congé</label>
                </fieldset>
                <br>
                <div class="modal-footer">
                    
                    <button id="btnfermer"  class="btn  pull-right" data-dismiss="modal" onclick="annuler()">
                        Fermer
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 10px" onclick="suivi()"> Suivi Consommation du Congé</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function annuler() {
        $('#my-modalsuivi').removeClass('in');
        $('#my-modalsuivi').css('display', 'none');
    }
    function suivi() {
        if ($('#conge').val() != '')
            document.location.href = "<?php echo url_for('conge/suiviconge') . '?iddoc=' ?>" + $('#conge').val();
        else
            $('#label_error').show();
    }
</script>