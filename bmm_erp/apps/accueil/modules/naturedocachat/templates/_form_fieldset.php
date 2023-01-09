<?php
$users = UtilisateurTable::getInstance()->findAll();
$array = [];
if (!$form->getObject()->isNew() && $form->getObject()->getIdUser())
  $array = json_decode($form->getObject()->getIdUser());
?>
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header widget-header-flat">
        <h4 class="widget-title smaller">Fiche Nature Document achat</h4>
      </div>
      <div class="widget-body">
        <div class="widget-main" style="min-height: 200px;">
          <form>
            <div class="row">
              <div class="col-md-8">
                <fieldset>
                  <table>
                    <tbody>
                      <tr>
                        <?php if (!$form->getObject()->isNew()) :
                        ?>
                          <input type="hidden" value="<?php if ($naturedocachat) echo $naturedocachat->getId(); ?>" id="id_user">
                        <?php endif;
                        ?>

                        <td <?php if (!$form->getObject()->isNew()) : ?>class="disabledbutton" <?php endif; ?>>
                          <label> Code </label>
                          <?php echo $form['code']->renderError() ?>
                          <?php echo $form['code'] ?>
                        </td>


                        <td <?php if (!$form->getObject()->isNew()) : ?>class="disabledbutton" <?php endif; ?>>
                          <label> Libellé </label>
                          <?php echo $form['libelle']->renderError() ?>
                          <?php echo $form['libelle'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6">
                          <legend> Liste des Utilisateur</legend>
                          <div class="col-lg-12">
                            <select id="exp" name="id_user[]" multiple="multiple">
                              <option value="0"></option>
                              <?php foreach ($users as $a) : ?>
                                <?php if (in_array($a->getId(), $array)) : ?>
                                  <option value="<?php echo $a->getId(); ?>" selected="selected">
                                    <?php echo  $a->getAgents(); ?></option>
                                <?php else : ?>
                                  <option value="<?php echo $a->getId(); ?>">
                                    <?php echo  $a->getAgents(); ?></option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </fieldset>
              </div>

            </div>


          </form>
          <div class="form-actions center" style="margin-bottom: 0px; margin-top: 0px;">
            <a href="<?php echo url_for('@naturedocachat') ?>" class="btn btn-xs btn-success">Retour à la liste</a>
            <input id="save_button" value="Enregistrer " type="submit" class="btn btn-sm btn-success">
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

</div>
<script type="text/javascript">
  $('.chosen-container').trigger("chosen:updated");
</script>