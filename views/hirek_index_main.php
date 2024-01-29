<?php foreach ($viewData['hirek'] as $hir) { ?>
<div class="container" >
    <article class="hir">
        <h1><a href="<?php echo SITE_ROOT ?>hirek/<?php echo $hir['id']; ?>"><?php echo $hir['cim']; ?></a></h1>
        <p><?php echo $hir['bejelentkezes']; ?> - <?php echo $hir['ido']; ?></p>

        <p><?php echo $hir['bevezeto']; ?></p>
    </article>
</div>
<?php } ?>
