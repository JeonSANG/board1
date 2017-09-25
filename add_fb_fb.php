<?php
// 댓글의 댓글을 테이블에 저장한다.
// 게시글의 번호, 댓글의 번호, 작성자 아이디, 작성 내용을 받는다.

// 게시글 72 댓글 24

$get_bNumber   = $_GET['bNumber'];                                      // 게시글 번호
$get_fNumber   = $_GET['fNumber'];                                      // 댓글 번호
$get_user_id   = $_GET['user_id'];                                      // 댓글의 댓글 작성자 아이디
$get_fContents = htmlspecialchars( $_GET['fContents'] );                // 댓글의 댓글 내용
$get_date      = DATE('Y-m-d H:i:s',time());                     // 입력 날짜

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 글 쓰기 모드 (select name from membertable where  id = '$get_id')
$query = "insert into FB_FB values($get_bNumber, $get_fNumber, 0, '$get_fContents', '$get_date', (select name from membertable where  id = '$get_user_id'), '$get_user_id')";

if(@mysql_query($query)){
    echo "저장 성공";
} else {
    echo "저장 실패";
}
@mysql_close($db_conn);