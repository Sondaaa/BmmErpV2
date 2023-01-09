<?php use_helper('I18N', 'Date') ?>
<?php include_partial('agents/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Liste du personnel', array(), 'messages') ?></h1>

    <?php include_partial('agents/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('agents/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('agents/filters', array('form' => $filters, 'configuration' => $configuration, 'regroupement' => $regroupement)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('agents_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('agents/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <!--    <ul class="sf_admin_actions">
            <?php // include_partial('agents/list_batch_actions', array('helper' => $helper)) ?>
            <?php include_partial('agents/list_actions', array('helper' => $helper)) ?>
                </ul>-->
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('agents/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<?php
//$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
//$query_table_names = "SELECT table_name FROM information_schema.tables WHERE table_type='BASE TABLE' AND table_schema='public' order by table_name";
//$query_structure = "SELECT * FROM information_schema.columns WHERE table_schema = 'public' AND table_name = 'agents'";
//$tableau_structure = $conn->fetchAssoc($query_structure);
//$tableau_table_names = $conn->fetchAssoc($query_table_names);

//for ($h = 0; $h < sizeof($tableau_structure); $h++):
//    echo $tableau_structure[$h]['column_name'] . ' | Type : ' . $tableau_structure[$h]['data_type'] . '<br>';
//endfor;
//print_r($tableau_table_names);
?>
<!--<br>
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-6">
            <select>
                <option value=""></option>
                <?php // for ($h = 0; $h < sizeof($tableau_table_names); $h++): ?>
                    <option value="<?php // echo $tableau_table_names[$h]['table_name'] ?>"><?php // echo $tableau_table_names[$h]['table_name'] ?></option>
                <?php // endfor; ?>
            </select>
        </div>
        <div class="col-sm-6">

        </div>
    </div>
</div>-->