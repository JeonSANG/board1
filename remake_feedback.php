<?php
// 댓글 수정하기
define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

$get_fNumber = $_GET['fNumber'];
$get_value = $_GET['value'];

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);

// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 쿼리문 설정
$query = "update feedback set fContents = \"$get_value\" where fNumber = $get_fNumber;";

if(@mysql_query($query)){
    echo "수정 성공";
} else {
    echo "수정 실패";
}

@mysql_close();