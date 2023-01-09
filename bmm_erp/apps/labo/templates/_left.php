<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>



    <?php if ($user->getProfilApplication("Unité Gestion des Stocks") && !$user->getProfilApplication("Unité Achats")) : ?>
        <?php include_partial('global/menu', array('user' => $user)); ?>
    <?php endif ?>
    <?php if ($user->getProfilApplication("Unité Achats")&& !$user->getProfilApplication("Unité Gestion des Stocks")) : ?>
        <?php include_partial('global/menuachat', array('user' => $user)); ?>
    <?php endif ?>
    <?php if ($user->getProfilApplication("Unité Achats") && $user->getProfilApplication("Unité Gestion des Stocks")) : ?>
        <?php include_partial('global/menuachatetstock', array('user' => $user)); ?>
    <?php endif ?>

</div>