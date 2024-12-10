<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");
#include "../../include/address.mem.php";
#echo "<script>if(self == top) parent.location='".BROWSER_IP."'</script>\n";
#require ("../../include/config.inc.php");
#require ("../../include/curl_http.php");
#require ("../../include/define_function_list.inc.php");

#echo "this is a test ";
		$host = "localhost";
		$dbname = "pikachu";
		$username = "root";
		$password = "root";
		
		$uid = $_GET['uid'];
		try {
			$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
			
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 动态拼接 SQL 语句（存在 SQL 注入风险）
    $sql = "SELECT address  FROM member WHERE sex='$uid' and username = 'vince'";
    echo "Excuted  SQL: " . $sql . "<br>";

    // 执行查询
    $stmt = $pdo->query($sql);
    
    echo "SQL code : " . ($stmt->rowCount() > 0 ? "success" : "no data") . "<br>";

    // 输出所有结果
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($results)) {
        echo "query result:<br>";
        foreach ($results as $row) {
            print_r($row);
            echo "<br>";
        }
    } else {
        echo "empty data ";
    }

    // 获取结果
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "address: " . htmlspecialchars($row['address']) . "<br>";
         $langx = $row['address'];
				require ("require.$langx.php");
    }
} catch (PDOException $e) {
    // 捕获异常并输出错误
    echo "db error: " . $e->getMessage();
  }
   



?>
<html>
<head>
    <title>test sql inj</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../../../../style/member/common.css?v=<?php echo AUTOVER; ?>" type="text/css">
    <link rel="stylesheet" href="../../../../style/member/mem_body_ft.css?v=<?php echo AUTOVER; ?>" type="text/css">
    <link rel="stylesheet" href="../../../../style/my_account.css?v=<?php echo AUTOVER; ?>" type="text/css">
<style>
    .acc_right_ul{ left: 645px;}
    .acc_right_refresh,.acc_right_close,.acc_right_top{ width: auto;color: #fff;}
</style>
</head>

<body onload="Loaded()" marginwidth="0" marginheight="0" id="MFT" >
<div class="acc_select_bg">
        <?php
        if($res[1]){ // 有数据
            echo $res[1];
        }
        ?>

</div>
<script type="text/javascript" src="../../../../js/result_new.js?v=<?php echo AUTOVER; ?>"></script>

</body>
</html>