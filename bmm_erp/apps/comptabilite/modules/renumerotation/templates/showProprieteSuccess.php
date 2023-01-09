<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat" style="padding-right: 12px;">
                <h4 class="widget-title smaller">Pièce n°: <?php echo $piece->getNumero() ?></h4>
                <h4 class="widget-title smaller brown" style="float: right;">Ancien n°: <?php echo $piece->getAnciennumero() ?> ( Rénuméroter Le : <?php echo date('d/m/Y', strtotime($piece->getDaterenumerotation())) ?> )</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <tr>
                                <td style="width: 25%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Journal :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Date :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Série :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Numéro :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 15%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Date Saisie :</label>
                                    </div>
                                </td>
                                <td style="width: 20%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Saisie Par :</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <div class="mws-form-row">
                                        <input id="" type="text" value="<?php echo trim($piece->getJournalcomptable()->getCode()) . ' - ' . $piece->getJournalcomptable()->getLibelle(); ?>" readonly="readonly">
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <input id="date" value="<?php echo date('d/m/Y', strtotime($piece->getDate())) ?>" type="text" >
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-row">
                                        <input type="text" id="serie" value="<?php echo $piece->getNumeroseriejournal()->getPrefixe() ?>" readonly="readonly">
                                    </div>
                                </td>
                                <td style="width: 10%">
                                    <div class="mws-form-row">
                                        <input type="text" id="numero" value="<?php echo $piece->getNumero() ?>" readonly="readonly">
                                    </div>
                                </td>

                                <td style="width: 15%">
                                    <div class="mws-form-row">
                                        <input id="date_saisie" value="<?php echo date('d/m/Y', strtotime($piece->getDateCreation())) ?>" type="text" >
                                    </div>
                                </td>

                                <td style="width: 20%">
                                    <div class="mws-form-row">
                                        <input type="text" id="saisie_par" value="<?php echo $piece->getUtilisateur()->getAgents()->getNomcomplet(); ?>" readonly="readonly">
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

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Détails Pièce</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <table style="margin-bottom: 0px;" class="table table-bordered table-hover">
                        <tr>
                            <td style="width: 50%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Libellé :</label>
                                    <div class="mws-form-item">
                                        <input type="text" disabled="disabled" value="<?php echo $piece->getLibelle() ?>" style="width: 95%">
                                    </div>
                                </div>
                            </td>
                            <?php
                            $solde = $piece->getTotalcredit() - $piece->getTotaldebit();

                            if ($solde == 0) {
                                $nature_solde = 'Soldé';
                            } else {
                                if ($solde > 0) {
                                    $nature_solde = 'Créditeur';
                                } else {
                                    $nature_solde = 'Débiteur';
                                }
                            }
                            ?>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Solde :</label>
                                    <div class="mws-form-item">
                                        <input type="text" disabled="disabled" value="<?php echo number_format(abs($solde), 3, '.', ' '); ?>" style="width: 95%; text-align:right;">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 25%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Nature Solde :</label>
                                    <div class="mws-form-item">
                                        <input type="text" value="<?php echo $nature_solde; ?>" disabled="disabled" style="width: 95%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6" style="text-align: center; padding-top: 40px;">
        <button class="btn btn-sm btn-default" onclick="fermer()">
            <i class="ace-icon fa fa-close bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Fermer</span>
        </button>
        <button class="btn btn-sm btn-success" onclick="showPiece('<?php echo $piece->getId() ?>')">
            <i class="ace-icon fa fa-eye bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Afficher Détails</span>
        </button>
        <a style="cursor: pointer;" target="_blank" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $piece->getId()) ?>" class="btn btn-sm btn-primary">
            <i class="ace-icon fa fa-print bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Imprimer</span>
        </a>
    </div>
    <div class="col-xs-6">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table style="margin-bottom: 0px;" class="table table-bordered table-hover">
                            <tr>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Total Débit :</label>
                                        <div class="mws-form-item">
                                            <input class="align_right" id="total_debit" type="text" disabled="disabled" value="<?php echo $piece->getTotaldebit() ?>">
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Total Crédit :</label>
                                        <div class="mws-form-item">
                                            <input class="align_right" id="total_credit" type="text" disabled="disabled" value="<?php echo $piece->getTotalcredit() ?>">
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Total Solde : </label>
                                        <div class="mws-form-item">
                                            <input class="align_right" id="total_solde" type="text" disabled="disabled" value="<?php echo number_format($piece->getTotaldebit() - $piece->getTotalcredit(), 3, '.', ' ') ?>">
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

<script  type="text/javascript">

    function fermer() {
        $('#form_show_propriete_piece').fadeOut();
        $('#form_liste_piece').delay(500).fadeIn();
    }

    $('input:text').attr('style', 'width: 100%;');

</script>

<style>

    .align_right{text-align: right;}

</style>