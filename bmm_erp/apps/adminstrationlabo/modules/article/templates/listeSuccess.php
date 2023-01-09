<div id="sf_admin_container">
    <h1 id="replacediv"> Article
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liste des Articles
        </small>
    </h1>
</div>
<?php $article_form = new ArticleForm(); ?>
<div class="sf_admin_filter col-xs-6">
    <form>
        <table cellspacing="0" style="margin-bottom: 0px;">
            <tbody>
                <tr>
                    <td><label>Code</label></td>
                    <td><input type="text" id="article_codeart" onkeyup="goPage(1)"></td>
                    <td><label>Désignation</label></td>
                    <td><input type="text" id="article_designation" onkeyup="goPage(1)"></td>
                </tr>
                <tr>
                    <td><label>Famille</label></td>
                    <td>
                        <?php $familles = FamillearticleTable::getInstance()->getAll(); ?>
                        <select id="article_id_famille" onchange="goPage(1)">
                            <option value=""></option>
                            <?php foreach ($familles as $famille): ?>
                                <option value="<?php echo $famille->getId(); ?>"><?php echo $famille; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><label>Sous Famille</label></td>
                    <td>
                        <?php $sous_familles = SousfamillearticleTable::getInstance()->getAll(); ?>
                        <select id="article_id_sousfamille" onchange="goPage(1)">
                            <option value=""></option>
                            <?php foreach ($sous_familles as $sous_famille): ?>
                                <option value="<?php echo $sous_famille->getId(); ?>"><?php echo $sous_famille; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td><label>Unité</label></td>
                    <td>
                        <?php $unites = UnitemarcheTable::getInstance()->findAll(); ?>
                        <select id="article_id_unite" onchange="goPage(1)">
                            <option value=""></option>
                            <?php foreach ($unites as $unite): ?>
                                <option value="<?php echo $unite->getId(); ?>"><?php echo $unite; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Nature</label></td>
                    <td>
                        <?php $natures = NaturearticleTable::getInstance()->getAll(); ?>
                        <select id="article_id_nature" onchange="goPage(1)">
                            <option value=""></option>
                            <?php foreach ($natures as $nature): ?>
                                <option value="<?php echo $nature->getId(); ?>"><?php echo $nature; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <a href="<?php echo url_for('article/liste'); ?>" class="btn btn-xs btn-success">Effacer</a>
                        <button onclick="goPage(1)" class="btn btn-xs btn-success">Filtrer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div> 

<div class="col-xs-4 widget-container-col" id="widget-container-col-1">
    <div class="widget-box" id="widget-box-1">
        <div class="widget-header">
            <div class="widget-toolbar">
                <a href="#" data-action="collapse" class="btn btn-xs btn-success">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main" style="padding: 5%; text-align: center;">
                <a href="<?php echo url_for('article/new'); ?>" class="btn btn-outline btn_new btn-success" style="text-align: center;width: 250px; font-size: 14px !important;font-weight: bold;">Nouvelle Fiche Article</a>
                <br><br>
                <a href="<?php echo url_for('article/exporter'); ?>" target="_blank" class="btn btn-outline btn-primary" style="text-align: center;width: 250px; font-size: 14px !important;font-weight: bold;">Exporter Liste Article</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="table-header blue" style="color: #FFF !important;">
            Liste des Articles
            <div style="float: right;">
                <div class="btn-group">
                    <button onclick="imprimer()" style="height: 38px;" class="btn btn-primary btn-white">
                        <i class="ace-icon fa fa-print"></i> 
                        Imprimer
                    </button>
                </div>
            </div>
        </div>
        <div id="zone_table">
            <table id="listArticle" class="table table-bordered table-hover">
                <thead>
                    <tr style="border-bottom: 1px solid #000000;">
                        <th style="width: 5%; text-align: center;">Code</th>
                        <th style="width: 23%; text-align: center;">Désignation</th>
                        <th style="width: 11%; text-align: center;">Famille</th>
                        <th style="width: 11%; text-align: center;">Sous Famille</th>
                        <th style="width: 8%; text-align: center;">Unité</th>
                        <th style="width: 8%; text-align: center;">Achat HT</th>
                        <th style="width: 8%; text-align: center;">T.V.A</th>
                        <th style="width: 7%; text-align: center;">Achat TTC</th>
                        <th style="width: 9%; text-align: center;">PAMP</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tfoot></tfoot>
                <tbody>
                    <?php include_partial("listeArticle", array("pager" => $pager, "page" => $page)); ?>
                </tbody>
            </table>

            <span id="loading_icon" style="display: none;" class="orange"><i class="ace-icon fa fa-spinner fa-spin orange bigger-190"></i> Chargement ... </span>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>


<script>

    function goPage(page) {
        $('#loading_icon').show();
        $.ajax({
            url: '<?php echo url_for('article/liste'); ?>',
            data: 'page=' + page +
                    '&code=' + $('#article_codeart').val() +
                    '&designation=' + $('#article_designation').val() +
                    '&famille=' + $('#article_id_famille').val() +
                    '&sous_famille=' + $('#article_id_sousfamille').val() +
                    '&nature=' + $('#article_id_nature').val(),
                    '&unite='+$('#article_id_unite').val()
            success: function (data) {
                $('#loading_icon').hide();
                if (page == 1) {
                    $('#listArticle tbody').html(data);
                    next_page = 2;
                    loadPage = true;
                } else {
                    $('#listArticle tbody').append(data);
                    next_page = next_page + 1;
                    loadPage = true;
                }
            }
        });
    }

    var next_page = 2;
    var loadPage = true;
    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= $('#zone_table').offset().top + $('#zone_table').outerHeight() - window.innerHeight) {
            if (loadPage == true) {
                loadPage = false;
                goPage(next_page);
            }
        }
    });

    function imprimer() {
        var code = $('#article_codeart').val();
        var designation = $('#article_designation').val();
        var famille = $('#article_id_famille').val();
        var sous_famille = $('#article_id_sousfamille').val();
        var nature = $('#article_id_nature').val();

        var url = '?code=' + code + '&designation=' + designation + '&famille=' + famille + '&sous_famille=' + sous_famille + '&nature=' + nature;

        url = '<?php echo url_for('article/imprimerListeArticle') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. de Stock : Liste des Articles");
</script>