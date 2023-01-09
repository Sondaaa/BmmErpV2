<?php
$user = $sf_user->getAttribute('userB2m');

if (!isset($_SESSION['exercice'])):
    $_SESSION['exercice'] = null;
endif;
?>
<?php if ($_SESSION['exercice'] == null): ?>
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-5 col-xs-push-3">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dossier & exercice comptable courant</h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <form>
                            <!-- <legend>Form</legend> -->
                            <fieldset>
                                <label>Dossier comptable</label>
                                <input type="text" id="dossier_courant" value="<?php echo $dossier->getRaisonsociale() ?>" disabled="true" class="form-control" />
                            </fieldset>

                            <fieldset>
                                <label>Exercice comptable</label>
                                <select class="chosen-select form-control" id="exercice_courant" data-placeholder="Déterminez l'exercice courant">
                                    <option value=""></option>
                                    <?php foreach ($exercices as $exercice): ?>
                                        <option <?php if (date('Y') == $exercice->getLibelle()): ?>selected="true"<?php endif; ?> value="<?php echo $exercice->getId() ?>"><?php echo $exercice->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>

                            <div class="form-actions center">
                                <button type="button" class="btn btn-sm btn-success" onclick="validerDossierCourant()">
                                    Valider
                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script  type="text/javascript">

        function validerDossierCourant() {
            if ($('#exercice_courant').val() != '') {
                $('#exercice_courant').css('border', '');
                $.ajax({
                    url: '<?php echo url_for('@validerDossierCourant') ?>',
                    data: 'exercice_id=' + $('#exercice_courant').val(),
                    success: function (data) {
                        document.location.reload();
                    }
                });
            } else {
                if ($('#exercice_courant').val() == '') {
                    $('#exercice_courant_chosen').css('border', '3px solid #e65454');
                    $('#exercice_courant_chosen').css('border-radius', '6px');
                }
            }
        }

    </script>
<?php endif; ?>