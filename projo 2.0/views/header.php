<!DOCTYPE html>
<html lang="fr">
		<head>
			<title>Momentum</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="<?php echo VIEWS; ?>css/style.css" media="all" />
			<link rel="stylesheet" type="text/css" href="<?php echo VIEWS; ?>css/color.css" media="all" />
			<link rel="stylesheet" type="text/css" href="<?php echo VIEWS; ?>css/structure.css" media="all" />
		</head>
	<body>
		<header>
			<div class="header">
				<nav>
					<ul>
						<?php if(empty($_SESSION['authentified']))
							{
								echo
								'<li><a href="index.php?action=home">Accueil</a></li>';
							} 
						?>

						<?php if(!empty($_SESSION['authentified']))
							{
								echo
								'<li><a href="index.php?action=hub">Acceuil</a></li>
								<li><a href="index.php?action=profil">Profil</a></li>
								<li><a href="index.php?action=training">Entrainements</a></li>
								<li><a href="index.php?action=events">Évènements</a></li>
								<li><a href="index.php?action=members">Membres</a></li>';
							} 
						?>

						<?php if(empty($_SESSION['authentified']))
							{
								echo
								'<li><a href="index.php?action=login">Connection</a></li>
								<li><a href="index.php?action=register">Inscription</a></li>';
							}
							else{
								if(isset($_SESSION['surname'])){
									echo
									'<li><a>Connecté autant que '.$_SESSION['surname'].'.</a></li>
									<li><a href="index.php?action=logout">Déconnection</a></li>';
								}else{
								echo
								'<li><a href="index.php?action=logout">Déconnection</a></li>';
								}
							} 
						?>
					</ul>
				</nav>
			</div>	
		</header>
