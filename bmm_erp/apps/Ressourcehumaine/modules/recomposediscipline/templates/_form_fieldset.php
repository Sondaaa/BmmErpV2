<div class="col-lg-8">
<fieldset >
   
  <table>
            <tbody> <tr>
                      <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                     <td><label>Type Discipline </label></td>
                    <td>
                        <?php echo $form['id_typedecipline']->renderError() ?>
                        <?php echo $form['id_typedecipline'] ?>
                    </td></tr> 
           
                <tr>
                   
                  
                    <td><label>Source</label></td>
                    <td>
                        <?php echo $form['source']->renderError() ?>
                        <?php echo $form['source'] ?></td>
                     <td><label>Date</label></td>
                <td>
                    <?php echo $form['date']->renderError() ?>
                    <?php echo $form['date'] ?>
                </td>
                </tr>
               
                <tr> <td><label>  Explication</label></td>
                    <td colspan="4">
                        <?php echo $form['explication']->renderError() ?>
                        <?php echo $form['explication'] ?>
                    </td>
               
                </tr>
                </table></tbody>
      </fieldset>
</div>