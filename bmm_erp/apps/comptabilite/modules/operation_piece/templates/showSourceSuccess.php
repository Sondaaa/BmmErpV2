<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Pièce comptable (Source) - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat" style="padding-right: 12px;">
                <h4 class="widget-title smaller">Pièce n°: <?php echo $piece->getNumero() ?></h4>
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
                                                <input value="<?php echo number_format($ligne->getMontantdebit(), 3, '.', ' '); ?>" readonly="readonly" type="text" name="ligne_debit" class="align_right">
                                            <?php else: ?>
                                                <input value="" readonly="readonly" type="text" name="ligne_debit">
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="text-align: center;">
                                            <?php if ($ligne->getMontantcredit() != 0): ?>
                                                <input value="<?php echo number_format($ligne->getMontantcredit(), 3, '.', ' '); ?>" readonly="readonly" type="text" name="ligne_credit" class="align_right">
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
        <a class="btn btn-sm btn-default" href="<?php echo url_for('operation_piece/listePieceDuplique') ?>">
            <i class="ace-icon fa fa-file-text-o bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Liste Pièces Dupliqueés</span>
        </a>
        <button class="btn btn-sm btn-purple" onclick="showDupliquee()">
            <i class="ace-icon fa fa-files-o bigger-110"></i>
            <span class="bigger-110 no-text-shadow">Pièces Dupliqueés</span>
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
                                            <input class="align_right" id="total_debit" type="text" disabled="disabled" value="<?php echo number_format($piece->getTotaldebit(), 3, '.', ' '); ?>">
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 33%">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Total Crédit :</label>
                                        <div class="mws-form-item">
                                            <input class="align_right" id="total_credit" type="text" disabled="disabled" value="<?php echo number_format($piece->getTotalcredit(), 3, '.', ' '); ?>">
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

<div class="row" id="liste_piece_dupliquee" style="margin-top: 20px; display: none;">
    <table id="listPiece" class="mws-datatable-fn mws-table">
        <thead>
            <tr>
                <th>Journal Comptable</th>
                <th style="width: 7%; text-align: center;">Date </th>  
                <th style="width: 10%; text-align: center;">Numéro </th>
                <th style="width: 10%; text-align: center;">Série </th> 
                <th style="width: 10%; text-align: center;">Total débit</th>
                <th style="width: 10%; text-align: center;">Total cédit</th>
                <th style="width: 15%; text-align: center;">Utilisateur </th>
                <th style="width: 10%; text-align: center;">Opérations</th>
            </tr>
        </thead>
        <tfoot id="list_piece_pager">
            <tr>
                <td style ="padding: 0px;" colspan ="8">
                    <div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">
                        <div class ="col-xs-12"></div>
                    </div>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($piece->getPiececomptable() as $i => $piece_child): ?>
                <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>">
                    <td style="text-align: left; padding-left: 1%;"><?php echo $piece_child->getJournalcomptable()->getLibelle() ?></td>
                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($piece_child->getDate())) ?></td>
                    <td style="text-align: center;"><?php echo $piece_child->getNumero() ?></td>
                    <td style="text-align: center;"><?php echo $piece_child->getNumeroseriejournal()->getPrefixe() ?></td>
                    <td style="text-align: center;"><?php echo number_format($piece_child->getTotaldebit(), 3, '.', ' '); ?></td>
                    <td style="text-align: center;"><?php echo number_format($piece_child->getTotalcredit(), 3, '.', ' '); ?></td>
                    <td style="text-align: center;">
                        <a class="blue" id="show-option" href="#" title="Saisie Le : <?php echo date('d/m/Y', strtotime($piece_child->getDatecreation())) ?>">
                            <i class="ace-icon fa fa-hand-o-right"></i>
                            <?php echo $piece_child->getUtilisateur() ?>
                        </a>
                    </td>
                    <td style="cursor: pointer; text-align: center;">
                        <span class="btn-group">
                            <a style="cursor: pointer" title="Afficher" href="<?php echo url_for('operation_piece/afficher?id=' . $piece_child->getId()) ?>" target="_blank" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-eye"></i> Afficher</a>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-xs-12" style="text-align: right;">
            <button class="btn btn-sm btn-default" onclick="fermerDupliquee()">
                <i class="ace-icon fa fa-close bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Fermer</span>
            </button>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function showDupliquee() {
        $('#liste_piece_dupliquee').delay(500).fadeIn();
    }

    function fermerDupliquee() {
        $('#liste_piece_dupliquee').fadeOut();
    }

    $('input:text').attr('style', 'width: 100%;');

    $(document).ready(function () {
        //tooltips
        $(".blue").tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
    });

</script>