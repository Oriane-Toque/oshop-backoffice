<a href="<?= $router->generate('brand-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Modifier une marque</h2>

<form action="<?= $router->generate('brand-update', ['brandId' => $brand->getId()]); ?>" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nom de la marque" value="<?= $brand->getName(); ?>">
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>