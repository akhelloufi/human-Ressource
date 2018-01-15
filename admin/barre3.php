</head>
<body>
	<header id="header">
		<hgroup>
		<img src="../images/logo.jpg" style="width: 100%;height: 101px;"/>
		
		</hgroup>
	</header> <!-- end of header bar -->
<section id="secondary_bar">
		<div class="user">
			<p><a href="index.php" id="home"><?php if(session()==true){ echo $_SESSION['nom'];}?></a></p>
		</div>
		
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
				<a class="active" href="../logout.php">Déconnexion</a>
				<div class="breadcrumb_divider"></div>
				<a class="active" href="index.php">Accueil</a>
				<div class="breadcrumb_divider"></div>
				<a href="#" class="active current2"></a>	
			</article>
		</div>
	</section><!-- end of secondary bar -->