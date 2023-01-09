<div id="sf_admin_container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Suivi Consommation des Congés Annuel Inividuel</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table>
                        <tr>
                            <td><label>Déterminez l'agents </label></td>
                            <td>
                                <div>
                                    <select id="id_agents" class="chosen-select form-control" data-placeholder="Déterminez l'agents">
                                        <option value=""></option>
                                        <?php
                                        $query = " SELECT DISTINCT agents.id as id,"
                                                . " concat( agents.nomcomplet , agents.prenom , agents.idrh) as nom  "
                                                . " from agents,conge"
                                                . " where conge.id_agents=agents.id ";
                                        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                                        $conge = $conn->fetchAssoc($query);
                                        ?>
                                        <?php for ($i = 0; $i < sizeof($conge); $i++): ?>
                                            <option value="<?php echo $conge[$i]['id']; ?>"><?php echo $conge[$i]['nom']; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-right" onclick="suiviannuelleindivudielle()"> Suivi Consommation du Congé</button>
                    <button id="btnfermer" style="margin-right: 15px" class="btn  pull-right" data-dismiss="modal" onclick="annuler21()">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    function annuler21() {
        $('#my-modalTB').removeClass('in');
        $('#my-modalTB').css('display', 'none');
        $('#id_agents').val('');
    }
    function suiviannuelleindivudielle() {
        if ($('#id_agents').val() != '') {
            document.location.href = "<?php echo url_for('conge/suivicongeindividuelle') . '?iddoc=' ?>" + $('#id_agents').val();
        }
        else
            $('#label_error').show();
    }
</script>