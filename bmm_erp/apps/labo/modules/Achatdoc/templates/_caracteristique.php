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
                                    <div class="wysiwyg-editor" id="editor1">


                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="row"></div>
                <div class="modal-footer">

                    <button type="button" value="Ajouter caractéristique" data-dismiss="modal" id="btnfil" class="btn btn-sm btn-primary  pull-left" onclick="AddCaracteristique()">
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
        $('#my-carac').removeClass('in');
        $('#my-carac').css('display', 'none');
        InitilaiserCarateristique();
    }

    function InitilaiserCarateristique() {
        $('#editor1').val('');
        $('#editor1').html('');
    }

    function AddCaracteristique() {

        var content = $("#editor1").html();
        content = content.replace(/&nbsp;/g, " ");
        $('#observation').text(content).html();
        // console.log('cqs');
        $('#my-carac').removeClass('in');
        $('#my-carac').css('display', 'none');
    }
</script>
<script type="text/javascript">
    function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
        } else { //console.log("error uploading file", reason, detail);
        }
        // $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' + '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
    }

    //but we want to change a few buttons colors for the third style
    $('#editor1').ace_wysiwyg({
        toolbar: ['font',
            null,
            'fontSize',
            null,
            {
                name: 'bold',
                className: 'btn-info'
            },
            {
                name: 'italic',
                className: 'btn-info'
            },
            {
                name: 'strikethrough',
                className: 'btn-info'
            },
            {
                name: 'underline',
                className: 'btn-info'
            },
            null,
            {
                name: 'insertunorderedlist',
                className: 'btn-success'
            },
            {
                name: 'insertorderedlist',
                className: 'btn-success'
            },
            {
                name: 'outdent',
                className: 'btn-purple'
            },
            {
                name: 'indent',
                className: 'btn-purple'
            },
            null,
            {
                name: 'justifyleft',
                className: 'btn-primary'
            },
            {
                name: 'justifycenter',
                className: 'btn-primary'
            },
            {
                name: 'justifyright',
                className: 'btn-primary'
            },
            {
                name: 'justifyfull',
                className: 'btn-inverse'
            },
            null,
            {
                name: 'createLink',
                className: 'btn-pink'
            },
            {
                name: 'unlink',
                className: 'btn-pink'
            },
            null,
            {
                name: 'insertImage',
                className: 'btn-success'
            },
            null,
            'foreColor',
            null,
            {
                name: 'undo',
                className: 'btn-grey'
            },
            {
                name: 'redo',
                className: 'btn-grey'
            }
        ],
        'wysiwyg': {
            fileUploadError: showErrorAlert
        }
    }).prev().addClass('wysiwyg-style2');

    function setFormat(which) {
        var toolbar = $('#editor1').prev().get(0);
        if (which >= 1 && which <= 4) {
            toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g, '');
            if (which == 1)
                $(toolbar).addClass('wysiwyg-style1');
            else if (which == 2)
                $(toolbar).addClass('wysiwyg-style2');
            if (which == 4) {
                $(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
            } else
                $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
        }
    }

    setFormat(4);

    //RESIZE IMAGE

    //Add Image Resize Functionality to Chrome and Safari
    //webkit browsers don't have image resize functionality when content is editable
    //so let's add something using jQuery UI resizable
    //another option would be opening a dialog for user to enter dimensions.
    if (typeof jQuery.ui !== 'undefined' && ace.vars['webkit']) {
        var lastResizableImg = null;

        function destroyResizable() {
            if (lastResizableImg == null)
                return;
            lastResizableImg.resizable("destroy");
            lastResizableImg.removeData('resizable');
            lastResizableImg = null;
        }

        var enableImageResize = function() {
            $('.wysiwyg-editor')
                .on('mousedown', function(e) {
                    var target = $(e.target);
                    if (e.target instanceof HTMLImageElement) {
                        if (!target.data('resizable')) {
                            target.resizable({
                                aspectRatio: e.target.width / e.target.height,
                            });
                            target.data('resizable', true);

                            if (lastResizableImg != null) { //disable previous resizable image
                                lastResizableImg.resizable("destroy");
                                lastResizableImg.removeData('resizable');
                            }
                            lastResizableImg = target;
                        }
                    }
                })
                .on('click', function(e) {
                    if (lastResizableImg != null && !(e.target instanceof HTMLImageElement)) {
                        destroyResizable();
                    }
                })
                .on('keydown', function() {
                    destroyResizable();
                });
        }

        enableImageResize();

        /**
         //or we can load the jQuery UI dynamically only if needed
         if (typeof jQuery.ui !== 'undefined') enableImageResize();
         else {//load jQuery UI if not loaded
         //in Ace demo ./components will be replaced by correct components path
         $.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
         enableImageResize()
         });
         }
         */
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