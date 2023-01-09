<div id="my-modalunitepardirectionetservice" class="modal fade" tabindex="-1" >

    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $service = Doctrine_Core::getTable('servicerh')->findOneById($id1); ?>
                    <?php $direction = Doctrine_Core::getTable('direction')->findOneById($idd); ?>

                    <h4 class="smaller lighter blue no-margin"> Liste des unités de la Direction " <?php echo $direction->getLibelle(); ?>" reliés au service " <?php echo $service->getLibelle(); ?>"</h4>
                </div>

                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                            <thead>
                                <tr >
                                    <th style="width: 20%">Numéro</th>
                                    <th>Libellé</th> 

                                    <th style="display: none">Code Unite</th> 

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select("*")
                                        ->from('unite u , servicerh s, sousdirection sd ')
                                        ->where('u.id_service=' . $id1)
                                        ->andWhere('s.id_sousdirection=sd.id')
                                        ->andWhere('sd.id_direction= ?', $idd)
                                        ->execute();
                                $ag = new Unite();
                                $i = 1;
                                foreach ($listes as $l) {
                                    $ag = $l;
                                    ?>
                                    <tr style="cursor: pointer;" ondblclick="chUnite4('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">

                                        <td style="width: 20%"><?php echo $i; ?> </td>

                                        <td><?php echo $ag->getLibelle(); ?> </td>
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
                        <a id="button_print" target="_blanc" href="<?php echo url_for('unite/Imprimerlisteunitepardirectionetservice?idunite=' . $idd . '&idservice=' . $id1) ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerunite4()" >

                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">   $("table").addClass("table  table-bordered table-hover");
    function chUnite4(id, libelle)
    {
        $('#my-modalunitepardirectionetservice').removeClass('in');
        $('#my-modalunitepardirectionetservice').css('display', 'none');
        $('#idunite').val(id);
        $('#libelleunite').val(libelle);


    }
    function fermerunite4()
    {
        $('#my-modalunitepardirectionetservice').removeClass('in');
        $('#my-modalunitepardirectionetservice').css('display', 'none');
    }

</script>


