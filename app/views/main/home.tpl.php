<p class="display-4">
  Bienvenue dans le backOffice <strong>Dans les shoe</strong>...
</p>

<div class="row mt-5">
  <div class="col-12 col-md-6">
    <div class="card text-white mb-3">
      <div class="card-header bg-primary">Liste des catégories</div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categoryList as $category) : ?>
              <tr>
                <th scope="row"><?= $category->getHomeOrder() ?></th>
                <td><?= $category->getName() ?></td>
                <td class="text-right">
                  <a href="<?= $router->generate('category-update', ['categoryId' => $category->getId()]); ?>" class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
                  <!-- Example single danger button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?= $router->generate('category-delete', ['categoryId' => $category->getId()]); ?>">Oui, je veux supprimer</a>
                      <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
        <a href="<?= $router->generate('category-list'); ?>" class="btn btn-block btn-success">Voir plus</a>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="card text-white mb-3">
      <div class="card-header bg-primary">Liste des produits</div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($productList as $product) : ?>
              <tr>
                <th scope="row"><?= $product->getID() ?></th>
                <td><?= $product->getName() ?></td>
                <td class="text-right">
                  <a href="<?= $router->generate('product-edit', ["productId" => $product->getId()]) ?>" class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
                  <!-- Example single danger button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                      <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <a href="<?= $router->generate('product-list') ?>" class="btn btn-block btn-success">Voir plus</a>
      </div>
    </div>
  </div>
</div>

<a href="<?= $router->generate('home-manager-update') ?>">
  <button class="btn btn-primary">
    Modifier l'ordre des catégories dans la page home
  </button>
</a>