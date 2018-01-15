</head>
<body>
	<header id="header">
		<hgroup>
		<img src="../images/logo.jpg" style="width: 100%;height: 101px;"/>
		
		</hgroup>
	</header> <!-- end of header bar -->
	<section id="secondary_bar">
		<div class="user">
			<p><a href="index.php"><?php if(session()==true){ echo $_SESSION['nom'];}?></a></p>
			<a class="logout_user" href="../logout.php" title="d&eacute;connecter"></a> 
		</div>
	</section><!-- end of secondary bar -->