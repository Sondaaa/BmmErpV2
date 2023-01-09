<div id="my-modalagentRubrique" class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $rubrique = Doctrine_Core::getTable('rubriqueformation')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Emplyés particpants à  La Formation du  Rubrique "<?php echo $rubrique->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                <th style="width: 30%">Matricule</th>  
                                <th style="width: 40%">Nom & Prénom</th> 
                                <th style="display: none">Code Agents</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,regroupementtheme r,sousrubrique s , contrat c , besoinsdeformation b, planing p ,ligneplaning lp')
                                        ->where('lp.id_besoins=b.id  and b.id_agents=a.id  ')
                                        ->andWhere('lp.realise=true')
                                        ->andWhere('lp.id_sousrubrique=s.id')
                                        ->andWhere('s.id_rubrique= ?', $idd)
                                        ->execute();
            $i=1;
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr style="cursor: pointer;" id="idde" >

                                        <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                    <td style="width: 40%"><?php echo $ag->getNomcomplet() ." " .$ag->getPrenom(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                    </tr>
                                    <?php
                   $i++;             }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteparrubrique?idrubrique='.$idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1"  class="btn  pull-left"  onclick="fermeragentsRubrique()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsRubrique()
    {
        $('#my-modalagentRubrique').removeClass('in');
        $('#my-modalagentRubrique').css('display', 'none');
    }

</script>


