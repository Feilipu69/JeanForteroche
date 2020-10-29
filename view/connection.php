<?php
if (isset($_SESSION['errors'])) {
	?>
	<div class="alert alert-danger" role="alert"><?= $_SESSION['errors']; ?></div>
	<?php
}
?>
<form method="post" action="<?= HOST; ?>/connection">
	<label for="login">Login : </label>
	<br>
	<input type="text" name="login" id="login" required/>
	<br>
	<label for="password">Votre code : </label>
	<br>
	<input type="password" name="password" id="password" required />
	<br>
	<input type="submit" name="connection" id="connection" value="Connexion" class="btn btn-dark mt-4" />
	<a href="<?= HOST; ?>/connection"><input type="button" value="Annuler" class="btn btn-dark mt-4" /></a>
</form>

