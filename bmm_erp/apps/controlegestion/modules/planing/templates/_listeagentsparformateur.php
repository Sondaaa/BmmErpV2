<div id="my-modalagentsFormateur" class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $for = Doctrine_Core::getTable('formateur')->findOneById($idd); ?>

                    <h4 class="smaller lighter blue no-margin"> Liste des Emplyés   participants à La Formation avec le Formateur    "<?php  echo $for->getNom() ." " .$for->getPrenom() ; ?>"  </h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                    <th style="width: 30%">Matricule</th>  
                                    <th style="width: 40%">Nom & Prénom</th> 
                                    <th style="width: 40%">Année </th>                                  
                                    <th style="display: none">Code Agents</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,besoinsdeformation b,planing pl ,ligneplaning lp')
                                        ->where('lp.id_besoins=b.id ')
                                        ->andWhere(' b.id_agents=a.id  ')
                                        ->andWhere('lp.realise=true')
                                        ->andWhere('lp.id_formateur= ?', $idd)
                                        ->execute();
                                $i = 1;
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr style="cursor: pointer;" id="idde" >
                                        <td style="width: 10%"><?php echo $i; ?></td>
                                        <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                        <td style="width: 40%"><?php echo $ag->getNomcomplet(). "" .$ag->getPrenom(); ?> </td>
                                        <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                     <td><?php echo $ag->getBesoinsdeformation()->getFirst()->getAnnee(); ?> </td>
                                    
                                    </tr>
    <?php
    $i++;
}
?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteparFormateur?idformateur=' . $idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1"  class="btn  pull-left"  onclick="fermeragentsParFormateur()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsParFormateur()
    {
        $('#my-modalagentsFormateur').removeClass('in');
        $('#my-modalagentsFormateur').css('display', 'none');
    }

</script>


