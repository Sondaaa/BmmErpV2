<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Formateurs</h4>
            </div>

            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">N° </th> 
                                <th style="width: 10%">Cin</th>  
                                <th style="width: 30%">Nom</th>  
                                <th style="width: 30%">Prenom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('formateur')
                                    ->execute();
                            $ag = new Formateur();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="idorga" ondblclick="chargerFormateur0('<?php echo $ag->getId(); ?>','<?php echo $ag->getCin(); ?>','<?php echo $ag->getNom()." ". $ag->getPrenom(); ?>')">
                                    <!-- ', '<?php //echo $ag->getNom() ;?>'', -->
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getCin(); ?></td>
                                    <td style="width: 30%"><?php echo $ag->getNom(); ?></td>
                                    <td style="width: 30%"><?php echo $ag->getPrenom(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteFormateur') ?>" class="btn  btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a> 
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermerFormateur()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chargerFormateur0(id,cin,nomprenom)
    {
        //alert('jn');

        $('#my-modal7').removeClass('in');
        $('#my-modal7').css('display', 'none');
        $('#idF').val(id);
        $('#idFormateur').val(cin);
        $('#formateur').val(nomprenom);

    }
    function fermerFormateur()
    {
        $('#my-modal7').removeClass('in');
        $('#my-modal7').css('display', 'none');
    }

</script>


