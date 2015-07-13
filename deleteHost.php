<?php
	include 'db/dbConnect.php';
	if(isset($_GET["excluir"])){
		$sql = "DELETE FROM tb_hosts WHERE id={$_GET['excluir']}";
		$pdo->exec($sql);
		header("Location:host.php");
	}
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$result = $pdo->query("SELECT * FROM tb_hosts WHERE id = {$id}");
		$host = $result->fetch(PDO::FETCH_ASSOC);	
	}
?>
<p>Deseja excluir o host(name: <?php echo $host['hostname'] ?> e address: <?php echo $host['ip'] ?>)?</p>
<a href="?excluir=<?php echo $host['id'] ?>">Sim</a> <a href="host.php">Nao</a>