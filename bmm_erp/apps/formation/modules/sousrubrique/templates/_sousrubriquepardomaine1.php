<div id="my-modalsousrubriquepardomaine1" class="modal fade" tabindex="-1" >

    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $domaine = Doctrine_Core::getTable('domaineuntilisation')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Sous Rubriques du Domaine d'utilisation  "<?php echo $domaine->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body">
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr >
                                    <th style="width: 5%">N°</th> 
                                    <th style="width: 10%">C.Domaine</th> 
                                    <th style="width: 30%">Domaine d'utilisation</th> 
                                    <th style="width: 5%">Code</th> 
                                    <th style="width: 45%">Sous Rubrique </th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select("*")
                                        ->from('sousrubrique s,rubriqueformation r')
                                        ->where('s.id_rubrique=r.id')
                                        ->andWhere('r.id_domaine=' . $idd)
                                        ->execute();
                                $ag = new Sousrubrique();
                                $i = 1;
                                foreach ($listes as $l) {
                                    $ag = $l;
                                    ?>
                                    <tr style="cursor: pointer;" ondblclick="chSousRubriqueParDomaine1('<?php echo $ag->getId(); ?>','<?php echo $ag->getCode(); ?>', '<?php echo $ag->getLibelle(); ?>')">

                                        <td style="text-align: center"><?php echo $i; ?> </td>
                                        <td style="text-align: center"><?php echo $ag->getRubriqueformation()->getDomaineuntilisation()->getCode(); ?> </td>

                                        <td><?php echo $ag->getRubriqueformation()->getDomaineuntilisation()->getLibelle(); ?> </td>
                                        <td style="text-align: center"><?php echo $ag->getCode(); ?> </td>

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
                        <a id="button_print" target="_blanc" href="<?php echo url_for('sousrubrique/ImprimerlisteSousRubriqueParDomaine?iddomaine=' . $idd) ?>" class="btn btn-sm btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerSousRubriqueParDomanie1()" >

                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>   $("table").addClass("table  table-bordered table-hover");
    function chSousRubriqueParDomaine1(id,code, libelle)
    {

        $('#my-modalsousrubriquepardomaine1').removeClass('in');
        $('#my-modalsousrubriquepardomaine1').css('display', 'none');
        
         $('#idSousRubrique1').val(id);
        $('#idsousrubrique1').val(code);
        $('#sousrubrique1').val(libelle);
    }
    function fermerSousRubriqueParDomanie1()
    {
        $('#my-modalsousrubriquepardomaine1').removeClass('in');
        $('#my-modalsousrubriquepardomaine1').css('display', 'none');
    }

</script>


