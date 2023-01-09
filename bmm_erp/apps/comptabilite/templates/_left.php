<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {}
            </script>

            
            <!-- /.sidebar-shortcuts -->

            <?php if ($_SESSION['exercice'] == null) : ?>
                                <?php include_partial('global/menu', array('user' => $user)); ?>
                            <?php else : ?>
                                <?php include_partial('global/menu_all', array('user' => $user)); ?>
                            <?php endif; ?>
            
        </div>