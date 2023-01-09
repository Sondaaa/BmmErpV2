<div id="sf_admin_container">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin">Ajouter Carateristique Article</h4>
            </div>
            <div class="modal-body">

                <div class="modal-dialog" style="width: 100%">
                    <div class="modal-content">
                        <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="smaller lighter blue no-margin">Ajouter Les Caractéristiques Article</h3>
                </div> -->
                        <div class="modal-body">

                            <form class="mws-form">
                                <div class="mws-form-inline">
                                    <div class="wysiwyg-editor" id="editor1Stckable">


                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="row"></div>
                <div class="modal-footer">

                    <button type="button" value="Ajouter caractéristique" data-dismiss="modal" id="btnfil" class="btn btn-sm btn-primary  pull-left" onclick="AddCaracteristiqueStockable()">
                        Ajouter Caracteristique</button>
                    <button id="btnfermer" class="btn btn-sm  pull-right" data-dismiss="modal" onclick="annulerCarateristique()">
                        Fermer
                    </button>
                    <button type="button" value="Initialiser" class="btn  btn-sm btn-primary   pull-right" onclick="InitilaiserCarateristique()">
                        Initialiser </button>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function annulerCarateristique() {
        $('#my-carac_stockable').removeClass('in');
        $('#my-carac_stockable').css('display', 'none');
        InitilaiserCarateristique();
    }

    function InitilaiserCarateristique() {
        $('#editor1Stckable').val('');
        $('#editor1Stckable').html('');
    }

    function AddCaracteristiqueStockable() {
        var content = $("#editor1Stckable").html();
        content = content.replace(/&nbsp;/g, " ");
        $('#observation_stockable').val(content);
        //  annulerCarateristique();
        console.log('cqs');
        $('#my-carac_stockable').removeClass('in');
        $('#my-carac_stockable').css('display', 'none');
    }
</script>


<style>
    .wysiwyg-editor {
        max-height: 400px;
        height: 400px;
    }
</style>
<style>
    .table-tr {
        background-color: #006dcc;

    }
</style>