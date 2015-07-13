<?php
include_once "includes/topo.php";
include 'db/dbConnect.php';

//Quando editar um registro, pega o ID na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $pdo->query("SELECT * FROM tb_hosts WHERE id = {$id}");
    $host = $result->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['inputMonitorar'])) {
    $monitorar = 1;
} else {
    $monitorar = 0;
}

//Quando cadastrar um novo registro
if (isset($_POST["submit"]) && $_POST["submit"] == "Cadastrar") {

    $sql = "INSERT INTO tb_hosts (hostname, ip, monitorar) VALUES ('{$_POST['inputNome']}', '{$_POST['inputIp']}', '{$monitorar}')";
    $pdo->exec($sql);
}


//Quando atualizar um registro
if (isset($_POST["submit"]) && $_POST["submit"] == "Atualizar") {
    $sql = "UPDATE tb_hosts SET hostname='{$_POST['inputNome']}', ip='{$_POST['inputIp']}', monitorar='$monitorar' WHERE id={$_POST['id']}";
    $pdo->exec($sql);
}
?>

    <div class="">
        <h1>Cadastrando Host</h1><br>

        <form class="form-inline" action="host.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($host['id']) ? $host['id'] : ""; ?>">

            <div class="control-group">
                <label class="control-label" for="inputNome">Nome do Host</label><br>
                <div class="form-group">
                    <input name="inputNome" class="form-control" type="text" id="inputNome" placeholder="" id="host" 
                           value="<?php echo isset($host['hostname']) ? $host['hostname'] : ""; ?>">
                </div>
            </div><br>

            <div class="control-group">
                <label class="control-label" for="inputIp">IP/Dominio do Host</label><br>
                <div class="form-group">
                    <input name="inputIp" class="form-control" type="text" id="inputIp" placeholder="" value="<?php echo isset($host['ip']) ? $host['ip'] : ""; ?>">
                </div>
            </div><br>

            <div class="control-group">
                <div class="controls">
                    <label class="control-label" for="inputMonitorar">Monitorar?</label><br>
                    <label class="checkbox">
                        <input name="inputMonitorar" type="checkbox" value="<?php echo isset($host['monitorar']) && $host['monitorar'] == 1 ? "1":"0"; ?>" <?php echo isset($host['monitorar']) && $host['monitorar'] == 1 ? "checked='checked'" : ""; ?>> 
                    </label>
                </div>
                <br>
                <button name="submit" type="submit" class="btn btn-primary" value="<?php echo isset($host['id']) ? "Atualizar" : "Cadastrar"; ?>"><?php echo isset($host['id']) ? "Atualizar" : "Cadastrar"; ?></button>
            </div>
        </form>
    </div>
    <br>
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

             //varredura no resultado que o banco retornou na consulta   
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
    </div></div>


<?php include_once "includes/rodape.php"; ?>