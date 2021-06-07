<a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Modifier un produit</h2>

<form action="<?= $router->generate('product-update', ['productId' => $product->getId()]); ?>" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la catégorie" value="<?= $product->getName(); ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Sous-titre" 
            aria-describedby="descriptionHelpBlock" value="<?= $product->getDescription(); ?>">
        <small id="subtitleHelpBlock" class="form-text text-muted">
            La description du produit 
        </small>
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= $product->getPicture(); ?>">
        <small id="pictureHelpBlock" class="form-text text-muted">
            URL relative d'une image (jpg, gif, svg ou png) fournie sur 
            <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
        </small>
    </div>
    <div class="form-group">
        <label for="price">Prix</label>
        <input type="number" step="0.01" class="form-control" id="price"  name="price" placeholder="Prix" 
            aria-describedby="priceHelpBlock" value="<?= $product->getPrice(); ?>">
        <small id="priceHelpBlock" class="form-text text-muted">
            Le prix du produit 
        </small>
    </div>
    <div class="form-group">
        <label for="rate">Note</label>
        <input type="number" step="1" min="0" max="5" class="form-control" id="rate" name="rate" placeholder="Note" 
            aria-describedby="rateHelpBlock" value="<?= $product->getRate(); ?>">
        <small id="rateHelpBlock" class="form-text text-muted">
            Le note du produit 
        </small>
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
        <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock">
            <option value="0" <?= $product->getStatus() == 0 ? 'selected' : '' ?>>Inactif</option>
            <option value="1" <?= $product->getStatus() == 1 ? 'selected' : '' ?>>Actif</option>
        </select>
        <small id="statusHelpBlock" class="form-text text-muted">
            Le statut du produit 
        </small>
    </div>
    <div class="form-group">
        <label for="category">Categorie</label>
        <select class="custom-select" id="category" name="category" aria-describedby="categoryHelpBlock">
        <?php foreach ($categoryList as $category) : ?>
            <option value="<?= $category->getId(); ?>" <?= $product->getCategoryId() == $category->getId() ? 'selected' : '' ?>><?= $category->getName(); ?></option>
        <?php endforeach; ?>
        </select>
        <small id="categoryHelpBlock" class="form-text text-muted">
            La catégorie du produit 
        </small>
    </div>
    <div class="form-group">
        <label for="brand">Marque</label>
        <select  class="custom-select" id="brand" name="brand" aria-describedby="brandHelpBlock">
        <?php foreach($brandList as $brand) : ?>
            <option value="<?= $brand->getId(); ?>" <?= $product->getBrandId() == $brand->getId() ? 'selected' : '' ?>><?= $brand->getName(); ?></option>
        <?php endforeach; ?>
        </select>
        <small id="brandHelpBlock" class="form-text text-muted">
            La marque du produit 
        </small>
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select class="custom-select" id="type" name="type" aria-describedby="typeHelpBlock">
        <?php foreach($typeList as $type) : ?>
            <option value="<?= $type->getId(); ?>" <?= $product->getTypeId() == $type->getId() ? 'selected' : '' ?>><?= $type->getName(); ?></option>
        <?php endforeach; ?>
        </select>
        <small id="typeHelpBlock" class="form-text text-muted">
            Le type de produit 
        </small>
    </div>
    
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
