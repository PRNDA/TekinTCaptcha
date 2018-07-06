<?php

// Initiate the autoloader. The file should be generated by Composer.
// You will provide your own autoloader or require the files directly if you did
// not install via Composer.
require_once __DIR__ . '/../src/autoload.php';

// Register API keys at https://007.qq.com
$aid = '2050171219';
$AppSecretKey = '0rcAq-BAGv4XFVeN7sRA81Q**';

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>TekinTCaptcha Example</title>
<style type="text/css">
body {
    margin: 1em 5em 0 5em;
    font-family: sans-serif;
}
fieldset {
    display: inline;
    padding: 1em;
}
</style>
</head>
<body>
<h1>TekinTCaptcha Example</h1>
<?php if ($aid === '' || $AppSecretKey === ''): ?>
    <h2>Add your keys</h2>
    <p>If you do not have keys already then visit <kbd>
    <a href = "https://007.qq.com">
        https://007.qq.com</a></kbd> to generate them.
Edit this file and set the respective keys in <kbd>$aid</kbd> and
<kbd>$AppSecretKey</kbd>. Reload the page after this.</p>
<?php
elseif (isset($_POST['Ticket']) && $_POST['Ticket']!=''):
// The POST data here is unfiltered because this is an example.
// In production, *always* sanitise and validate your input'
?>
    <h2><kbd>POST</kbd> data</h2>
    <kbd><pre><?php var_export($_POST); ?></pre></kbd>
    <?php
    // If the form submission includes the "g-captcha-response" field
    // Create an instance of the service using your AppSecretKey
    $recaptcha = new \TekinTCaptcha\TekinTCaptcha($aid,$AppSecretKey, new \TekinTCaptcha\RequestMethod\SocketPost());

    // If file_get_contents() is locked down on your PHP installation to disallow
    // its use with URLs, then you can use the alternative request method instead.
    // This makes use of fsockopen() instead.
    //  $recaptcha = new \TekinTCaptcha\TekinTCaptcha($AppSecretKey, new \TekinTCaptcha\RequestMethod\SocketPost());

    // Make the call to verify the response and also pass the user's IP address
    $resp = $recaptcha->verify($_POST['Ticket'], $_POST['Randstr']);
  
    if ($resp->isSuccess()):
    // If the response is a success, that's it!
            ?>
            <h2>Success!</h2>
            <p>That's it. Everything is working. Go integrate this into your real project.</p>
            <p><a href="/">Try again</a></p>
            <?php
    else:
// If it's not successful, then one or more error codes will be returned.
        ?>
        <h2>Something went wrong</h2>
        <p>The following error was returned:
         错误信息：<?php
            foreach ($resp->getErrMsg() as $msg) {
                echo '<kbd>' , $msg , '</kbd> ';
            }
            ?>
         <?php
             echo '<kbd>返回状态码：'. $resp->getStatus() .'</kbd> ';
             echo '<kbd>恶意等级：'. $resp->getEvilLevel() .'</kbd> ';
            ?>
            </p>
        <p>Check the error msg code reference blow <kbd>
        <table data-v-5aad9cdc="" width="810" border="0" cellspacing="0" cellpadding="0"><tr data-v-5aad9cdc="" class="table-header"><td data-v-5aad9cdc="" rowspan="1">错误信息</td> <td data-v-5aad9cdc="" rowspan="1">详细说明</td> <td data-v-5aad9cdc="" rowspan="1">错误信息</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">详细说明</td></tr> <tr data-v-5aad9cdc="" class="odd"><td data-v-5aad9cdc="" rowspan="1">OK</td> <td data-v-5aad9cdc="" rowspan="1">验证通过</td> <td data-v-5aad9cdc="" rowspan="1">cmd no match</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">验证码系统命令号不匹配</td></tr> <tr data-v-5aad9cdc="" class="even"><td data-v-5aad9cdc="" rowspan="1">user code len error</td> <td data-v-5aad9cdc="" rowspan="1">验证码长度不匹配</td> <td data-v-5aad9cdc="" rowspan="1">uin no match</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">号码不匹配</td></tr> <tr data-v-5aad9cdc="" class="odd"><td data-v-5aad9cdc="" rowspan="1">captcha no match</td> <td data-v-5aad9cdc="" rowspan="1">验证码答案不匹配/Randstr参数不匹配</td> <td data-v-5aad9cdc="" rowspan="1">seq redirect</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">重定向验证</td></tr> <tr data-v-5aad9cdc="" class="even"><td data-v-5aad9cdc="" rowspan="1">verify timeout</td> <td data-v-5aad9cdc="" rowspan="1">验证码签名超时</td> <td data-v-5aad9cdc="" rowspan="1">opt no vcode</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">操作使用pt免验证码校验错误</td></tr> <tr data-v-5aad9cdc="" class="odd"><td data-v-5aad9cdc="" rowspan="1">Sequnce repeat</td> <td data-v-5aad9cdc="" rowspan="1">验证码签名重放</td> <td data-v-5aad9cdc="" rowspan="1">diff</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">差别，验证错误</td></tr> <tr data-v-5aad9cdc="" class="even"><td data-v-5aad9cdc="" rowspan="1">Sequnce invalid</td> <td data-v-5aad9cdc="" rowspan="1">验证码签名序列</td> <td data-v-5aad9cdc="" rowspan="1">captcha type not match</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">验证码类型与拉取时不一致</td></tr> <tr data-v-5aad9cdc="" class="odd"><td data-v-5aad9cdc="" rowspan="1">Cookie invalid</td> <td data-v-5aad9cdc="" rowspan="1">验证码cookie信息不合法</td> <td data-v-5aad9cdc="" rowspan="1">verify type error</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">验证类型错误</td></tr> <tr data-v-5aad9cdc="" class="even"><td data-v-5aad9cdc="" rowspan="1">verify ip no match</td> <td data-v-5aad9cdc="" rowspan="1">ip不匹配</td> <td data-v-5aad9cdc="" rowspan="1">invalid pkg</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">非法请求包</td></tr> <tr data-v-5aad9cdc="" class="odd"><td data-v-5aad9cdc="" rowspan="1">decrypt fail</td> <td data-v-5aad9cdc="" rowspan="1">验证码签名解密失败</td> <td data-v-5aad9cdc="" rowspan="1">bad visitor</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">策略拦截</td></tr> <tr data-v-5aad9cdc="" class="even table-bottom"><td data-v-5aad9cdc="" rowspan="1">appid no match</td> <td data-v-5aad9cdc="" rowspan="1">验证码强校验appid错误</td> <td data-v-5aad9cdc="" rowspan="1">system busy</td> <td data-v-5aad9cdc="" rowspan="1" class="col-4">系统内部错误</td></tr> <tr data-v-5aad9cdc="" class="odd table-bottom"><td data-v-5aad9cdc="" rowspan="1">param err</td> <td data-v-5aad9cdc="" rowspan="1">AppSecretKey参数校验错误</td> <td data-v-5aad9cdc="" rowspan="1"></td> <td data-v-5aad9cdc="" rowspan="1" class="col-4"></td></tr></table>

        </kbd> 验证失败，查看并检查配置参数信息。</p>
        <p><a href="/">Try again</a></p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
