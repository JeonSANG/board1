<?php
// 댓글 삭제 하기
$get_fNumber = $_GET['fNumber'];

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 쿼리 실행 : 해당 댓글 삭제
$query  = "delete from feedback where fNumber = $get_fNumber";

if(@mysql_query($query)){
    $query  = "delete from FB_FB where fNumber = $get_fNumber";
    @mysql_query($query);
    echo "삭제 완료";
} else{
    echo "삭제 실패";
}
@mysql_close();