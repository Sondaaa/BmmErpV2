<td style="width:15%">
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button  data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu " role="menu">

                <li>
                    <button type="button" onclick="document.location.href = '<?php echo url_for('historiqueretenue/edit') . '?id=' . $historiqueretenue->getId() ?>'"  
                            class="btn btn-primary width-fixed ">
                        <i class="ace-icon fa fa-edit bigger-110"></i>Modifier</button>
                </li>
                <li> 
                    <button  onclick="if (confirm('Etes-vous sûr?')) {
                                var f = document.createElement('form');
                                f.style.display = 'none';
                                this.parentNode.appendChild(f);
                                f.method = 'post';
                                f.action = 'historiqueretenue/delete?id=<?php echo $historiqueretenue->getId() ?>';
                                var m = document.createElement('input');
                                m.setAttribute('type', 'hidden');
                                m.setAttribute('name', 'sf_method');
                                m.setAttribute('value', 'delete');
                                f.appendChild(m);
                                f.submit();
                            }
                            ;
                            return false;" type="button" class="btn btn-outline btn-default width-fixed" ><i class="fa fa-bitbucket"></i>  Supprimer</button>
                </li>

            </ul>
        </div>
    </div>
</td>
<style>

    .width-fixed{
        min-width: 172px;
    }

</style>




