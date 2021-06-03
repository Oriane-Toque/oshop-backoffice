<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>oShop BackOffice | Catégories</title>

  <!-- Getting bootstrap (and reboot.css) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!--
        And getting Font Awesome 4.7 (free)
        To get HTML code icons : https://fontawesome.com/v4.7.0/icons/
    -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

  <!-- We can still have our own CSS file -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= $router->generate('main-home'); ?>">oShop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('main-home'); ?>">Accueil</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?= $router->generate('catalog-categories'); ?>">Catégories <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('catalog-products'); ?>">Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Types</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Marques</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tags</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sélections Accueil &amp; Footer</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
          <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
      </div>
    </div>
  </nav>

  <?php
  // On inclut des sous-vues => "partials"
  if($currentPage === 'error/err404') :
    include __DIR__ . '/../partials/nav.tpl.php';
  endif;
  ?>