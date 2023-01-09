<ul  id="tree2<?php echo $article->getId(); ?>">

</ul>
<?php $listesdocs = $article->MouvementStock(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        var sampleData = initiateDemoData();//see below
        $('#tree2<?php echo $article->getId(); ?>').ace_tree({
            dataSource: sampleData['dataSource2'],
            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
            'open-icon': 'ace-icon fa fa-folder-open',
            'close-icon': 'ace-icon fa fa-folder',
            'itemSelect': true,
            'folderSelect': true,
            'multiSelect': true,
            'selected-icon': null,
            'unselected-icon': null,
            'folder-open-icon': 'ace-icon tree-plus',
            'folder-close-icon': 'ace-icon tree-minus'
        });
        function initiateDemoData() {
            var tree_data_2 = {
                'pictures': {text: '<?php echo trim($article) ?>', type: 'folder', 'icon-class': 'red'},
            }

            tree_data_2['pictures']['additionalParameters'] = {
                'children': {
                    'wallpapers': {text: 'STOCK INITAL', type: 'folder', 'icon-class': 'pink'},
                    'mouvement': {text: 'MOUVEMENT', type: 'folder', 'icon-class': 'pink'}
                }
            }
            tree_data_2['pictures']['additionalParameters']['children']['wallpapers']['additionalParameters'] = {
                'children': [
                    {text: <?php
                                $art = new Article();
                                $art = $article;
                                echo "'  " . 'DATE=  ' . $art->getDatecreation() .'  | TYPE= STOCK INITIAL | QTE= ' . $art->getStockreel() . ' |  PAMP= ' . $art->getPamp() . "'";
                                ?>, type: 'item'}

                ]
            }
            tree_data_2['pictures']['additionalParameters']['children']['mouvement']['additionalParameters'] = {
            'children': [
<?php
foreach ($listesdocs as $lignedoc) {
    $qte=$article->getStockByDate($lignedoc);;
    
    $text = "'" . 'DATE=  ' . $lignedoc['datecreation'] .' |STOCK='.$qte . ' | TYPE= ' . trim($lignedoc['type']) . ' | QTE= ' . $lignedoc['qte'] . ' |  PAMP= ' . $lignedoc['pamp'] .' | MGASIN='.$lignedoc['magasin']. "'";
    ?>
                {text:<?php echo $text; ?>, type: 'item'},
    <?php
}
?>
           
            ]
        }





        var dataSource2 = function (options, callback) {
            var $data = null
            if (!("text" in options) && !("type" in options)) {
                $data = tree_data_2;//the root tree
                callback({data: $data});
                return;
            }
            else if ("type" in options && options.type == "folder") {
                if ("additionalParameters" in options && "children" in options.additionalParameters)
                    $data = options.additionalParameters.children || {};
                else
                    $data = {}//no data
            }

            if ($data != null)//this setTimeout is only for mimicking some random delay
                setTimeout(function () {
                    callback({data: $data});
                }, parseInt(Math.random() * 500) + 200);

            //we have used static data here
            //but you can retrieve your data dynamically from a server using ajax call
            //checkout examples/treeview.html and examples/treeview.js for more info
        }


        return {'dataSource2': dataSource2}
    }

    });
</script>
<!--<a ng-click="DetailMouvement(<?php //echo $article->getId() ?>)"> Detail </a>
<script type="text/javascript">
    jQuery(function ($) {
        
        $('#tree2<?php //echo $article->getId(); ?>').ace_tree({
            dataSource: '',
            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
            'open-icon': 'ace-icon fa fa-folder-open',
            'close-icon': 'ace-icon fa fa-folder',
            'itemSelect': true,
            'folderSelect': true,
            'multiSelect': true,
            'selected-icon': null,
            'unselected-icon': null,
            'folder-open-icon': 'ace-icon tree-plus',
            'folder-close-icon': 'ace-icon tree-minus'
        });
        
    });
</script>-->
