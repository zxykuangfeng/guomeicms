<?php



$servername = "127.0.0.1";
$username = "root";
$password = "123456";
$dbname = "ycyy";

// 创建连接
$conn = new \mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 设置字符集
$conn->set_charset("utf8");

// 执行查询
$sql = "SELECT * FROM p8_cms_member WHERE id = 1";
$result = $conn->query($sql);

// 检查查询结果
if ($result && $result->num_rows > 0) {
    // 获取一条记录
    $row = $result->fetch_assoc();
    
    // 输出数据
    echo  $row["id"] ;
} else {
    echo "没有找到记录";
}

// 关闭连接
$conn->close();
