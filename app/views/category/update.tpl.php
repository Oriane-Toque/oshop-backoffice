<a href="<?= $router->generate('category-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Modifier une catégorie</h2>

<form action="<?= $router->generate('category-update', ['categoryId' => $category->getId()]); ?>" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <?= isset($name) ? '<p style="color:red;">'.$name.'</p>' : ''; ?>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nom de la catégorie" value="<?= isset($_POST['name']) ? $_POST['name'] : $category->getName(); ?>">
    </div>
    <div class="form-group">
        <label for="subtitle">Sous-titre</label>
        <?= isset($subtitle) ? '<p style="color:red;">'.$subtitle.'</p>' : ''; ?>
        <input type="text" class="form-control" name="subtitle"  id="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock" value="<?= isset($_POST['subtitle']) ? $_POST['subtitle'] : $category->getSubtitle(); ?>">
        <small id="subtitleHelpBlock" class="form-text text-muted">
            Sera affiché sur la page d'accueil comme bouton devant l'image
        </small>
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <?= isset($picture) ? '<p style="color:red;">'.$picture.'</p>' : ''; ?>
        <input type="text" class="form-control" name="picture" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= isset($_POST['picture']) ? $_POST['picture'] : $category->getPicture(); ?>">
        <small id="pictureHelpBlock" class="form-text text-muted">
            URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
        </small>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>