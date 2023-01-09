<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Pièce comptable - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat" style="padding-right: 12px;">
                <h4 class="widget-title smaller">Pièce n°: <?php echo $piece->getNumero() ?></h4>
                <?php if ($piece->getIdPiecesource() != ''): ?>
                    <?php $piece_source = PiececomptableTable::getInstance()->find($piece->getIdPiecesource()); ?>
                    <h4 class="widget-title smaller brown" style="float: right;">Pièce Source n°: <?php echo $piece_source->getNumero() ?> ( Date : <?php echo date('d/m/Y', strtotime($piece_source->getDatecreation())) ?> )</h4>
                <?php endif; ?>
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
                                            <input id="date" value="<?php echo date('Y-m-d', strtotime($piece->getDate())) ?>" type="date" readonly="true">
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
                                        <input id="date_saisie" value="<?php echo date('Y-m-d', strtotime($piece->getDateCreation())) ?>" type="date" readonly="true">
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
                    <form>
                        <table style="margin-bottom: 10px;" class="table table-bordered table-hover">
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
                    </form>
                    <table style="margin-bottom: 0px;" class="table table-bordered table-hover">
                        <thead>
                            <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                <th>N°</th>
                                <th>Numéro du Compte</th>
                                <th>Débit</th>
                                <th>Crédit</th>
                                <th>Contre Partie</th>
                                <th>Nature</th>
                                <th>N° Externe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php $lignes = LignepiececomptableTable::getInstance()->getByPieceInOrderSaisie($piece->getId()); ?>
                            <?php foreach ($lignes as $ligne): ?>
                                <tr>
                                    <td name="col_number" style="text-align:center"><?php echo $i + 1; ?></td>
                                    <td>
                                        <div class="mws-form-row" style="text-align: left;">
                                            <?php echo $ligne->getPlandossiercomptable()->getPlancomptable()->getNumerocompte() . " : " . $ligne->getPlandossiercomptable()->getPlancomptable()->getLibelle(); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <?php if ($ligne->getMontantdebit() != 0): ?>
                                                <input value="<?php echo $ligne->getMontantdebit(); ?>" readonly="readonly" type="text" name="ligne_debit" class="align_right">
                                            <?php else: ?>
                                                <input value="" readonly="readonly" type="text" name="ligne_debit">
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <?php if ($ligne->getMontantcredit() != 0): ?>
                                                <input value="<?php echo $ligne->getMontantcredit(); ?>" readonly="readonly" type="text" name="ligne_credit" class="align_right">
                                            <?php else: ?>
                                                <input value="" readonly="readonly" type="text" name="ligne_credit">
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mws-form-row" style="text-align: left;">
                                            <?php
                                            if ($ligne->getIdContrepartie() != null)
                                                echo $ligne->getPlandossiercomptablecontre()->getPlancomptable()->getNumerocompte() . " : " . $ligne->getPlandossiercomptablecontre()->getPlancomptable()->getLibelle();
                                            ?>
                                        </div>
                                    </td>
                                    <td style="text-align:center">
                                        <?php
                                        if ($ligne->getIdNaturepiece() != null)
                                            echo $ligne->getNaturepiece()->getLibelle();
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php echo $ligne->getNumeroexterne(); ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6" style="text-align: center; padding-top: 40px;">
        <a class="btn btn-sm btn-default" href="<?php echo url_for('@listePiece') ?>">
            <i class="ace-icon fa fa-file-text-o bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Liste Pièces Comptables</span>
        </a>
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

    $('input:text').attr('style', 'width: 100%;');

</script>