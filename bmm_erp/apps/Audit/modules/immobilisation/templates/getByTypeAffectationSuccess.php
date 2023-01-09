<?php
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = "SELECT immobilisation.id, numero, designation, dateacquisition, mntttc, famille.famille, sousfamille.sousfamille"
        . " FROM immobilisation, famille, sousfamille "
        . " WHERE id_typeaffectationimmo = " . $id . " "
        . " AND immobilisation.id_famille = famille.id "
        . " AND immobilisation.id_sousfamille = sousfamille.id "
        . " ORDER BY designation, numero";
$immobilisations = $conn->fetchAssoc($query);
?>
<?php $type = TypeaffectationimmoTable::getInstance()->find($id); ?>
<div class="row">
    <div class="col-sm-12" style="margin-top: 20px;">
        <legend>
            Liste des Immobilisations / Type Affectation : <span style="color: #bd4242;"><?php echo $type; ?></span>
            <?php if (sizeof($immobilisations) > 0): ?>
                <a style="float: right; margin-top: -4px;" href="<?php echo url_for('immobilisation/printListeType?id=' . $id) ?>" target="_blank" class="btn btn-white btn-primary"><i class="ace-icon fa fa-print"></i> Imprimer</a>
            <?php endif; ?>
        </legend>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <table id="table_immobilisation" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:4%;text-align:center;">#</th>
                    <th style="width:6%;text-align:center;"><b>Numéro</b></th>
                    <th style="width:29%;height:25px;text-align:center;"><b>Immobilisation</b></th>
                    <th style="width:8%;text-align:center;"><b>Date Acquisition</b></th>
                    <th style="width:8%;text-align:center;"><b>Prix Acquisition</b></th>
                    <th style="width:24%;text-align:center;"><b>Famille</b></th>
                    <th style="width:21%;text-align:center;"><b>Sous Famille</b></th>
                </tr>
            </thead>
            <tbody id="tblData">
                <?php if (sizeof($immobilisations) > 0): ?>
                    <?php for ($i = 0; $i < sizeof($immobilisations); $i++): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $i + 1; ?></td>
                            <td style="text-align: center;"><?php echo $immobilisations[$i]['numero'] ?></td>
                            <td>
                                <a target="_blank" href="<?php echo url_for('Immob/show?id=' . $immobilisations[$i]['id']) ?>">
                                    <?php echo $immobilisations[$i]['designation'] ?>
                                </a>
                            </td>
                            <td style="text-align: center;"><?php if ($immobilisations[$i]['dateacquisition'] != null) echo date('d/m/Y', strtotime($immobilisations[$i]['dateacquisition'])); ?></td>
                            <td style="text-align: right;"><?php if ($immobilisations[$i]['mntttc'] != null) echo number_format($immobilisations[$i]['mntttc'], 3, '.', ' ') ?></td>
                            <td><?php echo $immobilisations[$i]['famille'] ?></td>
                            <td><?php echo $immobilisations[$i]['sousfamille'] ?></td>
                        </tr>
                    <?php endfor; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; vertical-align: middle; height: 60px;">Pas d'immobilisation à valider !</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr>
    </div>
    <?php if (sizeof($immobilisations) > 0): ?>
        <div class="col-sm-12" style="text-align: right;">
            <a href="<?php echo url_for('immobilisation/printListeType?id=' . $id) ?>" target="_blank" class="btn btn-white btn-primary"><i class="ace-icon fa fa-print"></i> Imprimer</a>
        </div>
    <?php endif; ?>
</div>