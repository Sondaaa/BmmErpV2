<div id="sf_admin_container" ng-controller="CtrlRessourcehumaine">
    <div id="sf_admin_content">  
        <div  class="panel-body">
            <div class="tab-content">  
                <div class="tab-pane fade active in" id="homeouvrier">
                    <fieldset>
                        <div class="col-lg-12"> <legend><i> Données de base</i></legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Matricule</label><span class="align2"> (الرقم)</span></td>
                                        <td>      
                                            <?php echo $form['matricule']->renderError() ?>
                                            <?php echo $form['matricule'] ?>
                                        </td>
                                        <td><label>CIN</label><span class="align2">(رقم ب ت و)</span></td>
                                        <td>
                                            <?php echo $form['cin']->renderError() ?>
                                            <?php echo $form['cin'] ?>
                                        </td>
                                        <td><label>Nom</label><span class="align2">(اللقب ) </span></td>
                                        <td>
                                            <?php echo $form['nom']->renderError() ?>
                                            <?php echo $form['nom'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Prénom</label><span class="align2"> (الإسم)</span></td>
                                        <td>
                                            <?php echo $form['prenom']->renderError() ?>
                                            <?php echo $form['prenom'] ?>
                                        </td>
                                        <td><label>Date Naissance</label><span class="align2">(تاريخ الولادة )</span></td>
                                        <td>
                                            <?php echo $form['datenaissance']->renderError() ?>
                                            <?php echo $form['datenaissance'] ?>
                                        </td>
                                        <td><label>Lieu Naissacance</label><span class="align2">(مكان الولادة)</span></td>
                                        <td>
                                            <?php echo $form['id_lieunaissance']->renderError() ?>
                                            <?php echo $form['id_lieunaissance'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label> Adresse</label><span class="align2">(العنوان) </span></td>
                                        <td colspan="3">
                                            <?php echo $form['adresse']->renderError() ?>
                                            <?php echo $form['adresse'] ?>
                                        </td>
                                        <td><label> Ville</label><span class="align2">(المدينة ) </span></td>
                                        <td>
                                            <?php echo $form['id_gouv']->renderError() ?>
                                            <?php echo $form['id_gouv'] ?>
                                        </td>  
                                    </tr>
                                    <tr>
                                        <td><label> Sexe</label><span class="align2">(الجنس ) </span></td>
                                        <td>
                                            <?php echo $form['id_sexe']->renderError() ?>
                                            <?php echo $form['id_sexe'] ?>
                                        </td>
                                        <td><label>Identifiant unique(CNRPS)</label><span class="align2">(المعرف )</span></td>
                                        <td>
                                            <?php echo $form['idcnrps']->renderError() ?>
                                            <?php echo $form['idcnrps'] ?>
                                        </td>
                                        <td><label>Date d'affiliation</label><span class="align2"> (تاريخ الإنخراط ) </span></td>
                                        <td>
                                            <?php echo $form['dateafficliation']->renderError() ?>
                                            <?php echo $form['dateafficliation'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>RIP/B </label><span class="align2">(الحساب)</span></td> 
                                        <td>
                                            <?php echo $form['rib']->renderError() ?>
                                            <?php echo $form['rib'] ?>
                                        </td>
                                        <td><label> Situation familiale </label><span class="align2">(الحالة )</span></td>
                                        <td>
                                            <?php echo $form['id_situation']->renderError() ?>
                                            <?php echo $form['id_situation'] ?>
                                        </td> 
                                        <td><label>Nombre enfants</label><span class="align2"> (الأبناء)</span></td> 
                                        <td>
                                            <?php echo $form['nbrenfant']->renderError() ?>
                                            <?php echo $form['nbrenfant'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </fieldset>        
                </div>
            </div>
        </div>  
    </div>      
</div>
<style>

    .align2{float: right;}

</style>