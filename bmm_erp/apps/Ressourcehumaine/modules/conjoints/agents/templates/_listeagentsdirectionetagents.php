<div id="my-modalagentsdirectionetagents" class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $agentsd = Doctrine_Core::getTable('agents')->findOneById($id1); ?>
                    <?php $agentsf = Doctrine_Core::getTable('agents')->findOneById($id2); ?>         

                    <?php $directio = Doctrine_Core::getTable('direction')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Employés de la Direction  "<?php echo $directio->getLibelle(); ?> " entre "<?php echo $agentsd->getNomcomplet()." ".$agentsd->getPrenom(); ?> " et "<?php echo $agentsf->getNomcomplet()." " .$agentsf->getPrenom(); ?> "</h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table1" class="dynamic-table" style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                    <th style="width: 30%">Matricule</th>  
                                    <th style="width: 40%">Agent</th> 
                                    <th style="display: none">Code Agents</th> 

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,contrat c , posterh p ,unite u , servicerh s, sousdirection sd , direction d ')
                                        ->where('c.id_agents=id and c.id_posterh=p.id and p.id_unite=u.id and u.id_service=s.id and  s.id_sousdirection=sd.id and sd.id_direction=d.id  ')
                                        ->andWhere('d.id= ?', $idd)
                                        ->andWhere('id>=' . $id1)
                                        ->andWhere('id<=' . $id2)
                                        ->execute();
//                                $listes=  AgentsTable::getInstance()->getlisteagents($idde,$idfin);
                                $i = 1;
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr id="idde" ondblclick="chargerpersonne1('<?php echo $ag->getId(); ?>', '<?php echo $ag->getIdrh(); ?>', '<?php echo $ag->getNomcomplet(); ?>')">

                                        <td style="width: 10%"><?php echo $i; ?></td>
                                        <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                        <td style="width: 40%"><?php echo $ag->getNomcomplet()." ". $ag->getPrenom(); ?> </td>
                                        <td style="display: none"><?php echo $ag->getId(); ?> </td>  
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                        <a id="button_print" target="_blanc" href="<?php echo url_for('agents/ImprimerAlllisteagentspardirectionetpardebutfinagents?iddirection=' . $idd . '&idd=' . $id1 . '&idf=' . $id2) ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1"  class="btn btn-sm pull-left"  onclick="fermeragentsdirection1()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript"> $("table").addClass("table  table-bordered table-hover");

    function fermeragentsdirection1()
    {
        $('#my-modalagentsdirectionetagents').removeClass('in');
        $('#my-modalagentsdirectionetagents').css('display', 'none');
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
