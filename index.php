<!DOCTYPE html>
<html>
<head>
<?php
	$username = "root";
	$password = "";
	$db = "simpleblog";
	$con = mysqli_connect('localhost', $username, $password,$db) or die("Unable to connect to MySQL");	
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Fauzan's Simple Blog</title>


</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Fauzan<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="new_post.php">+ Tambah Post</a></li>
    </ul>
</nav>

<div id="home">
    <div class="posts">
        <nav class="art-list">
          <ul class="art-list-body">
			  <?php
				function write_date($date) {
					$num_to_mon = array(
						"01" => "Januari",
						"02" => "Februari",
						"03" => "Maret",
						"04" => "April",
						"05" => "Mei",
						"06" => "Juni",
						"07" => "Juli",
						"08" => "Agustus",
						"09" => "September",
						"10" => "Oktober",
						"11" => "November",
						"12" => "Desember"
					);					
					$splitted = explode("-",$date);
					$result = $splitted[2]." ".$num_to_mon[$splitted[1]]." ".$splitted[0];
					echo $result;
				}
				$query = "SELECT * FROM post";
				$q_result = mysqli_query($con,$query);
				$post_arr =  array(); 
				while($row = mysqli_fetch_array($q_result))
				{
					array_unshift($post_arr,$row);
				}
				$is_featured = true;
				foreach($post_arr as $row)
				{?>
					<li class="art-list-item">
						<div class="art-list-item-title-and-time">
							<h2 class="art-list-title"><a href=<?php echo "\"post.php?id=" . $row['PostID'] . "\""?>><?php echo $row['Title']?></a></h2>
							<div class="art-list-time"><?php echo write_date($row['Date'])?></div>		
							<?php 
								if($is_featured) 
								{
									$is_featured=false; 	?>
									<div class="art-list-time"><span style="color:#F40034;">&#10029;</span> Featured</div>
							<?php }?>
						</div>
						<p><?php echo $row['Content']?></p>
						<p>
						  <a href=<?php echo "\"edit_post.php?id=" . $row['PostID'] . "\""?>>Edit</a> | <a href="#" onclick=<?php echo "'return conf_delete(" . $row['PostID'] . ")'"?> id="button_delete">Hapus</a>
						</p>
					</li>
				<?php }
				mysqli_close($con);
			  ?>
          </ul>
        </nav>
    </div>
</div>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Asisten IF3110 /
        <a class="rss-link" href="#rss">RSS</a> /
        <br>
        <a class="twitter-link" href="http://twitter.com/YoGiiSinaga">Yogi</a> /
        <a class="twitter-link" href="http://twitter.com/sonnylazuardi">Sonny</a> /
        <a class="twitter-link" href="http://twitter.com/fathanpranaya">Fathan</a> /
        <br>
        <a class="twitter-link" href="#">Renusa</a> /
        <a class="twitter-link" href="#">Kelvin</a> /
        <a class="twitter-link" href="#">Yanuar</a> /
        
    </aside>
</footer>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
   function conf_delete(id)
   {
	   if(confirm("Apakah Anda yakin menghapus post ini?"))
	   {
		   var loc = "post_eraser.php?id=";
		   window.location=loc.concat(id);
	   }
	   else
	   {
		   return false;
	   }
   }
</script>

</body>
</html>
