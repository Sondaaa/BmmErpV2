<div id="sf_admin_container">
    <h1>Erreur 404</h1>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

            <div class="error-container">
                <div class="well">
                    <h1 class="grey lighter smaller">
                        <span class="blue bigger-125">
                            <i class="ace-icon fa fa-sitemap"></i>
                            404
                        </span>
                        La page demandée n'est malheureusement pas disponible
                    </h1>

                    <hr />
                    <h3 class="lighter smaller">Nous avons cherché partout mais nous n'avons pas pu le trouver!</h3>

                    <div>
                        <form class="form-search">
                            <span class="input-icon align-middle">
                                <i class="ace-icon fa fa-search"></i>

                                <input type="text" class="search-query" placeholder="Chercher..." />
                            </span>
                            <button class="btn btn-sm" type="button">Go!</button>
                        </form>

                        <div class="space"></div>
                        <h4 class="smaller">Essayez une des solutions suivantes:</h4>

                        <ul class="list-unstyled spaced inline bigger-110 margin-15">
                            <li>
                                <i class="ace-icon fa fa-hand-o-right blue"></i>
                                Vérifier l'URL pour les fautes de frappe
                            </li>

                            <li>
                                <i class="ace-icon fa fa-hand-o-right blue"></i>
                                Lire la FAQ (Frequently Asked Questions)
                            </li>

                            <li>
                                <i class="ace-icon fa fa-hand-o-right blue"></i>
                                Dis nous à propos de cela
                            </li>
                        </ul>
                    </div>

                    <hr />
                    <div class="space"></div>

                    <div class="center">
                        <a href="javascript:history.back()" class="btn btn-grey">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Retourner
                        </a>

                        <a href="<?php echo url_for('@homepage'); ?>" class="btn btn-primary">
                            <i class="ace-icon fa fa-tachometer"></i>
                            accueil
                        </a>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<script  type="text/javascript">
    document.title = ("BMM - Gestion d'Achat : Erreur 404");
</script>