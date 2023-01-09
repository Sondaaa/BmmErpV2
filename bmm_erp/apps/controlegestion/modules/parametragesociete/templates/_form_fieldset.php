<fieldset>
  <legend>Fiche Paramètrage Sociète</legend>
  <ul class="nav nav-tabs">
    <li class="active">
      <a href="#home" data-toggle="tab" aria-expanded="true">
        <i class="green ace-icon fa fa-database bigger-120"></i> Données de base
      </a>
    </li>

    <?php if (!$form->getObject()->isNew()) { ?>
      <li><a href="#piece_joint" data-toggle="tab" aria-expanded="false" ng-click="initialChamps();">
          <i class="green ace-icon fa fa-money bigger-120"></i> Pièce Joint </a>

      </li><?php } ?>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade active in" id="home">
      <fieldset>
        <legend><i> Données de base</i></legend>
        <table>
          <tbody>
            <tr>
              <td><label> Société <span class="required">*</span></label></td>
              <td>
                <?php echo $form['id_societe']->renderError() ?>
                <?php echo $form['id_societe'] ?>
              </td>
              <td><label>Valeur Fodec</label></td>
              <td>
                <?php echo $form['valeurfodec']->renderError() ?>
                <?php echo $form['valeurfodec'] ?>
              </td>
            </tr>
            <tr>
              <td><label> Droit Timbre </label></td>
              <td>
                <?php echo $form['timbre']->renderError() ?>
                <?php echo $form['timbre'] ?>
              </td>
              <td><label>Seuil Achat TUNEPS </label></td>
              <td>
                <?php echo $form['seuil']->renderError() ?>
                <?php echo $form['seuil'] ?>
              </td>
              
            </tr>
            <tr>
            <td><label>Situation d'engagement </label></td>
              <td>
                <?php echo $form['is_engnegative']->renderError() ?>
                <?php echo $form['is_engnegative'] ?> Validation des engagements négative
              </td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </div>
    <?php if (!$form->getObject()->isNew()) { ?>
      <div  class="tab-pane fade " id="piece_joint" ng-controller="CtrlScan" >
        <?php
        $id = $form->getObject()->getId();
        $parametrage_societe = $form->getObject();
        include_partial('formscan', array('id' => $id, 'parametrage_societe' => $parametrage_societe));
        ?>
      </div>

    <?php } ?>
  </div>
</fieldset>