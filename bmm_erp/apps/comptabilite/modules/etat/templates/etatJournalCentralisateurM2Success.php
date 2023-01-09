<div id="sf_admin_container">
    <h1 id="replacediv"> Etat
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Etat du Journal Centralisateur
        </small>
    </h1>

</div>
<?php $exercice = ExerciceTable::getInstance()->getAllByDossier($_SESSION['dossier_id']); ?>
<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding" style="min-height: 400px">
        <form>
            <div class="mws-form-inline">
                <div>
                    <table>
                        <tr>
                            <td> <label>Exrecice Comptable </label></td>
                            <td>  
                                <select id='exercice' class="chosen-select form-control"  data-placeholder="Déterminez l'exercice comptable" >
                                    <option value=""></option>
                                    <?php foreach ($exercice as $ex): ?>
                                        <option <?php if($ex->getlibelle() == $exercice ):?>selected="true"<?php endif;?>
                                            value="<?php echo $ex->getId() ?>"><?php echo trim($ex->getLibelle()); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td style="text-align: center;">
                                <button style="cursor:pointer;" onclick="afficherJournalcentralisateur()" class="btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-search bigger-110"></i>
                                    <span class="bigger-110 no-text-shadow">Afficher</span>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                       <div><span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Traitement en cours .........................</span></div>
             
                <div class="mws-panel grid_8" id="liste_etat_journal_centralisateur">

                </div>
            </div>
        </form>
    </div>
</div>





<script  type="text/javascript">

    function afficherJournalcentralisateur() {
         $('#loading_save_icon').fadeIn();
        if ($('#exercice').val() != '') {
            $.ajax({
                url: '<?php  echo url_for('etat/etatJournalCentralisateur')?>',
                data: 'exercice=' + $('#exercice').val()
                ,
                success: function (data) {
                     $('#loading_save_icon').fadeOut();
                    $('#liste_etat_journal_centralisateur').html(data);
                    console.log('add clone');
                    jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir un exrecice comptable !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm",
                                    }
                        }
            });
        }
    }

</script>



<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .tab_filter tbody td { 
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px ;
    }
    tr:hover{color: #2679b5;}
</style>

<style>

    .table-scroll {
        position:relative;
        max-width:100%;
        margin:auto;
        overflow:hidden;
        width: 100%;
        border:1px solid #fff;
    }
    .table-wrap {
        width:100%;
        border:1px solid #000;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border:1px solid #000;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        padding:5px 10px;
        border:1px solid #000;
        white-space:nowrap;
        vertical-align:top;
    }
    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
        border:1px solid #000;
    }
    .clone th, .clone td {
        visibility:hidden;
        
        
    }
    .clone td, .clone th {
        border-color:transparent
    }
    .clone tbody th {
        visibility:visible;
    }
    .clone .fixed-side {
        visibility:visible;
        background-color: #fff;
        background: repeat-x #F2F2F2;
        border: solid 1px #000;
    }
    .clone thead, .clone tfoot{background:transparent;}

</style>

