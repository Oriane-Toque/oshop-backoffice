<a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter un produit</h2>

<form action="<?= $router->generate('user-add') ?>" method="POST" class="mt-5">
    <div class="form-group">
        <label for="email">Email</label>
        <?= isset($email) ? '<p style="color:red;">'.$email.'</p>' : ''; ?>
        <input type="email" class="form-control" id="email" name="email" placeholder="xxxx@email.com" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <?= isset($password) ? '<p style="color:red;">'.$password.'</p>' : ''; ?>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" aria-describedby="passwordHelpBlock" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>">
        <small id="passwordHelpBlock" class="form-text text-muted">
          Le mot de passe doit contenir : au moins 8 caractères, une lettre en minuscule, une lettre en majuscule, un chiffre et un caractère spécial !
        </small>
    </div>
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <?= isset($firstname) ? '<p style="color:red;">'.$firstname.'</p>' : ''; ?>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="lastname">Nom</label>
        <?= isset($lastname) ? '<p style="color:red;">'.$lastname.'</p>' : ''; ?>
        <input type="text" class="form-control" id="lastname"  name="lastname" placeholder="Nom de famille" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="role">Rôle</label>
        <?= isset($role) ? '<p style="color:red;">'.$role.'</p>' : ''; ?>
        <select class="custom-select" id="role" name="role">
          <option value="admin" <?= isset($_POST['role']) && $_POST['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
          <option value="catalog-manager" <?= isset($_POST['role']) && $_POST['role'] == 'catalog-manager' ? 'selected' : ''; ?>>Catalog Manager</option>
          <option value="empty" <?= isset($_POST['role']) && $_POST['role'] == 'empty' ? 'selected' : ''; ?>>Indéfinis</option>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
        <?= isset($status) ? '<p style="color:red;">'.$status.'</p>' : ''; ?>
        <select class="custom-select" id="status" name="status">
          <option value="0" <?= isset($_POST['status']) && $_POST['status'] == '0' ? 'selected' : ''; ?>></option>
          <option value="1" <?= isset($_POST['status']) && $_POST['status'] == '1' ? 'selected' : ''; ?>>Actif</option>
          <option value="2" <?= isset($_POST['status']) && $_POST['status'] == '2' ? 'selected' : ''; ?>>Désactivé/bloqué</option>
        </select>
    </div>    
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
