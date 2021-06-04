<div class="container my-4">
  <a href="<?= $router->generate('product-list'); ?>" class="btn btn-success float-right">Retour</a>
  <h2>Ajouter un produit</h2>

  <form action="<?= $router->generate('product-create'); ?>" method="POST" enctype="multipart/form-data" class="mt-5">
    <div class="form-group">
      <label for="name">Nom</label>
      <input type="text" name="nameProduct" class="form-control" id="name" placeholder="Nom du produit">
    </div>
    <div class="form-group">
      <label for="price">Prix</label>
      <input name="priceProduct" class="form-control" id="price" placeholder="Prix du produit">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" name="descriptionProduct" class="form-control" id="description" placeholder="Description du produit">
    </div>
    <div class="form-group">
      <label for="rate">Note</label>
      <input type="number" name="rateProduct" class="form-control" id="rate" max="5" min="0">
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
        <select class="custom-select" name="statusProduct" id="status" aria-describedby="statusHelpBlock">
            <option value="0">Inactif</option>
            <option value="1">Actif</option>
        </select>
        <small id="statusHelpBlock" class="form-text text-muted">
            Le statut du produit 
        </small>
    </div>
    <div class="form-group">
      <label for="brand">Marque</label>
      <?php foreach ($brandList as $brand) : ?>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="brandProduct" id="exampleRadios<?= $brand->getId(); ?>" value="<?= $brand->getId(); ?>" checked>
          <label for="exampleRadios<?= $brand->getId(); ?>"><?= $brand->getName(); ?></label>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="form-group">
      <label for="category">Catégorie</label>
      <?php foreach ($categoryList as $category) : ?>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="categoryProduct" id="exampleRadios<?= $category->getId(); ?>" value="<?= $category->getId(); ?>" checked>
          <label for="exampleRadios<?= $category->getId(); ?>"><?= $category->getName(); ?></label>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="form-group">
      <label for="type">Type</label>
      <?php foreach ($typeList as $type) : ?>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="typeProduct" id="exampleRadios<?= $type->getId(); ?>" value="<?= $type->getId(); ?>" checked>
          <label for="exampleRadios<?= $type->getId(); ?>"><?= $type->getName(); ?></label>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="form-group">
      <label for="picture">Image</label>
      <input type="text" name="pictureProduct" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
      <small id="pictureHelpBlock" class="form-text text-muted">
        URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
      </small>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
  </form>
</div>