<?php
// 目标 URL
$target_url = 'https://www.baishan.com/law-report/upload';

// 如果接收到文件
if (isset($_FILES['file'])) {
    // 获取文件信息
    $file = $_FILES['file'];
    
    // 准备 POST 数据
    $post_data = array(
        'uploaded_by' => 'Canvas.Report',  // 固定字段
        'file' => new CURLFile($file['tmp_name'], $file['type'], $file['name'])
    );

    // 初始化 cURL
    $curl = curl_init();

    // 设置 cURL 选项
    curl_setopt($curl, CURLOPT_URL, $target_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // 执行请求并获取响应
    $response = curl_exec($curl);

    // 检查是否有错误发生
    if ($response === false) {
        echo 'cURL 错误：' . curl_error($curl);
    } else {
        echo $response;
    }

    // 关闭 cURL 资源
    curl_close($curl);
} else {
    echo "未收到文件！";
}
?>
