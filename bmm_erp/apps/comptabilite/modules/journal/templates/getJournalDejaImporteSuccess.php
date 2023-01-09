<?php
$array_code = array();
$i = 0;
foreach ($journal_importe as $j_i) {
    $array_code[$i] = $j_i->getCode();
    $i++;
}
?>


<b style="font-size: 16px;">Journaux Comptables :</b>
<select id="pickList_journal" multiple="multiple" size="8">
    <?php foreach ($journals as $journal) : ?>
        <?php if (!in_array($journal->getCode(), $array_code)): ?>
            <option name="list_journal" value="<?php echo $journal->getId() ?>"><?php echo $journal->getCode() . ' ' . $journal->getLibelle() ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

<?php if ($journal_importe->count() != 0): ?>
    <div class="row" style="margin-top: 15px;">
        <div class="col-xs-12">
            <div class="table-header" style="margin-bottom: 0px;">
                Liste des journaux comptables du dossier : <?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?> / Exercice : <?php echo $exercice->getLibelle(); ?>
            </div>
            <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
                <div style="height: 202px; overflow: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 10%;">Code</th>
                                <th style="width: 65%;">Libellé</th>
                                <th style="text-align: center; width: 25%;">Type Journal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($journal_importe as $j_i): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $j_i->getCode(); ?></td>
                                    <td><?php echo $j_i->getLibelle(); ?></td>
                                    <td style="text-align: center;"><?php echo $j_i->getTypejournal()->getLibelle(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>