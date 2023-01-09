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
            <div class="col-lg-6"> <?php echo $documentachat->getTypedoc() ?><br>

            </div> 
            <div class="col-lg-6"><br>  <div class="widget-toolbar no-border invoice-info">
                    <span class="invoice-info-label">N°:</span>
                    <span class="red"><?php echo $documentachat->getNumerodocachat() ?></span>

                    <br />
                    <span class="invoice-info-label">Date:</span>
                    <span class="blue"><?php echo $documentachat->getDatecreation(); ?></span>
                </div></div>

        </h3>
        <p style="margin-left: 70%">Original à joindre à la facture</p>



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
$documentparent = Doctrine_Core::getTable('documentachat')->findOneById($documentachat->getIdDocparent());
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
                                            <b>Bon de commande interne N°</b>
                                        </div>
                                    </div>

                                    <div>
                                        <ul class="list-unstyled spaced">
                                            <li>
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                BCI:
                                                <b class="red"><?php echo $documentparent->getNumerodocachat() ?></b>
                                            </li>

                                            <li class="divider"></li>


                                        </ul>
                                    </div>
                                </div><!-- /.col -->

                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                            <b>IMPULATION BUDGETAIRE</b>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <ul class="list-unstyled  spaced">
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>PROJET:
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>CHAPITRE:
                                            </li>

                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>TITRE:
                                            </li>


                                        </ul>
                                    </div><div class="col-lg-6">
                                        <ul class="list-unstyled  spaced">
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>ART:
                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>PAR:

                                            </li>
                                            <li>
                                                <i class="ace-icon fa fa-caret-right green"></i>S/P:

                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->


                            <div class="col-lg-6">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-small">
                                        <h4 class="widget-title blue smaller">

                                            Fournisseur
                                        </h4>


                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-8">
                                            <div id="profile-feed-1" class="profile-feed ace-scroll" style="position: relative;"><div class="scroll-track scroll-active" style="display: block; height: 200px;"><div class="scroll-bar" style="height: 63px; top: 0px;"></div></div><div class="scroll-content" style="max-height: 200px;">
                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <?php echo $fournisseur ?> 
                                                            <br>Adresse:<?php echo $adresse_frs ?>
                                                            <br>Tél:<?php echo $fournisseur->getTel() ?>
                                                            <br>GSM:<?php echo $fournisseur->getGsm() ?>
                                                            <br>E-mail:<?php echo $fournisseur->getMail() ?>
                                                        </div>


                                                    </div>


                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="space"></div>

                            <div> 
                                <table >
                                    <thead>
                                        <tr >
                                            <th style="text-align:center;width: 45px">N°<br>Ordre</th>

                                            <th style="text-align:center;width: 340px" >DESIGNATION<br>
                                                (indiquer,s\'il y a lieu, les référence au catalogue du fournisseur)
                                            </th>
                                            <th style="text-align:center;width: 60px">Quantité<br> à livrer </th>
                                            <th style="text-align:center;width: 50px">P.Unit.<br>H.T</th>
                                            <th style="text-align:center;width: 50px">Taux<br>T.V.A</th>
                                            <th style="text-align:center;width: 100px">Observations</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $html='';
                                        $lignedoc = new Lignedocachat();
                                        $liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')->findByIdDoc($documentachat->getId());
                                       
                                        foreach ($liste_demande_de_prix as $lgnedoc) {
                                        $lignedoc = $lgnedoc;
                                        $qte=0;
                                        $qteligne= Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lgnedoc->getId());
                                        if($qteligne)
                                        $qte=$qteligne->getQtelivrefrs();
                                        $html.=' <tr>
                                            <td style="text-align:center;width: 45px"><p style="border-bottom: #000 dashed 1px !important">' . $lignedoc->getNordre() . '</p></td>
                                            <td style="text-align:center;width: 340px"><p style="border-bottom: #000 dashed 1px !important">' . $lignedoc->getDesignationarticle() . '</p></td>
                                            <td style="text-align:center;width: 60px"><p style="border-bottom: #000 dashed 1px !important">' .$qte . '</p></td>
                                            <td style="text-align:center;width: 50px"><p style="border-bottom: #000 dashed 1px !important">' . $lignedoc->getMntht() . '</p></td>
                                            <td style="text-align:center;width: 50px"><p style="border-bottom: #000 dashed 1px !important">' . $lignedoc->getTva() . '</p></td>
                                            <td style="text-align:center;width: 100px"><p style="border-bottom: #000 dashed 1px !important">' . $lignedoc->getObservation() . '</p></td>

                                        </tr>';
                                        }
                                        for ($i = count($liste_demande_de_prix) + 1; $i <= 10; $i++) {
                                        $html.=' <tr>
                                            <td style="text-align:center;width: 45px"><p style="border-bottom: #000 dashed 1px !important">' . $i . '</p></td>
                                            <td><p style="border-bottom: #000 dashed 1px !important"></p></td>
                                            <td><p style="border-bottom: #000 dashed 1px !important"></p></td>
                                            <td><p style="border-bottom: #000 dashed 1px !important"></p></td>
                                            <td><p style="border-bottom: #000 dashed 1px !important"></p></td>
                                            <td><p style="border-bottom: #000 dashed 1px !important"></p></td>

                                        </tr>';
                                        }
                                        $html.=' </tbody></table>';
                                        echo $html;?>
                                
                            </div>

                            <div class="hr hr8 hr-double hr-dotted"></div>

                            <div class="row">
                                <div class="col-sm-5 pull-right">
                                    <h4 class="pull-right">
                                        Total TTC
                                        <span class="red"><?php echo $documentachat->getMntttc() ?></span>
                                    </h4>
                                </div>
                                
                            </div>
                            <div class="col-sm-7 pull-left"> Remarque Importantes </div>
                            <div class="space-6"></div>
                            <div class="space-6"></div>
                            <div class="well">
                                <p>1) L'Exemplaire original de ce bon de commande doit être joint à la facture</p>
                                 <p>2) la facture doit être établie en 4 exemplaires signée et arrétée en toutes lettres.</p>
                                 <p>Elle doit en outre faire réference au numéro et à la date du présent Bon de commande</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->

