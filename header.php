<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cricket Scoreboard</title>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/functions.js"></script>
<link href="css/bootstrap-theme.css" type="text/css" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Shivratri Cricket</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="startMatch.php">Create Match</a></li>
        <li><a href="index.php#viewMatch">View Matches</a></li>
      </ul>
      <form class="navbar-form navbar-left"  style="display:<?php if(isset($_COOKIE['umpireMode'])&&$_COOKIE['umpireMode'] == "yes")echo "none";else echo "block"; ?>" action="login.php" method="post">
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Umpire authentication" name="pass">
        </div>
        <button type="submit" class="btn btn-default">Login</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><?php if(isset($_COOKIE['umpireMode']))echo "<p class=\"navbar-text\">Welcome Umpire</p>"; ?></li>
        <li style="display:<?php if(isset($_COOKIE['umpireMode'])&&$_COOKIE['umpireMode'] == "yes")echo "block";else echo "none"; ?>"><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>