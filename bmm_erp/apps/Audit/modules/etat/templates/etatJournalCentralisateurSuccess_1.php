<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat du Journal Centralisateur
        </small>
    </h1>
</div>
<?php
$date_debut = $_SESSION['exercice'] . '-01-01';
$date_fin = $_SESSION['exercice'] . '-12-31';
?>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Etat du Journal Centralisateur - Exercice <?php echo $_SESSION['exercice']; ?>
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("etat/imprimeEtatCentralisateur"); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;">
                <div class="table-wrap">
                    <table id="listBalance" class="mws-datatable-fn mws-table main-table">
                        <thead>
                            <tr>
                                <th colspan="2" class="fixed-side" scope="col">Journal Comptable</th>
                                <?php for ($h = 0; $h < 12; $h++): ?>
                                <th colspan="2" style="text-align: center;">Mouvement Période <br> Du <?php echo date('d/m/Y', strtotime($date_periode[$h]['date_debut'])) ?> Au <?php echo date('d/m/Y', strtotime($date_periode[$h]['date_fin'])) ?></th>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <th style="min-width: 80px;" class="fixed-side" scope="col">Code</th>
                                <th style="min-width: 150px;" class="fixed-side" scope="col">Libellé</th>
                                <?php for ($h = 0; $h < 12; $h++): ?>
                                    <th style="min-width: 110px;">Débit</th>
                                    <th style="min-width: 110px;">Crédit</th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($journals_interval as $journal_interval): ?>
                                <tr style="cursor: pointer;" id="ligne_<?php echo $i; ?>">
                                    <td style="text-align: center;" class="fixed-side" scope="col">
                                        <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . 'id=' . $journal_interval->getId() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin); ?>">
                                            <?php echo $journal_interval->getCode(); ?>
                                        </a>
                                    </td>
                                    <td style="text-align: left;" class="fixed-side" scope="col">
                                        <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . 'id=' . $journal_interval->getId() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin); ?>">
                                            <?php echo $journal_interval->getLibelle(); ?>
                                        </a>
                                    </td>
                                    <?php $count_td = 0; ?>
                                    <?php for ($j = 0; $j < (sizeof($all_etatJournal)); $j++): ?>
                                        <?php $etatJournal = $all_etatJournal[$j]; ?>
                                        <?php for ($i = 0; $i < sizeof($etatJournal); $i++): ?>
                                            <?php if ($etatJournal[$i]['id'] == $journal_interval->getId()): ?>
                                                <?php
                                                $url = '';
                                                $url.= 'id=' . $journal_interval->getId();
                                                $url.= '&date_debut=' . $date_periode[$count_td]['date_debut'];
                                                $url.= '&date_fin=' . $date_periode[$count_td]['date_fin'];
                                                ?>
                                                <td style="text-align: right;">
                                                    <?php if ($etatJournal[$i]['debitMois'] != 0): ?>
                                                        <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url); ?>">
                                                            <?php echo number_format($etatJournal[$i]['debitMois'], 3, '.', ' '); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: right;">
                                                    <?php if ($etatJournal[$i]['creditMois'] != 0) : ?>
                                                        <a target="_blank" href="<?php echo url_for("etat/imprimeJournalSeul?" . $url); ?>">
                                                            <?php echo number_format($etatJournal[$i]['creditMois'], 3, '.', ' '); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <?php $count_td++; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    <?php endfor; ?>
                                    <?php for ($h = $count_td; $h < 12; $h++): ?>
                                        <td></td>
                                        <td></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr style="background: repeat-x #F2F2F2;">
                                <td style="text-align: center; font-weight: bold;" colspan="2" class="fixed-side" scope="col">Total</td>
                                <?php for ($h = 0; $h < 12; $h++): ?>
                                    <td style="text-align: right; font-weight: bold;">
                                        <?php
                                        if ($total_all_etatJournal[$h]['debitMois'] != 0)
                                            echo number_format($total_all_etatJournal[$h]['debitMois'], 3, '.', ' ');
                                        ?>
                                    </td>
                                    <td style="text-align: right; font-weight: bold;">
                                        <?php
                                        if ($total_all_etatJournal[$h]['creditMois'] != 0)
                                            echo number_format($total_all_etatJournal[$h]['creditMois'], 3, '.', ' ');
                                        ?>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .tab_filter tbody td { 
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px ;
    }
    tr:hover{color: #2679b5;}
</style>

<style>

    .table-scroll {
        position:relative;
        max-width:100%;
        margin:auto;
        overflow:hidden;
        width: 100%;
        border:1px solid #fff;
    }
    .table-wrap {
        width:100%;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        padding:5px 10px;
        border:1px solid #000;
        white-space:nowrap;
        vertical-align:top;
    }
    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
    }
    .clone th, .clone td {
        visibility:hidden
    }
    .clone td, .clone th {
        border-color:transparent
    }
    .clone tbody th {
        visibility:visible;
    }
    .clone .fixed-side {
        visibility:visible;
        /*background-color: #fff;*/
        background: repeat-x #F2F2F2;
    }
    .clone thead, .clone tfoot{background:transparent;}

</style>

<script>

    // requires jquery library
    jQuery(document).ready(function () {
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });

</script>