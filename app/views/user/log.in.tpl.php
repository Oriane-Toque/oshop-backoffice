<form action="<?= $router->generate('user-login') ?>" method="POST">
  <div class="mb-3">
    <label for="email" class="form-label">Identifiant</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="xxxx@email.com">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>