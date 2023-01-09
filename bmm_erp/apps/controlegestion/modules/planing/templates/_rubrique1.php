<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Rubriques</h4>
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
                                    ->from('rubriqueformation')
                                    ->execute();
                            $ag = new Rubriqueformation();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="id" ondblclick="ChargerRubrique1('<?php echo $ag->getId(); ?>','<?php echo $ag->getCode(); ?>','<?php echo $ag->getLibelle(); ?>')">
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
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteRubrique') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerRurique1()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function ChargerRubrique1(id,bes, annee)
    {

        $('#my-modalRubrique1').removeClass('in');
        $('#my-modalRubrique1').css('display', 'none');
        $('#idRub').val(id);
        $('#idrubrique1').val(bes);
        $('#rubrique1').val(annee);

    }
    function fermerRurique1()
    {
        $('#my-modalRubrique1').removeClass('in');
        $('#my-modalRubrique1').css('display', 'none');
    }

</script>


