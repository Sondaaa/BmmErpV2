<td style="width:20%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a id="btnimpexpo" class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>">Détail N°:<?php echo $documentachat->getNumerodocachat() ?></a>
                </li>
            </ul>
        </div>
    </div>
</td>