<div class="webdevelopper">
</div>

<?php
	
	if(!isset($_POST['submitRegister'])){?>

		<section><div class='centered'>
			<h1>Inscription</h1>

			<form id="registerForm" action="index.php?action=register" method="post">
				<p><label for="name">Nom: </label> 
				<input name="name" required="" type="text" placeholder="Dupont" />

				<label for="surname"> Prenom: </label> 
				<input name="surname" required="" type="text" placeholder="Jacques" /><br/>

				<label for="email"> Adresse email: </label>
				<input name="email" required="" type="email" placeholder="exemple@email.com" /><br/>

				<label for="numtel"> Numero de telephone: </label>
				<input name="numtel" required="" type="tel" placeholder="+32 479 90 84 10" /> <br />

				<label for="adress">Adresse: </label>
				<input name="adress" required="" size="40" type="text" placeholder="Mactembourg-les bains, rue du Momentum,42" /> <br/>

				<label for="bankid"> Compte bancaire: </label>
				<input max="29" name="bankid" required="" size="30" type="text" placeholder="BE** **** **** ****" /><br/>

				<label for="pwd"> Mot de passe: </label>
				<input name="pwd" required="" type="password" />
				<label for="pwd_confirm"> Confirmez le mot de passe: </label><input name="pwd_confirm" required="" type="password" /> <br />

				<label for="pp"> Votre photo de profil </label>
				<input accept="image/*" name="pp"  type="file" /><br />

				<input name="submitRegister" type="submit" value="Enregistrer" />
				<input type="reset" value="Effacer" /></p>
			</form>
		</div></section>

	<?php }

	else{?>

		<section>
			Merci pour votre inscription <?php echo(htmlspecialchars($_POST['name'])) ?>! Un membre resposable doit valider votre inscription avant que vous puissiez vous connecter :)
		</section>

		<?php

	}?>
