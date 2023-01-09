
            <div style="height: 150px; overflow: auto; " >
                <table class="fancyTable" id="myTable01" >
                    <thead>
                        <tr>
                            <th>Facture</th>
                            <th>Client</th>
                            <th>Compte Comptable</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="height: 15px;"></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i= 0; ?>
                        <?php foreach ($factures as $facture): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $facture->getReference() ?></td>
                                <td style="text-align: center;"><?php echo $facture->getClient()->getRaisonSociale() ?></td>
                                <td style="text-align: center;"><?php echo $facture->getClient()->getCompteComptable() ?></td>

                            </tr>
                            <?php if($facture->getClient()->getCompteComptableId() == null): ?>
                            <?php $i++; ?>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
<?php if($i != 0): ?>
<div style="font-size: 18px; padding: 10px;">Client(s) ne possede(nt) pas de compte Comptable !</div>
<div style="font-size: 18px; padding: 10px;">Voulez-vous affecter de compte comptable et continuez ?</div>
<?php else: ?> 
<div style="font-size: 18px; padding: 10px;">Voulez-vous continuez ?</div>
<?php endif; ?>       


