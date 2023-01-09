<div class="col-lg-12">
<fieldset>
   
  <table>
            <tbody> <tr>
                     <td><label>Titre Prime</label></td>
                     <td>
                    <?php echo $form['id_titreprime']->renderError() ?>
                    <?php echo $form['id_titreprime'] ?>
                </td>
                      <td><label>Fonction </label></td>
                    <td>
                        <?php echo $form['id_fonction']->renderError() ?>
                        <?php echo $form['id_fonction'] ?>
                    </td>
                     <td><label>Categorie</label></td>
                    <td>
                        <?php echo $form['id_categorie']->renderError() ?>
                        <?php echo $form['id_categorie'] ?>
                    </td>
                   
                   
                </tr>
                <tr> <td><label>Grade</label></td>
                    <td>
                        <?php echo $form['id_grade']->renderError() ?>
                        <?php echo $form['id_grade'] ?>
                    </td>
                    <td><label>Corps</label></td>
                    <td>
                        <?php echo $form['id_corpsdet']->renderError() ?>
                        <?php echo $form['id_corpsdet'] ?>
                    </td>
                     
                    <td><label>Sous Corps</label></td>
                    <td>
                        <?php echo $form['id_souscorps']->renderError() ?>
                        <?php echo $form['id_souscorps'] ?>
                    </td></tr><tr>
                    <td><label>Salaire de base</label></td>
                    <td>
                        <?php echo $form['salairedebase']->renderError() ?>
                        <?php echo $form['salairedebase'] ?></td>
                
                     <td><label>Poste</label></td>
                    <td>
                        <?php echo $form['id_poste']->renderError() ?>
                        <?php echo $form['id_poste'] ?>
                    </td>
               <td><label>  Montant</label></td>
                    <td>
                        <?php echo $form['montant']->renderError() ?>
                        <?php echo $form['montant'] ?>
                    </td>
               
                </tr>
                </table></tbody>
      </fieldset>
</div>