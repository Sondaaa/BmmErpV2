<table class="table table-bordered table-hover">
    <thead>
        <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
            <th style="width: 10%; text-align: center;">Ordonnance</th>
            <th style="width: 10%; text-align: center;">date</th>
            <th style="width: 10%; text-align: center;">Montant</th>
            <th style="width: 25%; text-align: center;">Compte Bancaire / CCP</th>
            <th style="width: 10%; text-align: center;">Ordonnance sujet R.S</th>
            <th style="width: 10%; text-align: center;">Retenue à la Source</th>
            <th style="width: 5%; text-align: center;">Taux R.S</th>
            <th style="width: 20%; text-align: center;">Fournisseur</th>
        </tr>
    </thead>
    <tbody>
            <?php foreach ($ordonnances as $ordonnance): ?>
                <?php
                $ordonnance_parent = DocumentbudgetTable::getInstance()->find($ordonnance->getIdDocumentbudget());
                $certificat = $ordonnance_parent->getCertificatretenue()->getFirst();
                $budget_id = $ordonnance->getLigprotitrub()->getId();
                $lignebanquecaisse = LignebanquecaisseTable::getInstance()->findByIdBudget($budget_id)->getFirst();
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $ordonnance->getNumero(); ?></td>
                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($ordonnance->getDatecreation())); ?></td>
                    <td style="text-align: center;"><?php echo number_format($ordonnance->getMntnet(), 3, ".", " "); ?></td>
                    <td>
                        <?php
                        if ($lignebanquecaisse != null)
                            echo $lignebanquecaisse->getCaissesbanques();
                        ?>
                    </td>
                    <td style="text-align: center;"><?php echo $ordonnance_parent->getNumero(); ?></td>
                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($certificat->getDatecreation())); ?></td>
                    <td style="text-align: center;"><?php echo $certificat->getRetenuesource()->getValeurretenue(); ?>%</td>
                    <td><?php echo $certificat->getFournisseur(); ?></td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix col-xs-5" style="font-size: 16px;">
            <span id="nombre_ordonnance" style="margin-left: 20px;"><?php echo $ordonnances->count() ?> </span> Ordonnance(s) de Paiement
        </div>
        <button class="btn btn-primary" type="button" style="float: right; margin-bottom: 12px;" onclick="saveOrdonnance()">
            <i class="ace-icon fa fa-file-text bigger-110"></i>
            Enregistrer Déclaration
        </button>
    </div>
</div>