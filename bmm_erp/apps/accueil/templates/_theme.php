<div class="ace-settings-container" id="ace-settings-container">
    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
        <i class="ace-icon fa fa-cog bigger-130"></i>
    </div>
    <div class="ace-settings-box clearfix" id="ace-settings-box" ng-app="Appdoc" ng-controller="Ctrluserprofile">
        <div class="pull-left width-50">
            <div class="ace-settings-item" >
                <div class="pull-left">
                    <select  id="skin-colorpicker" class="hide" >
                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                    </select>
                </div>
                <span>&nbsp; Sél.fond</span>
            </div>
            <div class="ace-settings-item">
                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                <label class="lbl" for="ace-settings-add-container">
                    Inside
                    <b>.container</b>
                </label>
            </div>
        </div><!-- /.pull-left -->

        <div class="pull-left width-50">
            <button class="btn btn-xs btn-success" ng-click="changeMotif(<?php echo $user->getId() ?>)">
                <i class="ace-icon fa fa-check bigger-120"></i>
            </button>
        </div><!-- /.pull-left -->
    </div><!-- /.ace-settings-box -->
</div><!-- /.ace-settings-container -->