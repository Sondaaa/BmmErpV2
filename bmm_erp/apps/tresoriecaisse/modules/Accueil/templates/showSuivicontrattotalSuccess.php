    <div class="row">
    <div class="col-sm-6">
    <div class="widget-box">
    <div class="widget-header  widget-header-small">
    <h5 class="widget-title">
    <i class="ace-icon fa fa-list-alt"></i>
    SUIVI DES CONTRATS
    </h5>
    </div>
    <div class="widget-body">
    <div class="widget-main">
    <form method="POST" action="<?php echo url_for('Accueil/showSuivicontrattotal') ?>">
    <table class="table table-bordred">
    <tbody>
    <tr>
    <td><b>DA</b></td>
    <td>
    <select class="chosen-select form-control" name="id_bci" id="id_bci">
    <option></option>
    <?php foreach ($AllBCI as $bci): ?>
    <option value="<?php echo $bci->getId() ?>" <?php if ($id_bci && $id_bci == $bci->getId()): echo 'selected';endif;?> >
    <?php echo $bci->getNumerodocachat() ?>
    </option>
    <?php endforeach;?>
    </select>
    </td>
    <!-- <td><b>BCI</b></td>
    <td>
    <select class="chosen-select form-control" name="id_bcilabo" id="id_bcilabo">
    <option></option>
    <?php //foreach ($AllBCIlabo as $bcilabo): ?>
    <option value="<?php //echo $bcilabo->getId() ?>" <?php //if ($id_bcilabo && $id_bcilabo == $bcilabo->getId()): echo 'selected';endif;?> >
    <?php //echo $bcilabo->getNumerodocachat() ?>
    </option>
    <?php //endforeach;?>
    </select>
    </td> -->
    </tr>
    <tr>
    <td>
    <label><b>Date début</b></label>
    <input type="date" id="start" name="start" value="<?php echo $start_date ?>" class="form-control">
    </td>
    <td>
    <label><b>Date fin</b></label>
    <input type="date" id="end" name="end" value="<?php echo $end_date ?>" class="form-control">
    </td>

    <td><b>Contrat Provisoire</b></td>
    <td  style="min-width: 25%;">
    <select class="chosen-select form-control" name="id_contart" id="id_contart">
    <option></option>
    <?php foreach ($Allcontratprovisoire as $contratpov): ?>
    <option value="<?php echo $contratpov->getId() ?>"
    <?php if ($id_contart && $id_contart == $contratpov->getId()):
    echo 'selected';endif;?> >
    <?php echo
$contratpov->getTypedoc()->getPrefixetype() . ' : ' . $contratpov->getContratachat()->getReference();
?>
    </option>
    <?php endforeach;?>
    </select>
    </td>
    </tr>
    <tr>
    <td><b>Contrat Définitif</b></td>
    <td>
    <select class="chosen-select form-control" name="id_contratdef" id="id_contratdef">
    <option></option>
    <?php foreach ($AllcontratDef as $contratdef): ?>
    <option value="<?php echo $contratdef->getId() ?>"
    <?php if ($id_contratdef && $id_contratdef == $contratdef->getId()):
    echo 'selected';endif;?> >
    <?php echo
$contratdef->getTypedoc()->getPrefixetype() . ' : ' . $contratdef->getContratachat()->getReference();
?>
    </option>
    <?php endforeach;?>
    </select>
    </td>
    <td><b>N°Facture FRS</b></td>
    <td>
    <select class="chosen-select form-control" name="id_fac" id="id_fac">
    <option></option>
    <?php foreach ($AllFacture as $fac): ?>
    <option value="<?php echo $fac->getId() ?>"
    <?php if ($id_fac && $id_fac == $fac->getId()):
    echo 'selected';endif;?> >
    <?php $lignemouvemetfact = LignemouvementfacturationTable::getInstance()->findOneByIdDocumentachat($fac->getIdDocparent());
if($lignemouvemetfact) echo $lignemouvemetfact->getNumerofacture()?>
    </option>
    <?php endforeach;?>
    </select>
    </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
    <td>
    <button class="btn btn-sm btn-success" type="submit" style="text-align: right;" >
    <i class="fa fa-search"></i> Valider
    </button>
    </td>
    </tr>
    </tfoot>
    </table>
    </form>
    </div>

    </div>
    </div>

    </div>
    </div>
    <?php
$contratsachat = ContratachatTable::getInstance()->findbyIdTypedoc(19);
$contratsachats = ContratachatTable::getInstance()->findAll();
?>
    <div class="row">
    <div class="col-xs-12">
    <div class="table-header" style="margin-bottom: 0px;">
    SUIVI DES CONTRATS
    <a data-target="#my-modalimpressioncontrattotal" role="button" onclick="setImprimeId()" data-toggle="modal" target="_blanc"
    class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;margin-left: 4px" >
    Impression Personnalisée
    </a>
    <button style="float: right; padding: 5px 12px;margin-left: 4px"
    target="_blanc"
    onclick="setExportExcelContratId()"

    class="btn btn-sm btn-default">
    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter PDF
    </button>
    <!--            <a target="_blank" class="btn btn-sm btn-default" style="float: right; padding: 5px 12px;" href="<?php // echo url_for("Accueil/exportersuivicontrattotal") ?>">
    <i class="ace-icon fa fa-file-excel-o"></i>
    <span class="bigger-110 no-text-shadow">Exporter</span>
    </a>-->
    </div>
    <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;" ng-controller="CtrlDashboard">
    <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;"
    ><!--scrolly="scollingCommandeContrat()"-->
    <div class="table-wrap">
    <table id="listCommandescontrat" class="mws-datatable-fn mws-table main-table">
    <thead>
    <tr style="font-size: 14px" >
    <th style="widows: 10%;text-align: center;" class="fixed-side" scope="col" colspan="3">Bon Commande Inetrne </th>
    <th style="widows: 10%;text-align: center">Direction</th>
    <th style="widows: 15%;text-align: center">Etat</th>
    <th style="widows: 10%;text-align: center" colspan="4" >Contrat</th>
    <th style="widows: 20%;text-align: center" colspan="4">Budget</th>
    <th style="widows: 10%;text-align: center" colspan="3">Facturation</th>
    <th style="widows: 20%;text-align: center" colspan="2">Financiers</th>
    <th style="widows: 20%;text-align: center" colspan="3" >Réglemet</th>
    </tr>
    <tr style="font-size: 14px" >
    <th style="widows: 20%;text-align: center;min-width: 110px" class="fixed-side" scope="col"rowspan="2">N° BCI</th>
    <th style="widows: 20%;text-align: center;min-width: 110px" class="fixed-side" scope="col"rowspan="2">N° DA</th>
    <th style="widows: 10%;text-align: center;min-width: 110px" class="fixed-side" scope="col" rowspan="2">Date Création</th>
    <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2"> Demandeur</th>
    <th style="widows: 15%;max-width: 110px;text-align: center" rowspan="2">Etat du document</th>
    <th style="widows: 10%;max-width: 110px;text-align: center"rowspan="2">Contrat Provisoire</th>
    <th style="widows: 10%;min-width: 110px;text-align: center "colspan="2">Contrat Définitif</th>
    <th style="widows: 10%;min-width: 110px;text-align: center "rowspan="2">Type Contrat</th>
    <th style="widows: 20%;min-width: 110px;text-align: center" colspan="2">Engagement Budget</th>
    <th style="widows: 20%;min-width: 110px;text-align: center" colspan="2">Ordonnancement</th>
    <th style="text-align: center" rowspan="2">N°FAC S</th>
    <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">N°FAC FRS</th>
    <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">Montant</th>

    <th style="widows: 20%;min-width: 110px;text-align: center" rowspan="2">Date paiement</th>
    <th style="widows: 10%;min-width: 110px;text-align: center" rowspan="2">Montant</th>
    <th style="widows: 20%;min-width: 110px;text-align: center" colspan="3">Banque</th>
    </tr>
    <tr style="font-size: 14px" >
    <th>N°Contrat D</th><th>Montant</th>
    <th>Date</th><th>Montant</th><th>Date</th><th>Montant</th>
    <th style="widows: 20%;min-width: 110px;">Banque</th><th style="widows: 20%;min-width: 110px;">Instrument de paiement </th><th style="widows: 20%;min-width: 110px;">Montant</th>
    </tr>

    </thead>
    <tbody>
    <?php
if (sizeof($documentachats) >= 1):
    foreach ($documentachats as $document_achat):
        $id_doc_parent = $document_achat->getId();
        $contratachatpro = ContratachatTable::getInstance()->findByIdDocAndIdTypedoc($id_doc_parent, 19);
        $doc_parent = DocumentachatTable::getInstance()->find($id_doc_parent);
        // $docupmenta_acha_contrat_def = DocumentachatTable::getInstance()->getByTypedocContratDef(20, $document_achat->getId());
        if (sizeof($document_achat) >= 1 && $contratachatpro):
        ?>
				        <tr class="ligne_compte" style="font-size: 12px" >
				        <td style="text-align: center;">
				        <b>
				        <?php
        if ($document_achat->getIdDocparent()):
            $id_bci = $document_achat->getIdDocparent();
            $bci = DocumentachatTable::getInstance()->find($id_bci);?>
						<a target="_blank" href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" . $bci->getId()); ?>">
						<?php echo $bci->getNumerodocachat(); ?>  </a>
							<?php else: ?>
				<?php $docreg = DocachatregTable::getInstance()->findByIdDocreg($document_achat->getId());
        foreach ($docreg as $dareg):
            $bcilab = DocumentachatTable::getInstance()->find($dareg->getIdBci())?>
						    <a target="_blank"   href="<?php echo url_for("documentachat/Imprimerdocachat?iddoc=" . $bcilab->getId()); ?>">
						    <?php echo '<p>' . $bcilab->getNumerodocachat() . '</p>'; ?>
						</a>
						<?php endforeach;?>
				<?php endif;?>
					    </b>
					    </td>
					    <td style="text-align: center;min-width: 150px;"  >
					    <b>
					    <a target="_blank" href="<?php echo url_for("documentachat/imprimerboncomande?iddoc=" . $doc_parent->getId()); ?>">
					    <?php echo $document_achat->getNumerodocachat(); ?></a> </b>
					    </td>
					    <td style="text-align: center" ><?php echo date('d/m/Y', strtotime($doc_parent->getDatecreation())); ?></td>
					    <td style="text-align: center;">
					        <b>
					            <?php
    if ($document_achat->getIdDocparent()):
        $id_bci = $document_achat->getIdDocparent();
        $bci = DocumentachatTable::getInstance()->find($id_bci);?>
		<?php if (($bci->getIdDemandeur() != '' && $bci->getIdDemandeur() != null)) {
            echo $bci->getDemandeur();
        }?>
		<?php else: ?>
					    <?php
    $docreg = DocachatregTable::getInstance()->findByIdDocreg($document_achat->getId());

    foreach ($docreg as $dareg):
        $bcilab = DocumentachatTable::getInstance()->find($dareg->getIdBci())?>

										    <?php if (($bcilab->getIdDemandeur() != '' && $bcilab->getIdDemandeur() != null)) {
            echo '<p>' . $bcilab->getDemandeur() . '</p>';
        }?>

										    <?php endforeach;?>
					    <?php endif;?>
    </b>
    </td>
<td style="max-width: 10%;width: 10%">
<?php
$contra_prov = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($document_achat->getId(), 19);
if ($contra_prov) {
    $docupmenta_acha_contrat_def = DocumentachatTable::getInstance()->getByTypedocContratDef(20, $contra_prov->getId());
    if (sizeof($docupmenta_acha_contrat_def) >= 1) {
        echo $docupmenta_acha_contrat_def->getFirst()->getEtatdocument()->getEtatdocachat();
    } elseif (sizeof($contra_prov) >= 1) {
        echo $contra_prov->getEtatdocument()->getEtatdocachat();
    } elseif (sizeof($document_achat) >= 1) {
        echo $document_achat->getEtatdocument()->getEtatdocachat();
    }
}
?>
</td>
<td style="text-align: center">
<?php
if (sizeof($document_achat) >= 1) {
    $contratprovs = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 19);

    foreach ($contratprovs as $contratprov):
    ?>
<a target="_blank" href="<?php //echo $prevesoire->getLinkDocument(); ?>">
<?php
if ($contratprov) {
        echo '<p>' . $contratprov->getTypedoc()->getPrefixetype() . ' : '
        . $contratprov->getContratachat()->getReference() . '</p>';
    }
    ?>
</a>
<?php endforeach;}?>
<td style="text-align: center" colspan="2">
<?php
$docupmenta_acha_contrat_def = DocumentachatTable::getInstance()->getByTypedocContratDef(20, $document_achat->getId());

foreach ($docupmenta_acha_contrat_def as $contratdefinitif):
?>
<a target="_blank" href="<?php // echo $definitif->getLinkDocument(); ?>">
<?php
if ($contratdefinitif) {echo '<p>' . $contratdefinitif->getTypedoc()->getPrefixetype() . ' : '
    . $contratdefinitif->getContratachat()->getReference();
    echo ' - ' . number_format($contratdefinitif->getMntttc(), 3, ".", " ");
    echo '</p>';
}
?>
</a>
<?php endforeach;?>


<td style="text-align: center" >
<?php
if (sizeof($document_achat) >= 1) {
    if ($document_achat->getContratachat()->getType() == 0) {
        echo 'Contrat Total';
    } else {
        echo 'Contrat Partiel';
    }

}
?>
</td>
<td style="text-align: center" colspan="2">
<?php
$contratprovs = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 19);
foreach ($contratprovs as $prevesoire):
    $piece_budget_porvisoire = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($prevesoire->getId());
    if ($piece_budget_porvisoire && $piece_budget_porvisoire->getDocumentbudget()) {
        $budget_pro = DocumentbudgetTable::getInstance()->find($piece_budget_porvisoire->getIdDocumentbudget())?>
									<?php
    echo '<p>' . date('d/m/Y', strtotime($budget_pro->getDatecreation()));
        if ($budget_pro->getMnt()) {
            echo ' - ' . $budget_pro->getMnt() . '';
        }

        echo '</p>';
    }
    ?>

									<?php endforeach;?>

</td>

<td style="text-align: center" colspan="2">
<?php
$contratprovs = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 20);
$document_contrat_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 20);
foreach ($document_contrat_difinitif as $definitif):
?>
<a target="_blank" href="<?php // echo $definitif->getLinkDocument(); ?>">
<?php
echo '<p>';
echo $definitif->getNumerodocachat();
echo ' - ' . number_format($definitif->getMntttc(), 3, ".", " ");
echo '</p>';
?>
</a>
<?php endforeach;?>
</td>


<td colspan="2">
<?php
$document_contrat_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 20);
foreach ($document_contrat_difinitif as $definitif) {

    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($definitif->getId());
    if ($piecejoint) {
        $document_udget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($piecejoint->getIdDocumentbudget());
        if ($document_udget_ordanancemet) {
            $piece_budget = PiecejointbudgetTable::getInstance()->findOneByIdDocachatAndIdDocumentbudget($definitif->getId(), $document_udget_ordanancemet->getId());
            if ($piece_budget) {
                echo '<p>' . date('d/m/Y', strtotime($piece_budget->getDocumentbudget()->getDatecreation()));
                if ($piece_budget->getDocumentbudget()->getMnt()) {
                    echo ' - ' . $piece_budget->getDocumentbudget()->getMnt();
                }
                echo '</p>';
            }
        }
    }
}
?>
</td>
<td style="text-align: center" colspan="3">
<?php
$document_contrat_difinitif = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 20);
foreach ($document_contrat_difinitif as $definitif) {
    $docparent_parent = DocumentachatTable::getInstance()->findOneByIdDocparent($definitif->getId());
    if ($docparent_parent) {
        echo '<p>' . $docparent_parent->getNumerodocachat();
        if ($definitif->getLignemouvementfacturation()->getFirst() && $definitif->getLignemouvementfacturation()->getFirst()->getNumerofacture()) {
            echo ' - ' . $definitif->getLignemouvementfacturation()->getFirst()->getNumerofacture();
        }

        echo ' - ' . number_format($docparent_parent->getMntttc(), 3, ".", " ");
        echo '</p>';
    }
}
?>
</td>
<td style="text-align: center" colspan="2">
<?php
foreach ($document_contrat_difinitif as $definitif) {

    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($definitif->getId());
    if ($piecejoint) {
        $id_document_udget_achatt = $piecejoint->getIdDocumentbudget();
        $document_budget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($id_document_udget_achatt);
        if ($document_budget_ordanancemet) {
            $id_docbudget = $document_budget_ordanancemet->getId();
            $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($id_docbudget);

            if (sizeof($mvts) >= 1 && $mvts->getFirst()->getId() != null) {

                echo '<p>';

                echo date('d/m/Y', strtotime($mvts->getFirst()->getDateoperation()));
                if ($mvts->getFirst()->getDebit() != null) {
                    echo ' - ' . number_format($mvts->getFirst()->getDebit(), 3, ".", " ");
                } else if ($mvts->getFirst()->getId() != null && $mvts->getFirst()->getCredit() != null) {
                    echo ' - ' . number_format($mvts->getFirst()->getCredit(), 3, ".", " ");
                }

                echo '</p>';
            }
        }
    }
}
?>
</td>
<td style="text-align: center" colspan="3">
<?php
foreach ($document_contrat_difinitif as $definitif) {
    $id_docparent = $definitif->getId();
    $piecejoint = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_docparent);
    if ($piecejoint) {
        $id_document_udget_achatt = $piecejoint->getIdDocumentbudget();
    }

    $document_budget_ordanancemet = DocumentbudgetTable::getInstance()->findOneByIdDocumentbudget($id_document_udget_achatt);
    if ($document_budget_ordanancemet) {

        $mvts = MouvementbanciareTable::getInstance()->getMouvementBCE($document_budget_ordanancemet->getId());
        if (sizeof($mvts) >= 1) {
            echo '<p>';
            echo $mvts->getFirst()->getCaissesbanques();
            echo ' - ' . $mvts->getFirst()->getInstrumentpaiment();
            echo ' - ' . $mvts->getFirst()->getDebit();
            echo '</p>';
        }
    }
}
?>
</td>
</tr>
<?php
endif;
endforeach;endif;
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="my-modalimpressioncontrattotal" class="modal fade" tabindex="-1" style="width: 1200px;display: none">
    <?php include_partial('Accueil/form_impression_contrattotal', array());?>
</div>
<script  type="text/javascript">

    // requires jquery library
    jQuery(document).ready(function () {
        console.log('add clone');
        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
    function setImprimeId()
    {
//        $('#id_imprime').val(id);
    }

      function setExportExcelContratId() {
        var url = '';
        if ($('input[name=start]').val() != '') {
            if (url == '')
                url = '?start=' + $('#start').val();
            else
                url = url + '&start=' + $('#start').val();
        }
        if ($('input[name=end]').val() != '') {
            if (url == '')
                url = '?end=' + $('#end').val();
            else
                url = url + '&end=' + $('#end').val();
        }

        if ($('input[name=id_bci]').val() != '') {
            if (url == '')
                url = '?id_bci=' + $('#id_bci').val();
            else
                url = url + '&id_bci=' + $('#id_bci').val();
        }
        url = '<?php echo url_for('Accueil/exportersuivicontrattotal') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>
<style type="text/css">
    .header_table th {
        font-weight: bold;
        font-size: 13px;
    }

    .tab_filter tbody td {
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px;
    }

    tr:hover {
        color: #2679b5;
    }
</style>

<style>
    .table-scroll {
        position: relative;
        max-width: 100%;
        margin: auto;
        border: 1px solid #fff;
        overflow-y: scroll;
        overflow-x: scroll;
        height: 400px;
        width: 100%;
        display: block;
    }

    .table-scroll thead{
        border: solid 1px black;
        position: sticky;
        top: 0;

    }


    .table-wrap {
        width: 100%;
        border: 1px solid #000;
        /* overflow: auto; */
    }

    .table-scroll table {
        width: 100%;
        margin: auto;
        border: 1px solid #000;

    }



    .table-scroll th,
    .table-scroll td {
        padding: 10px 20px;
        border: 1px solid #000;
        white-space: nowrap;
        vertical-align: top;
    }

    .table-scroll td {
        padding: 30px 20px;
    }

    .clone {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        border: 1px solid #000;
    }

    .clone th,
    .clone td {
        visibility: hidden;


    }

    .clone td,
    .clone th {
        border-color: transparent
    }

    .clone tbody th {
        visibility: visible;
    }

    .clone .fixed-side {
        visibility: visible;
        background-color: #fff;
        background: repeat-x #F2F2F2;
        border: solid 1px #000;
    }

    .clone thead,
    .clone tfoot {
        background: transparent;
    }

    .table-bordered,
    th {
        border-radius: 0 !important;
        background-color: #dbdde1;
        color: black;
    }
</style>
