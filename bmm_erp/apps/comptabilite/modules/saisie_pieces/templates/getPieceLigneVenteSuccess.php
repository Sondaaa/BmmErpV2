<?php if ($facture_vente != null): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        Détails facture vente : <?php echo trim($facture_vente->getReference()); ?>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form>
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Client :</label>
                                            <div class="mws-form-item">
                                                <input class="large" type="text" value="<?php echo trim($facture_vente->getClient()->getRs()); ?>" readonly="readonly" style="width: 98%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Référence Facture :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo trim($facture_vente->getReference()); ?>" type="text" readonly="readonly" style="width: 95%; text-align: center;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Date :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo date('d/m/Y', strtotime($facture_vente->getDate())); ?>" type="text" readonly="readonly" style="width: 95%; text-align: center;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Date Importation :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo date('d/m/Y', strtotime($facture_vente->getDateimportation())); ?>" type="text" readonly="readonly" style="width: 95%; text-align: center;">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%"></td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Montant HT :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_vente->getTotalht(); ?>" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Montant TVA :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_vente->getTotaltva(); ?>" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Timbre :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_vente->getTimbre(); ?>" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Montant TTC :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_vente->getTotalttc(); ?>" class="large" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>