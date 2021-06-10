<a href="<?= $router->generate('type-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Modifier un type</h2>

<form action="<?= $router->generate('type-update', ['typeId' => $type->getId()]); ?>" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <?= isset($name) ? '<p style="color:red;">'.$name.'</p>' : ''; ?>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nom de la catégorie" value="<?= isset($_POST['name']) ? $_POST['name'] : $type->getName(); ?>">
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>