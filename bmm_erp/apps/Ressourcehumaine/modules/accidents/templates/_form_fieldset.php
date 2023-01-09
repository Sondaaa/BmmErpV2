<div class="col-lg-8">
<fieldset>
   
  <table>
            <tbody> <tr>
                      <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                     <td><label>Raison</label></td>
                    <td>
                        <?php echo $form['raison']->renderError() ?>
                        <?php echo $form['raison'] ?>
                    </td>
                   
                  
                    <td><label>Type</label></td>
                    <td>
                        <?php echo $form['type']->renderError() ?>
                        <?php echo $form['type'] ?></td>
                  </tr> 
           
                <tr>   <td><label>Adresse</label></td>
                <td>
                    <?php echo $form['adresse']->renderError() ?>
                    <?php echo $form['adresse'] ?>
                </td>
                
               
                 <td><label>  Date</label></td>
                    <td>
                        <?php echo $form['date']->renderError() ?>
                        <?php echo $form['date'] ?>
                    </td>
                    <td><label>Durée</label></td>
                    <td>
                        <?php echo $form['duree']->renderError() ?>
                        <?php echo $form['duree'] ?>
                    </td></tr>
               <td><label>Type handicap</label></td>
                    <td>
                        <?php echo $form['typehandicap']->renderError() ?>
                        <?php echo $form['typehandicap'] ?>
                    </td>
                </tr>
                
                </table></tbody>
      </fieldset>
</div>