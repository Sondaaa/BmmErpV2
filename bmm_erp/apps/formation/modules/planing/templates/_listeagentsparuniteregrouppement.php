<div id="my-modalagentsUniteRegroupement" class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $unite = Doctrine_Core::getTable('unite')->findOneById($idd); ?>
                    
                    <?php $regr = Doctrine_Core::getTable('regroupementtheme')->findOneById($idr); ?>

                    <h4 class="smaller lighter blue no-margin"> Liste des Agents de   "<?php echo $unite->getLibelle(); ?> " participants à La Formation   "<?php echo $regr->getLibelle(); ?> " </h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                    <th style="width: 30%">Matricule</th>  
                                    <th style="width: 40%">Nom Complet</th> 
                                    <th style="width: 40%">Année </th> 
                                 
                                    <th style="display: none">Code Agents</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,regroupementtheme r,besoinsdeformation b,planing pl ,ligneplaning lp,contrat c , posterh p ,unite u  ')
                                        ->where('lp.id_besoins=b.id  and b.id_agents=a.id  and lp.id_regroupement=r.id')
                                        ->andWhere('lp.realise=true')
                                        ->andWhere('c.id_agents=a.id and c.id_posterh=p.id and p.id_unite=u.id')
                                        ->andWhere('u.id= ?', $idd)
                                        ->andWhere('r.id='.$idr)
                                        ->execute();
                                $i = 1;
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr style="cursor: pointer;" id="idde" >
                                        <td style="width: 10%"><?php echo $i; ?></td>
                                        <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                        <td style="width: 40%"><?php echo $ag->getNomcomplet(); ?> </td>
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
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteparuniteRegrouppement?idunite=' . $idd .'&idreg='.$idr ) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1"  class="btn  pull-left"  onclick="fermeragentsuniteRegr()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsuniteRegr()
    {
        $('#my-modalagentsUniteRegroupement').removeClass('in');
        $('#my-modalagentsUniteRegroupement').css('display', 'none');
    }

</script>


