<div id="sf_admin_container">
    <h1>Suivi des Règlements</h1>
</div>
<fieldset ng-controller="CtrlFormation" style="margin-bottom: 10px;">
    <table class="table table-bordered table-hover" style="width: 100%">
        <thead style="background: #fef7ec;">
            <tr>
                <th style="width: 1%">N°</th>
                <th style="width: 9%">Formateur</th>
                <th style="width: 9%">Organisme</th>
                <th style="width: 2%">Nbr Jour</th>
                <th style="width: 6%">M.TTC </th>
                <th style="width: 11%">N°BCI</th>
                <th style="width: 11%">N°BCE</th>
                <th style="width: 11%">Facture</th>
                <th style="width: 5%">M.Net.F</th>
                <th style="width: 7%">M.RAS.F</th>
                <th style="width: 8%">Date Paiement</th>
                <th style="width: 5%">N°Ordon. </th>
            </tr>             
        </thead>
        <tbody>
            <?php
            $lg = new Ligneplaning();
            foreach ($listesdocuments as $lignedoc) {
                $lg = $lignedoc;
                ?>
                <tr>
                    <?php if ($lg->getRealise() == "1") { ?>
                        <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                        <td><?php echo $lg->getFormateur()->getNom() ?></td>
                        <td><?php echo $lg->getFournisseur()->getRs() ?></td> 
                        <td><?php echo $lg->getNbrjour() ?></td>
                        <td><?php echo $lg->getMontantttc() ?></td>
                        <td><input type="text" value="" id="numbci_<?php echo $lg->getId() ?>" class="form-control disabledbutton" placeholder="N°BCI"></td>
                        <td><input type="text" value="" id="numbce_<?php echo $lg->getId() ?>" class="form-control disabledbutton" placeholder="N°BCE"></td>
                        <td class="disabledbutton">
                            <?php $mags = Doctrine_Core::getTable('documentachat')->findByIdTypedoc(15); ?>
                            <select id="magfa_<?php echo $lg->getId() ?>" onchange="AffichedetailFacture(<?php echo $lg->getId() ?>)" >
                                <option></option>
                                <?php foreach ($mags as $magFacture) { ?>
                                    <option <?php if ($lg->getIdFacture() == $magFacture->getId()): ?>selected="true"<?php endif; ?> value="<?php echo $magFacture->getId() ?>">
                                        <?php echo $magFacture ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type="text" value="" id="montantfacturenet_<?php echo $lg->getId() ?>" autocomplete="off" class="form-control disabledbutton" placeholder="M.NET.Facture"></td>
                        <td><input type="text" value="" id="montantfactureras_<?php echo $lg->getId() ?>" autocomplete="off" class="form-control disabledbutton" placeholder="M.R.S.Facture"></td>
                        <td><input type="text" value="" id="datepaieement_<?php echo $lg->getId() ?>" autocomplete="off"  class="form-control disabledbutton" placeholder="Date Paiement"></td>
                        <td><input type="text" value="" id="nordenoncement_<?php echo $lg->getId() ?>" class="form-control disabledbutton " placeholder="N° Ordonnancement"</td>
                    </tr>
                <?php } ?>     
            <?php } ?>
            </body>
    </table>
</fieldset>
<fieldset style="width: 100%;">
    <button onclick="document.location.href = '<?php echo url_for('planing/showPlan') . '?iddoc=' . $planing->getId() ?>'" class="btn btn-white btn-success pull-left">
        <i class="ace-icon fa fa-undo bigger-110"></i>Retour au T.B.Execution Plan Définitf</button>
</fieldset>

<div id="zone_affiche_facture"></div>
<script  type="text/javascript">

    function AffichedetailFacture(id)
    {
        if ($('#magfa_' + id).val() != '') {
            $.ajax({
                url: '<?php echo url_for('planing/affichedetailFacture') ?>',
                data: 'idf=' + $('#magfa_' + id).val() +
                        '&idl=' + id,
                success: function (data) {
                    $('#zone_affiche_facture').html(data);
                }
            });
        } else {
            $('#montantfacturenet_' + id).val('');
            $('#montantfactureras_' + id).val('');
            $('#numbce_' + id).val('');
            $('#numbci_' + id).val('');
            $('#nordenoncement_' + id).val('');
            $('#datepaieement_' + id).val('');
        }
    }

</script>