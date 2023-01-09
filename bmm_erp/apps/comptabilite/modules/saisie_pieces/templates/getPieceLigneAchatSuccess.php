<?php if ($facture_achat != null): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title smaller">
                        Détails facture achat : <?php echo trim($facture_achat->getReference()); ?>
                    </h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form>
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Fournisseur :</label>
                                            <div class="mws-form-item">
                                                <input class="large" type="text" value="<?php echo trim($facture_achat->getFournisseur()->getRs()); ?>" readonly="readonly" style="width: 98%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Référence Facture :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo trim($facture_achat->getReference()); ?>" type="text" readonly="readonly" style="width: 95%; text-align: center;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Date :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo date('d/m/Y', strtotime($facture_achat->getDate())); ?>" type="text" readonly="readonly" style="width: 95%; text-align: center;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Date Importation :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo date('d/m/Y', strtotime($facture_achat->getDateimportation())); ?>" type="text" readonly="readonly" style="width: 95%; text-align: center;">
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
                                                <input value="<?php echo $facture_achat->getTotalht(); ?>" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Montant TVA :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_achat->getTotaltva(); ?>" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Timbre :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_achat->getTimbre(); ?>" type="text" readonly="readonly" style="width: 95%; text-align: right;">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Montant TTC :</label>
                                            <div class="mws-form-item">
                                                <input value="<?php echo $facture_achat->getTotalttc(); ?>" class="large" type="text" readonly="readonly" style="width: 95%; text-align: right;">
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