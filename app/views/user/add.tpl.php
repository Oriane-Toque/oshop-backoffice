<a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter un produit</h2>

<form action="<?= $router->generate('user-add') ?>" method="POST" class="mt-5">
    <div class="form-group">
        <label for="email">Email</label>
        <?= isset($email) ? '<p style="color:red;">'.$email.'</p>' : ''; ?>
        <input type="email" class="form-control" id="email" name="email" placeholder="xxxx@email.com">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <?= isset($password) ? '<p style="color:red;">'.$password.'</p>' : ''; ?>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" >
    </div>
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <?= isset($firstname) ? '<p style="color:red;">'.$firstname.'</p>' : ''; ?>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
    </div>
    <div class="form-group">
        <label for="lastname">Nom</label>
        <?= isset($lastname) ? '<p style="color:red;">'.$lastname.'</p>' : ''; ?>
        <input type="text" class="form-control" id="lastname"  name="lastname" placeholder="Nom de famille">
    </div>
    <div class="form-group">
        <label for="role">Rôle</label>
        <?= isset($role) ? '<p style="color:red;">'.$role.'</p>' : ''; ?>
        <select class="custom-select" id="role" name="role">
          <option value="admin">Admin</option>
          <option value="catalog-manager">Catalog Manager</option>
          <option value="empty">Indéfinis</option>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
        <?= isset($status) ? '<p style="color:red;">'.$status.'</p>' : ''; ?>
        <select class="custom-select" id="status" name="status">
          <option value="0"></option>
          <option value="1">Actif</option>
          <option value="2">Désactivé/bloqué</option>
        </select>
    </div>    
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
