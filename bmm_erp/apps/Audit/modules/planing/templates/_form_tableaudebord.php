<div id="sf_admin_container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Tableau de Bord de Formation </h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table>
                        <tr>
                            <td>
                                <label>Déterminez l'année du Plan</label>
                            </td>
                            <?php $plaing = PlaningTable::getInstance()->findAll(); ?>
                            <td>
                                <div >
                                    <select id="anneeTableau" class="chosen-select form-control" data-placeholder="Déterminez l'année ">
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
                </fieldset>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-right" onclick="completerTableau()">
                        Voir Tableau de bord de Formation
                    </button>
                    <button id="btnfermer" style="margin-right: 15px" class="btn pull-right" data-dismiss="modal" onclick="annuler()">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    function annuler(){
        $('#my-modaltableau ').removeClass('in');
        $('#my-modaltableau ').css('display', 'none');
        Initilaiser();
    }
    function completerTableau()
    {
          document.location.href = "<?php echo url_for('planing/tableaudebordformation') . '?iddoc=' ?>" + $('#anneeTableau').val();
    }
</script>