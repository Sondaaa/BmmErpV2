<?php
$soc = new Societe();
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$soc = $societe;
$entete = $soc->getRs();
?>
<div id="sf_admin_container">
    <h1 id="replacediv"> 
        <?php echo $soc->getRs(); ?><br><?php echo $soc->getAdresse() ?>
    </h1>
    <div class=" widget-header-large">
        <h3 class="widget-title grey lighter">
            <div class="col-lg-6"> <?php echo $facture->getTypedoc() ?><br>

            </div> 
            <div class="col-lg-6"><br>  <div class="widget-toolbar no-border invoice-info">
                    <span class="invoice-info-label">N°:</span>
                    <span class="red"><?php echo $facture->getNumerodocachat() ?></span>

                    <br />
                    <span class="invoice-info-label">Date:</span>
                    <span class="blue"><?php echo $facture->getDatecreation(); ?></span>
                </div></div>

        </h3>




    </div>
</div>
<?php
$listesdocuments = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($documentachat->getId());
$html = '';
$fournisseur = new Fournisseur();
$frs = Doctrine_Core::getTable('fournisseur')->findOneById($documentachat->getIdFrs());
$fournisseur = $frs;
$adresse_frs = "";
$adrs = Doctrine_Core::getTable('adressefrs')->findOneByIdFrs($documentachat->getIdFrs());
if ($adrs)
    $adresse_frs = $adrs;
$documentparent = new Documentachat();
$documentparent = $facture->getDocumentparent();
?>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="space-6"></div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="widget-box transparent">


                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            


                          

                           <?php  
                           
                            echo html_entity_decode($documentachat->ReadHtmlBonTransfertFacture());
                           ?>

                                    </div>

                                    <a   class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/validerfacture?idtype=15&id=') . $documentachat->getId() ?>">Valider le Transfert</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
</div>

