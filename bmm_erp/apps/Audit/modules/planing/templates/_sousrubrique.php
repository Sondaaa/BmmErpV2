<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Sous Rubriques</h4>
            </div>

            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">N° </th> 
                                <th style="width: 10%">Code</th>  
                                <th style="width: 30%">Libelle</th>  

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('sousrubrique')
                                    ->execute();
                            $ag = new Sousrubrique();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="id" ondblclick="ChargerSousRubrique('<?php echo $ag->getId(); ?>','<?php echo $ag->getCode(); ?>','<?php echo $ag->getLibelle(); ?>')">
                                    <!-- '', -->
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getCode(); ?></td>
                                    <td style="width: 30%"><?php echo $ag->getLibelle(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteSousrubrique?') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerSousRurique()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function ChargerSousRubrique(id,bes, annee)
    {

        $('#my-modalSousRubrique').removeClass('in');
        $('#my-modalSousRubrique').css('display', 'none');
        $('#idSousRubrique').val(id);
        $('#idsousrubrique').val(bes);
        $('#sousrubrique').val(annee);

    }
    function fermerSousRurique()
    {
        $('#my-modalSousRubrique').removeClass('in');
        $('#my-modalSousRubrique').css('display', 'none');
    }

</script>


