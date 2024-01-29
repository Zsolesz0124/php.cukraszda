<div class="container" >
<article class="hir bg-light p-3 mb-3"">
    <h1><?php echo $viewData['hir']['cim']; ?></h1>
    <p><?php echo $viewData['hir']['bejelentkezes']; ?> - <?php echo $viewData['hir']['ido']; ?></p>

    <p><?php echo $viewData['hir']['torzs']; ?></p>
</article>

    <section>
        <?php $velemenyekSzama = count($viewData['velemenyek']); ?>
        <?php foreach ($viewData['velemenyek'] as $key => $velemeny) { ?>
            <article class="velemeny <?php echo ($key !== $velemenyekSzama - 1) ? 'mb-3 pb-3 border-bottom' : ''; ?> p-3">
                <p><?php echo $velemeny['bejelentkezes']; ?> - <?php echo $velemeny['ido']; ?></p>
                <p><?php echo $velemeny['torzs']; ?></p>
            </article>
        <?php } ?>
    </section>

    <form method="post" action="/web2/hirek/<?php echo $viewData['hir']['id']; ?>">
        <div class="container">
            <label for="comment" class="form-label">Szóljon hozzá!</label>
            <textarea class="form-control mb-3" name="comment" id="comment" rows="3"></textarea>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-outline-primary text-center">Küldés</button>
            </div>
        </div>
    </form>
</div>
