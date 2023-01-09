<div style="overflow: auto; width: 100%; height: 100%"  >
    <div id="sf_admin_container" >
        <div class="modal-dialog" style="width: 550px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin"> Liste des Contrats achats </h4>
                </div>
                <div class="modal-body" style="width: 100%" >
                    <fieldset>
                        <table id="dynamic-table1" class="dynamic-table table-bordered table-hover" style="max-width: 90% ;"  >
                            <thead>
                                <tr> 
                                    <th style="max-width: 5%;color: #0066cc" >N°</th>  
                                    <th style="width: 18%;color: #0066cc">Numéro</th>  
                                    <th style="width: 18%;color: #0066cc">Fournisseur</th>  
                                    <th style="width: 14%;color: #0066cc">Date</th>  
                                    <th style="width: 20%;color: #0066cc">Montant Contrat</th> 
                                    <th style="width: 10%;color: #0066cc">Taux % </th>  
                                    <th style="width: 15%;color: #0066cc">Montant  </th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listeDocAchat = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('documentachat da ,contratachat c,fournisseur f ')
                                        ->where('da.id_frs= f.id')
                                        ->andWhere(' da.id_contrat= c.id')
//                                        ->andWhere('lg.id_contrat=c.id')
//                                        /************
                                        ->andWhere('da.id_typedoc = typedoc.id')
                                        ->andWhere('da.id_typedoc = 20')
                                        //   ->andWhere("c.type=" . "'0'")
                                        ->andWhere('c.consulte is null')
//                                        /***********
//                                        ->andWhere(' lg.id_docparent is not null')
                                        ->andWhere('c.id_typedoc = 20')
                                        ->andWhere(' da.id IN (SELECT piecejointbudget.id_docachat FROM piecejointbudget, documentbudget 
                                         WHERE piecejointbudget.id_documentbudget = documentbudget.id) ')
//                                        ->andWhere('lg.id_docparent is not null')
                                        ->andWhere('da.id NOT IN (SELECT lignemouvementfacturation.id_documentachat   FROM lignemouvementfacturation where    lignemouvementfacturation.id_documentachat is not null)')
                                        ->andWhere(' da.etatdocachat IS NULL')
                                        ->orderBy('da.id desc')
                                        ->execute();
                                $i = 1;
                                foreach ($listeDocAchat as $l) {
                                    $doc = $l;
                                    $id_ligne = $doc->getContratachat()->getLignecontrat()->getLast()->getId();
                                    $id_doc = $doc->getId();
//                                    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//                                    $query = "SELECT lignecontrat.id as id ,"
//                                            . " lignecontrat.tauxpourcentage as taux "
//                                            . " , lignecontrat.designationartcile as  libelle"
//                                            . " FROM lignecontrat"
//                                            //. " WHERE lignecontrat.id_docparent =" . $id_ligne
//                                            . " WHERE lignecontrat.tauxpourcentage not in ( select tauxpourcetage"
//                                            . " from lignemouvementfacturation"
//                                            . " where lignemouvementfacturation.id_documentachat=" . $id_doc . ")"
//                                    ;
//                                    $resultat = $conn->fetchAssoc($query);
//                                    if (sizeof($resultat) >=1):
                                    ?><?php $frs = FournisseurTable::getInstance()->find($doc->getIdFrs()); ?>
                                    <?php //echo 'ligne=' . $i . ' ' . $doc->getFournisseur()->getRs(); ?>
                                    <tr style="cursor: pointer;" id="idjournal" ondblclick="chargerBci('<?php echo sprintf('%05d', $doc->getNumero()); ?>',
                                                        '<?php echo trim($doc->getDatecreation()); ?>',
                                                        '<?php if ($doc->getFournisseur()->getId()) echo trim($doc->getFournisseur()->getId()); ?>',
                                                        '<?php echo utf8_encode($doc->getFournisseur()->getRs()); ?>',
                                                        '<?php if ($doc->getContratachat()->getMontantcontrat()) echo trim($doc->getContratachat()->getMontantcontrat()); ?>',
                                                        '<?php if ($doc->getContratachat()->getLignecontrat()->getLast()) echo trim($doc->getContratachat()->getLignecontrat()->getLast()->getId()); ?>',
                                                        '<?php if ($doc->getId()) echo trim($doc->getId()); ?>')"  >
                                        <td style="text-align: center" ><?php echo $i; ?></td>
                                        <td style="text-align: center"><?php
                                            echo
                                            $doc->getTypedoc()->getPrefixetype() . ' ' . $doc->getContratachat()->getReference() . ' ' . $doc->getContratachat()->getNumero();
                                            ?></td>
                                        <td style="text-align: left"><?php echo trim($doc->getFournisseur()->getRs()); ?></td>
                                        <td style="text-align: center"><?php echo date('d/m/Y', strtotime($doc->getDatecreation())); ?></td>
                                        <td style="text-align: right"><?php echo $doc->getContratachat()->getMontantcontrat(); ?></td>
                                        <td style="text-align: center"><?php // echo $doc['tauxpour'];                                                                                    ?></td>
                                        <td style="text-align: right"><?php echo $doc->getMntttc(); ?></td>
                                    </tr>
                                    <?php
                                    // endif;
                                    //foreach ($doc->getContratachat()->getLignecontrat() as $ligne):
//                                        foreach ($ligne->getLignecontrat() as $lgligne): 
                                    ?>
    <!--                                            <tr>
                                            <td><?php // echo $ligne->getId() . 'size='.  sizeof($doc->getContratachat()->getLignecontrat());                                                                                   ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php // echo $lgligne->getTauxpourcentage();                                                                                  ?></td>
                                            <td><?php // echo $lgligne->getId();                                                                                 ?></td>
                                        </tr>-->
                                    <?php
//                                        endforeach;
//                                    endforeach;
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="row"></div>
                    <div class="modal-footer" >
                        <button type="button" value="Fermer" class="btn btn-sm  pull-left"  onclick="fermerBci()" >
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function chargerBci(numero, date, id_frs, rs, montant, id_ligne, id)
    {
        $('#my-modalListebci').removeClass('in');
        $('#my-modalListebci').css('display', 'none');
        $('#documentachat').val(numero);
        $('#date_documentachat').val(date);
        $('#id_fournisseur').val(id_frs);
        $('#fournisseur_raison').val(rs);
        $('#montant_documentachat_contrat').val(montant);
        $('#id_ligne').val(id_ligne);
        $('#id_documentachat').val(id);
        if (id_ligne != '') {
            $('#pour').empty();
            $.ajax({
                url: '<?php echo url_for('documentachat/ListeLigneDocAchatContratJS') ?>',
                data: 'id=' + id_ligne + '&id_doc=' + id,
                contentType: "application/json",
                dataType: "json",
                success: function (data) {
                    if (data.length >= 1) {
                        $('#pour').append("<option value='0'></option>");
                        for (i = 0; i < data.length; i++) {
                            $('#pour').append("<option value='" + data[i].taux + "'>" + data[i].libelle + '  ' + data[i].taux + ' %' + "</option>");
                        }
                    }
                    else {
                        $('#pour').append("<option value='" + 100 + "'>" + '  ' + '100' + ' %' + "</option>");
                        var val_pourcentage = 100;
                        var mnt_contrat = parseFloat($("#montant_documentachat_contrat").val());
                        var mnt_mouvement = parseFloat((mnt_contrat * val_pourcentage) / 100);
                        $('#montant_documentachat').val(parseFloat(mnt_mouvement).toFixed(3));
                    }
                    $('#pour').trigger("chosen:updated");
                }
            });
        }
        else {
            
            $('#pour').empty();
            $('#pour').val('').trigger("liszt:updated");
            $('#pour').trigger("chosen:updated");
        }
    }
    
    
    
    function fermerBci()
    {
        $('#my-modalListebci').removeClass('in');
        $('#my-modalListebci').css('display', 'none');
    }
</script>
<script type="text/javascript">
//    jQuery(function ($) {                 //initiate dataTables plugin
//        var myTable =
//                $('#dynamic-table1')
//                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
//                .DataTable({});
//        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
//        new $.fn.dataTable.Buttons(myTable, {
//            buttons: [
//                {
//                    "extend": "csv",
//                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
//                    "className": "btn btn-white btn-primary btn-bold"
//                },
//                {
//                    "extend": "excel",
//                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
//                    "className": "btn btn-white btn-primary btn-bold"
//                },
//                {
//                    "extend": 'pdfHtml5',
//                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
//                    "className": "btn btn-white btn-primary btn-bold"
//                },
//                {
//                    "extend": "print",
//                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
//                    "className": "btn btn-white btn-primary btn-bold",
//                    autoPrint: false,
//                    message: ''
//                }
//            ]
//        });
//        myTable.buttons().container().appendTo($('.tableTools-container'));
//    });
</script>

