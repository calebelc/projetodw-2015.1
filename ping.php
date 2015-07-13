<?php include_once "includes/topo.php"; 
 

	$ping = "";
	if(isset($_GET['site'])){ 
	$site = $_GET['site'];
	$ping = shell_exec("ping -c 5 $site");
	}
	$pingarray = explode(" ",$ping);
	?>

	
	<div class="">
	<br>	
        <h3>Testando Conexão</h3>
			
		<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']?>">
			<input type="hidden" name="page" value="ping">
			<input id="site" class="form-control" type="text" name="site" id="site" placeholder="Digite aqui o site ou IP" size="25px">
			<button type="submit" class="btn btn-primary" value="ping">Ping</button>
		</form>

	<br><br>

	<div>
	<pre><?php echo $ping;?></pre>


	</div> <!--fim da div do resultado do ping-->

	</div><!--fim da div class-->

	<?php include_once "includes/rodape.php"; ?>