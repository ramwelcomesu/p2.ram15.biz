<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/guide.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

	<body id='wrapper'>  

	    <div id='header'> <!-- Common Page Header -->
	    	
	    	<h2> MiniTwitter </h2>

	    	<?php if(!empty($user->first_name)){ ?>
		    	<?php echo 'Hello!!   '.$user->first_name; ?>
		    	<?php echo '   '.$user->last_name; ?>
		    <?php } ?>
	    </div>

	    <br>

	    <div id='menu'> <!-- cascading menu based on users login status -->
	    	<ul>
		        <li><a href='/'>Home</a></li>

		        <!-- Menu for users who are logged in -->
		        <?php if($user): ?>

		            <li><a href='/posts/index'>View all Postings</a></li>
		            <li><a href='/posts/add'>Add new Post</a></li>
		            <li><a href='/posts/users'>Manage my followings</a></li>
		            <li><a href='/users/profile'>Edit profile</a></li>
		            <li><a href='/users/logout'>Logout</a></li>

		        <!-- Menu options for users who are not logged in -->
		        <?php else: ?>
		        	<li><a href='/users/signup'>Sign up</a></li>
		            <li><a href='/users/login'>Login</a></li>

		        <?php endif; ?>
	    	</ul>
	    </div>
		<br>
	  
	    <div id = 'pcontent'> <!-- Actual content of the page- forms, views etc -->

	    	<?php if(isset($content)) echo $content; ?>

		</div>

	</body>


</html>