<fieldset>
  <table>
    <tbody>
      <tr>
        <td><label> Code Magasin </label></td>
        <td>
          <?php echo $form['code']->renderError() ?>
          <?php echo $form['code'] ?>
        </td>

        <td><label> Nom Magasin </label></td>
        <td>
          <?php echo $form['libelle']->renderError() ?>
          <?php echo $form['libelle'] ?>
        </td>
      </tr>
      <tr>
        <td><label> Site </label></td>
        <td>
          <?php echo $form['id_site']->renderError() ?>
          <?php echo $form['id_site'] ?>
        </td>

        <td><label> Sous Site </label></td>
        <div id="soussite" class="disabledbutton">
          <td>
            <?php echo $form['id_etage']->renderError() ?>
            <?php echo $form['id_etage'] ?>
          </td>
        </div>
      </tr>
    </tbody>
  </table>
</fieldset>
<style></style>