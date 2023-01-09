<div id="sf_admin_container">
    <h1 id="replacediv"> Mouvement du stock
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Etat Mouvement du stock - Exercice <?php echo date('Y'); ?>
        </small>
    </h1>
</div>

<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding" style="min-height: 400px">
        <form>
            <div class="mws-form-inline">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <!-- <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;">Ordre d'affichage</th>
                                <th style="text-align:left; padding-left: 1%; width: 10%; font-weight: bold;"></th> -->
                                <th style="text-align:left; padding-left: 1%; width: 40%; font-weight: bold;">Articles</th>
                                <th style="text-align:left; padding-left: 1%; width: 30%; font-weight: bold;">Période</th>
                                <th style="text-align:left; padding-left: 1%; width: 20%; font-weight: bold;"></th>
                            </tr>
                        </thead>
                        <tr>
                            <!-- <td>
                                <input type="radio" name="ordre" checked="checked" value="chronologique" /> Chronologique
                                <br><br> -->
                                <!--                                <input type="radio" name="ordre" value="lettrage"/> Lettrage
                                <br><br>-->
                            <!-- </td>
                            <td><input type="checkbox" id="toutlivre" checked="checked" /> Tout</td> -->
                            <td>
                                <select id="compte_min">
                                    <?php foreach ($articles as $article) : ?>
                                        <option value="<?php echo $article->getId() ?>"><?php echo $article->getCodeart() . ' ' . $article->getDesignation() ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </td>
                            <td>
                                Du<input type="date" id="date_debut" />  Au
                                <input type="date" id="date_fin" />
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button onclick="afficher()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div><span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Traitement en cours .........................</span></div>

                <div class="mws-panel grid_8" id="liste_etat_livre" style="margin-top: 20px;">

                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    // $('#article_min').change(function() {
    //     var article_min = $(this).val();
    //     $('#article_min').val(article_min).trigger('chosen:updated');
    // });

    function afficher() {
        $('#loading_save_icon').fadeIn();
        var order = '';
       
        $.ajax({
            url: '<?php echo url_for('lignemouvemententetestock/afficherEtatArticle') ?>',
            data: 'article_min=' + $('#compte_min').val() +
                '&date_debut=' + $('#date_debut').val() + '&date_fin=' + $('#date_fin').val() ,
            success: function(data) {
                $('#loading_save_icon').fadeOut();
                $('#liste_etat_livre').html(data);
            }
        });
    }
</script>