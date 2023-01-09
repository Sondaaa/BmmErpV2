<div id="sf_admin_container">
    <h1 id="replacediv"> Traitement
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Recherche Multicritères - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Type de Recherche</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-6">
                            <table style="margin-bottom: 10px;">
                                <tr>
                                    <td>
                                        <select id="filtre_all" onchange="getFiltre()">
                                            <option value=""></option>
                                            <option value="date_piece">Date pièce</option>
                                            <option value="date_saisie">Date de saisie</option>
                                            <option value="date_modification">Date de modification</option>
                                            <option value="montant">Montant</option>
                                            <option value="libelle">Libellé pièce comptable</option>
                                            <option value="numero_piece">Numéro pièce comptable</option>
                                            <option value="numero_externe"> N° externe document</option>
                                            <option value="reference">Référence document</option>
                                            <option value="journal">Période Journal comptable</option>
                                            <option value="compte">Compte comptable</option>
                                            <!--<option value="devise">Devise</option>-->
                                            <option value="sens">Sens(Débit /Crédit)</option>
                                            <option value="user">Utilisateur</option>
                                            <option value="piece_nonvalide">Pièce comptable non validé</option>
                                        </select>
                                    </td> 
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div id="zone_recherche" class="col-xs-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12" style="margin-top:20px;" id="liste_recherche">

    </div>
</div>

<script  type="text/javascript">

    function getFiltre() {
        if ($('#filtre_all').val() != '') {
            $.ajax({
                url: '<?php echo url_for('multicriteres/getFiltreMulticritere') ?>',
                data: 'filtre=' + $('#filtre_all').val(),
                success: function (data) {
                    $('#zone_recherche').html(data);
                    $('#liste_recherche').html('');
                }
            });
        }
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Recherche Multicritères");
</script>