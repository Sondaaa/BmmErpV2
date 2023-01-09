<div id="sf_admin_container">
    <h1 id="replacediv"><?php echo 'Liste des Bons Sorties' ?> </h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8" >
        <form action="" method="post" >
            <table cellspacing="0" >
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td>
                        <input type="date" value="<?php echo $datedebut ?>" name="debut" id="debut">TO<input type="date" name="fin" id="fin"  value="<?php echo $datefin ?>">
                    </td>
                </tr>
                <tr>
                    <td><label>Fournisseur</label></td>
                    <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                        <?php echo $form['id_frs']->render(array('name' => 'idfrs')); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue"></h3>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Résultat de recherche
            </div>
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Date création</th>
                            <th>Numéro BCIS</th>
                            <th>Tiers</th>
                            <th>Mnt.TTC</th>
                            <th>Etat</th>
                            <th class="detail-col" style="width: 30%" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$boncomm = new Documentachat();

for ($i = 0; $i < sizeof($boncommandeexterne); $i++) {

    ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $boncommandeexterne[$i]['prefixetype'] . ' ' . $boncommandeexterne[$i]['numero'] ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncommandeexterne[$i]['datecreation'])); ?></td>
                                <td style="text-align: center;"><?php
if ($boncommandeexterne[$i]['id_docparent']) {
        $docparent = DocumentachatTable::getInstance()->find($boncommandeexterne[$i]['id_docparent']);
    }

    echo $docparent->getNumerodocachat()?></td>
                                <td><?php
echo $boncommandeexterne[$i]['nomcomplet'] . ' ' . $boncommandeexterne[$i]['prenom']; ?></td>

                                <td style="text-align: right;"><?php
                    echo $boncommandeexterne[$i]['mntttc']; ?>
                    </td>
                                <td style="text-align: left;"><?php
            echo $boncommandeexterne[$i]['etatdocachat']; ?></td>
                                <td>
                                <a target="_blanc"  id="btnimpexpo"  class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/showdocumentbnsortie?iddoc=') . $boncommandeexterne[$i]['id'] ?>">
                                Détail N°:<?php echo $boncommandeexterne[$i]['prefixetype'] . ' ' . $boncommandeexterne[$i]['numero']; ?></a>
    <a target="_blanc"  class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/Imprimerdocentre?iddoc=' .  $boncommandeexterne[$i]['id']) ?>">Impprimer & Exporter Pdf</a>

                                </td>
                            </tr>
                            <?php
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $(".transform_a").addClass("btn btn-white btn-primary");
        $(".print_a").addClass("btn btn-xs btn-success");
        $('.print_a').attr('style', 'margin-left:1%');
    });

</script>