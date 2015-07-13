<?php
include_once "includes/topo.php";
include_once 'db/dbConnect.php';

//print_r($_POST);

//where por padrao eh vazia
$where = "";

//Quando filtrar o resultado do relatorio, adiciona conteudo na variavel where
if (isset($_POST["submit"]) && $_POST["submit"] == "Filtrar") {
    $filtro = $_POST['filtro'];
    $status = $_POST['status'];

    if (!empty($filtro)) {
        $where = "WHERE (h.hostname LIKE '%{$filtro}%' OR h.ip LIKE '%{$filtro}%')";
    }

    //verifica se filtro de status foi especificado
    if (!empty($status)) {
        if ($status == "DOWN") {
            $where .= "AND http = '0'";
        } else {
            $where .= "AND http = '1'";
        }
    }
}

//lista tudo que o tem na tabela de monitoramento
$sql = "SELECT * FROM tb_monitoramento as m INNER JOIN tb_hosts as h ON m.host_id = h.id  {$where} ORDER BY data DESC";
$resultSet = $pdo->query($sql);
?>

<div class="container">

    <div class="text-center">
        <h1>Relatórios</h1>
        <p class="lead">Visualize os relatórios gerados por cada host</p>
    </div>

    <div class="panel-body">

        <div class="panel-body">

            <form class="form-inline" method="POST" action="relatorios.php">
                <div class="form-group">
                    <!--<label for="exampleInputName2">Filtrar</label>-->
                    <input name="filtro" type="text" class="form-control" id="exampleInputName2" placeholder="hostname ou ip">
                </div>
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option></option>
                        <option>UP</option>
                        <option>DOWN</option>
                    </select>               
                </div>
                <button name="submit" type="submit" class="btn btn-primary" value="Filtrar">Buscar</button>
            </form>
        </div>
        <table class="table">
            <tr class="info">
                <th>Hostname</th>
                <th>IP</th>
                <th>Status</th>
                <th>Tempo</th>
                <th>Cod HTTP</th>
                <th>Data</th>
            </tr>

           
            <?php
            //comparar o resultado, se up ou down
            if ($resultSet) {
                foreach ($resultSet->fetchAll(PDO::FETCH_ASSOC) as $host) {
                    if ($host['http'] == 1) {
                        $retorno['status'] = "UP";
                        $retorno['class'] = "label-success";
                    } else {
                        $retorno['status'] = "DOWN";
                        $retorno['class'] = "label-danger";
                    }
                    ?>
                    <tr>
                        <td><?php echo $host['hostname']; ?></td>
                        <td><?php echo $host['ip']; ?></td>


                        <td>
                            <span class="label <?php echo $retorno['class']; ?>"><?php echo $retorno['status']; ?></span>
                        </td>
                        <td><?php echo $host['total_time']; ?></td>
                        <td><?php echo $host['http_cod']; ?></td>
                        <td><?php echo $host['data']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>

</div><!-- /.container -->

<?php include_once "includes/rodape.php"; ?>
