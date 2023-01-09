<div id="my-modalfiltragecorpsetechelonetcat"  class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $cat = Doctrine_Core::getTable('corps')->findOneById($id1); ?>
                     <?php $e = Doctrine_Core::getTable('echelon')->findOneById($id2); ?>
                     <?php $ech = Doctrine_Core::getTable('categorierh')->findOneById($id3); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Employés relié au Corps   "<?php echo $cat->getLibelle(); ?> " et l'echelon "<?php echo $e->getLibelle(); ?> " " et au Catégorie "<?php echo $ech->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table1" class="dynamic-table" style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                    <th style="width: 30%">Matricule</th>  
                                    <th style="width: 40%">Nom Complet</th> 
                                    <th style="display: none">Code Agents</th> 

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,contrat c , salairedebase s, corps cor,echelon e ,categorierh cat')
                                        ->where('c.id_agents=a.id and c.id_salairedebase=s.id and s.id_corps=cor.id and s.id_echelon=e.id and s.id_categorie=cat.id')
                                        ->andWhere('cor.id= ?', $id1)
                                        ->andWhere('e.id= ?', $id2)
                                        ->andWhere('cat.id= ?', $id3)
                                        ->execute();
$i=1;                                
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr id="idde" >
                                     <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                    <td style="width: 40%"><?php echo $ag->getNomcomplet()." ". $ag->getPrenom(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>    
                                    </tr>
                                    <?php
                              $i++;  }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                      <a id="button_print" target="_blanc" href="<?php echo url_for('agents/ImprimerAlllisteagentsparcorpsetechelonetcat?idcorps='.$id1.'&idechelon='.$id2.'&idcat='.$id3) ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a> 
                        <button type="button" value="Fermer" id="btn1"  class="btn btn-sm pull-left"  onclick="fermeragentscorpsechelonetcat()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentscorpsechelonetcat()
    {
        $('#my-modalfiltragecorpsetechelonetcat').removeClass('in');
        $('#my-modalfiltragecorpsetechelonetcat').css('display', 'none');
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
    });</script>
