<div class='webdevelopper'>Vue : Roman // Controller : Roman</div>

<section>

  	<h1 class="centered">Connection</h1>
    <div class='centered'>
  	<?php 
  		  if(isset($_POST['notif'])){
  			echo '<div class="note">' .$_POST['notif'] .'</div>';
  		}
  		else{
  			{ ?> <div class='webdevelopper'> Bienvenue! Veuillez introduire vos identifiants.</div> <?php }
  		} 
  	?>

  	<label form="loginForm"><em>Redirige vers le hub et contient un lien vers retrievepw.php ainsi qu'un retour possible a l'index.php</em></label>

  	<form id="loginForm" action="index.php?action=login" method="post">

  	  <p><label for="userLogin">Pseudo :</label> 
      <input name="userLogin" type="text" /></p>
  	  <p><label for="pwLogin">Mot de passe :</label> 
      <input name="pwLogin" type="password" /></p>
  	  <input name="submitLogin" type="submit" value="Se connecter" />
      
	  </form>

  	<p>Pseudo: test@gmail.com <br/>Mot de passe: test</p>

  </div>
</section>

<?php $test = password_hash('test', PASSWORD_BCRYPT);
echo $test; ?>
