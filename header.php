<META charset="utf-8">
    
        
    <!DOCTYPE html>
    <head>
    	
    	<title>Ma12 Forumet</title>
    	<link rel="stylesheet" href="css/style.css" type="text/css">
    	<link rel="stylesheet" href="css/mobile.css" type="text/css">
    	<link rel="stylesheet" href="css/mobilemenu.css" type="text/css">
    </head>
    <body>
    	<a href="index.php"><img class="logo" src="pics/logotype.png"></a>
    	<img class="logoM" src="pics/logotype2.png">
    	<div class="wrapper">
	    	<div class="menu">
		    		<div class="webbbutt">
			    		<a class="item" href="index.php">Hem</a>
			    		<a class="item" href="create_topic.php">Skapa ämne</a>
			    		<a class="item" href="create_cat.php">Skapa kategori</a>
			    	</div>
	<ul id="navigation">
	<li class="dropdown"><a href="#">Mobilmeny</a>
		<ul class="sub_navigation">
			<li><a href="category.php?id=7">Intro MA</a></li>
			<li><a href="category.php?id=8">Mobila IA</a></li>
			<li><a href="category.php?id=9">Programering</a></li>
			<li><a href="category.php?id=10">Webb app</a></li>
			<li><a href="category.php?id=11">Servertekniker</a></li>
			<li><a href="category.php?id=12">Programmering Mobila Plattformar</a></li>
			<li><a href="category.php?id=14">Examensarbete</a></li>
			<li><a href="category.php?id=13">LIA</a></li>
			<li><a href="category.php?id=15">MEMES</a></li>
		</ul>
	</li>
	</ul>
	    		
	    			<div class="userbar">
	    <?php
		 if (isset($_SESSION['signed_in']) && $_SESSION
    ['signed_in'] == TRUE) 
			{
				echo '<a class="item" href="signout.php">Logga ut</a>';
			}
		else
			{
				echo '<a class="item" href="signin.php">Logga in</a> . <a class="item" href="signup.php">Skapa konto</a>';
			}
		?> 
	    	</div>
	    		
	    		
	    	</div>
	    	
	    	
	    	<div class="leftsidebar">
				<a class="item" href="category.php?id=7">Intro MA</a>
				<a class="item" href="category.php?id=8">Mobila IA</a>
				<a class="item" href="category.php?id=9">Programering</a>
				<a class="item" href="category.php?id=10">Webb app</a>
				<a class="item" href="category.php?id=11">Servertekniker</a>
				<a class="item" href="category.php?id=12">Programering - Mobila plattformar</a>
				<a class="item" href="category.php?id=14">Examensarbete</a>
				<a class="item" href="category.php?id=13">LIA</a>
				<a class="item" href="category.php?id=15">MEMES</a>
				
				
				
	    		

	   <!-- script för dropdownmenu -->		
	<script type="text/javascript" src="script/jquery.js"></script>
	<script type="text/javascript">
	        // Wait for the page and all the DOM to be fully loaded
		$('body').ready(function() {
 
	                // Add the 'hover' event listener to our drop down class
			$('.dropdown').click(function() {
	                        // When the event is triggered, grab the current element 'this' and
	                        // find it's children '.sub_navigation' and display/hide them
				$(this).find('.sub_navigation').slideToggle(); 
			});
		});
	</script> <!-- slut script för dropdownmenu -->	
	    	
			<a class="twitter-timeline" href="https://twitter.com/search?q=%23ma12" data-widget-id="280646508796329984">Tweets om "#ma12"</a>

			<script>
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			</script>
	 	   </div>
	    
    	
    	<div class="content">
