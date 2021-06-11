<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= $router->generate('main-home'); ?>">oShop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?= $viewName === 'main/home' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= $router->generate('main-home'); ?>">Accueil <?= $viewName === 'main/home' ? '<span class="sr-only">(current)</span>' : '' ?></a>
        </li>
        <li class="nav-item <?= $viewName === 'category/list' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= $router->generate('category-list'); ?>">Catégories <?= $viewName === 'category/list' ? '<span class="sr-only">(current)</span>' : '' ?></a>
        </li>
        <li class="nav-item <?= $viewName === 'product/list' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= $router->generate('product-list'); ?>">Produits <?= $viewName === 'product/list' ? '<span class="sr-only">(current)</span>' : '' ?></a>
        </li>
        <li class="nav-item <?= $viewName === 'type/list' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= $router->generate('type-list'); ?>">Types <?= $viewName === 'type/list' ? '<span class="sr-only">(current)</span>' : '' ?></a>
        </li>
        <li class="nav-item <?= $viewName === 'brand/list' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= $router->generate('brand-list'); ?>">Marques <?= $viewName === 'brand/list' ? '<span class="sr-only">(current)</span>' : '' ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tags</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $viewName === 'user/list' ? 'active' : '' ?>" href="<?= $router->generate('user-list'); ?>">Utilisateurs <?= $viewName === 'user/list' ? '<span class="sr-only">(current)</span>' : '' ?></a>
        </li>
        <li class="nax-item">
          <a href="<?= $router->generate('user-logout'); ?>">
            <button type="button" class="btn btn-danger" role="back home">Déconnexion</button>
          </a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>