<?php include_once "includes/topo.php"; 


	$nslookup = "";
	if(isset($_GET['site'])){ 
	$site = $_GET['site'];
	$nslookup = shell_exec("nslookup $site");
	}
	$nslookuparray = explode(" ",$nslookup);
	?>


	<div class=""> 
	<br>
		<h3>Verificando DNS</h3>
						
		<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']?>">
			<input type="hidden" name="page" value="nslookup">
			<input id="site" class="form-control" type="text" name="site" id="site" placeholder="Digite aqui o site" size="25px">
			<button type="submit" class="btn btn-primary" value="nslookup">Nslookup</button>
		</form>

	<br><br>

	<div>
	<pre><?php echo $nslookup;?></pre>


	</div> <!--fim da div do resultado do nslookup-->

	</div><!--fim da div nslookup-->

	<?php include_once "includes/rodape.php"; ?>