<div class="col-lg-8">
<fieldset >
   
  <table>
            <tbody> <tr>
                      <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                     <td><label>Nom </label></td>
                    <td>
                        <?php echo $form['nom']->renderError() ?>
                        <?php echo $form['nom'] ?>
                    </td></tr> 
           
                <tr>
                   
                  
                    <td><label>Prenom</label></td>
                    <td>
                        <?php echo $form['prenom']->renderError() ?>
                        <?php echo $form['prenom'] ?></td>
                     <td><label>Date de naissance</label></td>
                <td>
                    <?php echo $form['datenaissance']->renderError() ?>
                    <?php echo $form['datenaissance'] ?>
                </td>
                </tr>
                <tr>
                <td><label>Observation  </label></td>
                <td colspan="4">
                    <?php echo $form['observtaion']->renderError() ?>
                    <?php echo $form['observtaion'] ?>
                </td>
                </tr>
                </table></tbody>
      </fieldset>
</div>