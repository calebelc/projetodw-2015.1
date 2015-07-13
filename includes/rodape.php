</div> <!-- container -->
<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
				
		<!-- Script para ativar seleção ao clicar em cada menu bootstrap -->	
		<script>
     		 $(".navbar-nav li:has(a[href*='<?php echo substr($page,1) ?>'])").addClass("active");
    	</script>
	</body>
</html>