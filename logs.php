<?php
include "config.php";
include "config/timeclass.php";
?>
<html>
<head>
	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.css" />
	<link rel="stylesheet" href="https://bootswatch.com/assets/css/custom.min.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
div class="card">
	   <div class="card-content">
<?php
$query = DB::query('SELECT * FROM likeLog ORDER BY ID DESC LIMIT 200');
foreach( $query as $islem )
{ 
$zaman = date('d.m.Y H:i:s');
$time = $islem->date;
$sonzaman = zamanla($zaman,$time);
?>
<div class="alert alert-dismissible alert-warning">
<img src="<?php echo $islem->profilpic; ?>" width="30px"/>
<?php echo $islem->_ID; ?><?php echo $islem->comment; ?> - <?php echo $sonzaman; ?>
</div>
<?php } ?></div></div>
</html>