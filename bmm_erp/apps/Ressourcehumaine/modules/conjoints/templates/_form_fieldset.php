<div class="col-lg-8">
<fieldset >
   
  <table>
            <tbody> <tr>
                      <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                     <td><label>Nom du Conjoints </label></td>
                    <td>
                        <?php echo $form['nom']->renderError() ?>
                        <?php echo $form['nom'] ?>
                    </td></tr> 
           
                <tr>
                   
                  
                    <td><label>Prenom du Conjoints</label></td>
                    <td>
                        <?php echo $form['prenom']->renderError() ?>
                        <?php echo $form['prenom'] ?></td>
                     <td><label>Etat de travail</label></td>
                <td>
                    <?php echo $form['etattravail']->renderError() ?>
                    <?php echo $form['etattravail'] ?>
                </td>
             
                </table></tbody>
      </fieldset>
</div>