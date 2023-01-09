<div class="row">
    <?php
    if ($form->getObject()->isNew()) {
        $id = $form->getObject()->getId();
       
        $alimentation = $form->getObject();
      
        include_partial('Scan/formscan_alimentation', array('id' => $id, 'alimentation' => $alimentation));
    }
    ?>
</div>