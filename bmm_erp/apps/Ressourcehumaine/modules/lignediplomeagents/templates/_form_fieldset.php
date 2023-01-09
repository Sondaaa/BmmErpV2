<div class="col-lg-6">
<fieldset >
   
  <table>
            <tbody>
                <tr>
                      <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                   
                    <td><label>Diplome</label></td>
                    <td>
                        <?php echo $form['id_diplome']->renderError() ?>
                        <?php echo $form['id_diplome'] ?>
                </tr>
                <tr>
                    <td><label>  libelle</label></td>
                    <td>
                        <?php echo $form['libelle']->renderError() ?>
                        <?php echo $form['libelle'] ?>
                    </td>
                  
                     <td><label>Annee</label></td>
                    <td>
                        <?php echo $form['annee']->renderError() ?>
                        <?php echo $form['annee'] ?>
                    </td></tr> 
             </table></tbody>
      </fieldset>
