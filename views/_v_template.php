<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
                        <link href="/blue/style.css" rel="stylesheet"/>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
			<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>
			<script type="text/javascript">$(document).ready(function(){$("#myTable").tablesorter({sortList: [[0,0]]} );});</script>	
</head>

<body>	
    <nav>
        <menu>
            <?php if($user): ?>
            <li class ="bbb"><a href='/posts/add'>Add Post</a></li>
            <li class ="bbb"><a href='/posts/'>View Posts</a></li>
            <li class ="bbb"><a href='/posts/users'>Follow Users</a></li>
            <li class ="bbb"><a href='/users/logout'>Logout</a></li>
            <?php else:?>
            <li class ="bbb"><a href='/users/signup'>Sign Up</a></li>
            <li class ="bbb"><a href='/users/login'>Log In</a></li>
            <?php endif; ?>
          
        </menu>   
    </nav>
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
    
         <div class="aaa"><?php
		echo $_SERVER['SERVER_NAME'];
		echo $_SERVER['PHP_SELF'];
		$filename = 'index.php';
		if (file_exists($filename)) {
			echo " was last modified on: " . date ("F d Y H:i:s.", filemtime($filename));
		}
         ?>
        </div>
</body>
</html>