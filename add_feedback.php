<?php
// 작성한 댓글 저장하기!
define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

$get_bNumber = $_GET['bNumber'];                                        // 글 번호 가져오기
$get_id = $_GET['id'];                                                  // 글쓴이 아이디 가져오기
$get_contents = htmlspecialchars($_GET['fContents']);                   // 글 내용, HTML 엔티티로 변환( 태그 입력, 오류 방지 )
$get_date  = DATE('Y-m-d H:i:s',time());                         // 입력 시간

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 글 쓰기 모드
$query = "insert into feedback values($get_bNumber, 0, '$get_contents', '$get_date', (select name from membertable where  id = '$get_id'), '$get_id');";


if(@mysql_query($query)){
    echo "저장 성공";
} else {
    echo "저장 실패";
}
@mysql_close($db_conn);