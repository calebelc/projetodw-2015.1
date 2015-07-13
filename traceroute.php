<?php include_once "includes/topo.php"; 


	$traceroute = "";
	if(isset($_GET['site'])){ 
	$site = $_GET['site'];
	$traceroute = shell_exec("traceroute -m 10 $site");
	}
	$traceroutearray = explode(" ",$traceroute);
	?>


	<div class=""> 
	<br>
		<h3>Traçando rota</h3>
						
		<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']?>">
			<input type="hidden" name="page" value="traceroute">
			<input id="site" class="form-control" type="text" name="site" id="site" placeholder="Digite aqui o site ou IP" size="25px">
			<button type="submit" class="btn btn-primary" value="traceroute">Traceroute</button>
		</form>

	<br><br>

	<div>
	<pre><?php echo $traceroute;?></pre>


	</div> <!--fim da div do resultado do traceroute-->

	</div><!--fim da div traceroute-->

	<?php include_once "includes/rodape.php"; ?>