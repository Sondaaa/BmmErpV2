<div class="col-lg-8">
<fieldset >
   
  <table>
            <tbody> <tr>
                      <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                     <td><label>Type Expérience </label></td>
                    <td>
                        <?php echo $form['id_typeexperience']->renderError() ?>
                        <?php echo $form['id_typeexperience'] ?>
                    </td></tr> 
           
                <tr>
                   
                  
                    <td><label>Organistaion</label></td>
                    <td>
                        <?php echo $form['organistaion']->renderError() ?>
                        <?php echo $form['organistaion'] ?></td>
                     <td><label>Date</label></td>
                <td>
                    <?php echo $form['date']->renderError() ?>
                    <?php echo $form['date'] ?>
                </td>
                </tr>
               
                <tr> 
                    <td><label>Durée</label></td>
                <td>
                    <?php echo $form['duree']->renderError() ?>
                    <?php echo $form['duree'] ?>
                </td>
                    <td><label>  Description</label></td>
                    <td>
                        <?php echo $form['description']->renderError() ?>
                        <?php echo $form['description'] ?>
                    </td>
               
                </tr>
                </table></tbody>
      </fieldset>
</div>