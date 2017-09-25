<?php
// 로그인 체크함
// 로그인 되어 있을 시 아이디 보내줌
// 안 되어 있을 시 false 보내줌

// 로그인 되어 있을 시
if ( isset($_SESSION['id']) ){
    $get_id = $_SESSION['id'];
    echo $get_id;
}
// 로그인 안 되어 있을 시
else {
    echo "no";
}