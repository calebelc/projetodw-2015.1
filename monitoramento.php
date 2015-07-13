<?php
include_once "includes/topo.php";
include 'db/dbConnect.php';

//Quando editar um registro, pega o ID na URL
//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
$result = $pdo->query("SELECT * FROM tb_monitoramento");
$host = $result->fetch(PDO::FETCH_ASSOC);
//}
//if (isset($_POST['inputMonitorar'])) {
//    $monitorar = 1;
//} else {
//    $monitorar = 0;
//}
//Quando adicionar um novo registro
//if (isset($_POST["submit"]) && $_POST["submit"] == "Adicionar") {
//
//    $sql = "INSERT INTO tb_hosts (hostname, ip, monitorar) VALUES ('{$_POST['inputNome']}', '{$_POST['inputIp']}', '{$monitorar}')";
//    $pdo->exec($sql);
//}
//Quando atualizar um registro
//if (isset($_POST["submit"]) && $_POST["submit"] == "Atualizar") {
//    $sql = "UPDATE tb_hosts SET hostname='{$_POST['inputNome']}', ip='{$_POST['inputIp']}', monitorar='$monitorar' WHERE id={$_POST['id']}";
//    $pdo->exec($sql);
//}
?>

<div class="container">

    <div class="text-center">
        <h1>Tela de Monitoramento</h1><br>
        <!--<p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>-->
    </div>

    <div class="panel-body">


        <table class="table">
            <tr class="info">
                <th>ID</th>
                <th>Nome/Hostname</th>
                <th>IP</th>
                <th>Monitorar?</th>
                <th colspan="2">Action</th>
            </tr>
<?php
$resultSet = $pdo->query("SELECT * FROM tb_hosts");

if ($resultSet) {
    foreach ($resultSet->fetchAll(PDO::FETCH_ASSOC) as $host) {
        ?>
                    <tr>
                    <?php foreach ($host as $field) { ?>
                            <td><?php echo $field ?></td>
                    <?php } ?>
                        <td><a href="<?php echo "host.php?id={$host['id']}" ?>">editar</a></td>
                        <td><a href="<?php echo "deleteHost.php?id={$host['id']}" ?>">excluir</a></td>
                    </tr>
                        <?php
                    }
                }
                ?>
        </table>
    </div>

</div><!-- /.container -->
<?php include_once "includes/rodape.php"; ?>
