
<div id="sf_admin_container">


    <div id="sf_admin_content">  
        <div  class="panel-body">
            <fieldset class="col-lg-12" >
                <table>
                    <tbody>
                        <tr>
                            <td><label>Agents</label></td>

                            <td > 
                                <?php echo $form['id_agents']->renderError() ?>
                                <?php echo $form['id_agents'] ?>
                            </td>

                            <td><label>Type(A/R/P)</label></td>
                            <td >
                                <?php echo $form['id_type']->renderError() ?>
                                <?php echo $form['id_type'] ?>

                            </td>
                            <td colspan="2" id="typeavanceretenue">
                                <?php
                                $magAvance = Doctrine_Core::getTable('avance')->findAll();
                                ?>


                                <div id="avance" style="display: none">
                                    <select id="magAvance" >
                                        <option></option>
                                        <?php foreach ($magAvance as $magA) { ?>
                                            <option value="<?php echo $magA->getId() ?>"><?php echo $magA ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php
                                $magRetenue = Doctrine_Core::getTable('retenue')->findAll();
                                ?>
                                <div id="retenue" style="display: none">
                                    <select id="magRetraite">
                                        <option></option>
                                        <?php foreach ($magRetenue as $magR) { ?>
                                            <option value="<?php echo $magR->getId() ?>"><?php echo $magR ?></option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <?php
                                $magpret = Doctrine_Core::getTable('pret')->findAll();
                                ?>
                                <div id="pret" style="display: none">
                                    <select id="magpret">
                                        <option></option>
                                        <?php foreach ($magpret as $magP) { ?>
                                            <option value="<?php echo $magP->getId() ?>"><?php echo $magP ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>

                        </tr>
                        
                        <tr>
                            <td><input id="detailavance" ></td>
                            <td><label>Date Demande </label></td>
                            <td>
                                <?php echo $form['datedemande']->renderError() ?>
                                <?php echo $form['datedemande'] ?>
                            </td>
                            <td><label>Mois </label></td>
                            <td class="disabledbutton">
                                <?php echo $form['mois']->renderError() ?>
                                <?php echo $form['mois'] ?>
                            </td>
                            <td><label>Montant </label></td>
                            <td class="disabledbutton">
                                <?php echo $form['montant']->renderError() ?>
                                <?php echo $form['montant'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Montant Pret </label></td>
                            <td class="disabledbutton">
                                <?php echo $form['montantvavance']->renderError() ?>
                                <?php echo $form['montantvavance'] ?>
                            </td>
                            <td><label>Montant mensuelle </label></td>
                            <td class="disabledbutton">
                                <?php echo $form['montantmensuelle']->renderError() ?>
                                <?php echo $form['montantmensuelle'] ?>
                            </td>
                            <td><label> Nombre de Mois </label></td>
                            <td class="disabledbutton">
                                <?php echo $form['nbrmois']->renderError() ?>
                                <?php echo $form['nbrmois'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>



            </fieldset>    
        </div>

    </div>  
</div>      
</div>


