<div style="overflow: auto; width: 100%; height: 100%"  >
    <div id="sf_admin_container" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="smaller lighter blue no-margin"> Liste des B.D.C.Regroupé</h4>
                </div>
                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table1" class="dynamic-table table-bordered table-hover" style="width: 100% ;"  >
                            <thead>
                                <tr> 
                                    <th style="width: 5%;color: #0066cc" >N°</th>  
                                    <th style="width: 20%;color: #0066cc">Numéro</th>  
                                    <th style="width: 10%;color: #0066cc">Date</th>  
                                    <th style="width: 15%;color: #0066cc">Montant  </th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listeDocAchat = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('documentachat da ,contratachat contrat')
                                        ->where('da.id_contrat=contrat.id')
                                        ->andWhere('da.id_frs is not null ')
                                        ->andWhere('da.id_typedoc = 6')
                                        ->andWhere('da.id_contrat is not null')
                                        ->andWhere('da.id_etatdoc=42')
                                        ->andWhere('contrat.type=' . "'1'")
                                        ->andWhere('da.etatdocachat IS NULL')
                                        ->andWhere('da.valide=true')
                                        ->orderBy('da.id desc');
//                                die($listeDocAchat);
                                $listeDocAchat = $listeDocAchat->execute();
                                $i = 1;
                                foreach ($listeDocAchat as $l) {
                                    $doc = $l;
                                    ?>
                                    <tr style="cursor: pointer;" id="idjournal" 
                                        ondblclick="chargerBciContrat('<?php echo sprintf('%05d', $doc->getNumero()); ?>', '<?php echo $doc->getDatecreation(); ?>', '<?php echo $doc->getFournisseur()->getId(); ?>', '<?php echo $doc->getFournisseur()->getRs(); ?>', '<?php echo $doc->getMntttc(); ?>', '<?php echo $doc->getContratachat()->getLignecontrat()->getLast()->getId(); ?>', '<?php echo $doc->getId(); ?>')">
                                        <td style="text-align: center" ><?php echo $i; ?></td>
                                        <td style="text-align: center">
                                            <?php
                                            echo $doc->getTypedoc()->getPrefixetype() . ' ' . sprintf('%05d', $doc->getNumero());
                                            ?>
                                        </td>
                                        <td style="text-align: center"><?php echo date('d/m/Y', strtotime($doc->getDatecreation())); ?></td>
                                        <td style="text-align: right"><?php echo $doc->getMntttc(); ?></td>
                                    </tr>
                                    <?php
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

    function chargerBciContrat(numero, date, id_frs, rs, montant, id_ligne, id)
    {
        $('#my-modalListebciContrat').removeClass('in');
        $('#my-modalListebciContrat').css('display', 'none');
        $('#documentachat').val(numero);
        $('#date_documentachat').val(date);
        $('#id_documentachat').val(id);        
        $('#id_fournisseur').val(id_frs);
        $('#fournisseur_raison').val(rs);
        $('#montant_documentachat').val(montant);
        $('#id_ligne').val(id_ligne);
        $('#id_documentachat').val(id);
    }

    function fermerBci()
    {
        $('#my-modalListebciContrat').removeClass('in');
        $('#my-modalListebciContrat').css('display', 'none');
    }
</script>
<script type="text/javascript">
    jQuery(function ($) {                 //initiate dataTables plugin
        var myTable =
                $('#dynamic-table1')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({});
        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        new $.fn.dataTable.Buttons(myTable, {
            buttons: [
                {
                    "extend": "csv",
                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "excel",
                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": 'pdfHtml5',
                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    autoPrint: false,
                    message: ''
                }
            ]
        });
        myTable.buttons().container().appendTo($('.tableTools-container'));
    });
</script>

