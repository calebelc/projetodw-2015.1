<?php

include 'db/dbConnect.php';

$resultSet = $pdo->query("SELECT * FROM tb_hosts WHERE monitorar = 1");

//Verifica o status do site passado no parametro
function curl_info($url) {
    $ch = curl_init();
    $timeout = 3;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $content = curl_exec($ch);
    $info = curl_getinfo($ch);
    return $info;
}

//Verificar toda a lista de hosts cadastrados
foreach ($resultSet->fetchAll(PDO::FETCH_ASSOC) as $infoHost) {
    $status = curl_info($infoHost['ip']);
    $httpCode = isset($status['http_code']) ? $status['http_code'] : 0;

    //Lista de status separada por virgula para considerar acesso OK.
    //Adicionar novos status dentro do array caso queira que sejam considerados ok
    $listaCodidoOk = array( '302', '301','200');

    if (in_array($httpCode, $listaCodidoOk)) {
        $httpOk = 1;
    } else {
        $httpOk = 0;
    }

    $totalTime = isset($status['total_time']) ? $status['total_time'] : 0;

    //Atualiza na tabela de monitoramento o status de cada host
    $data = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tb_monitoramento (host_id,data,http,total_time,http_cod) VALUES (:host_id,:data,:http,:total_time,:http_cod)";
    $q = $pdo->prepare($sql);
    $query = $q->execute(array(
        ':host_id' => $infoHost['id'],
        ':data' => $data,
        ':http' => $httpOk,
        ':total_time' => $totalTime,
        ':http_cod' => $httpCode,
    ));

}
?>