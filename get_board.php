<?php
// 게시글 클릭 시 게시글 데이터를 보내줌
// 글 번호를 받는다.
$bNumber = $_GET['number'];

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 조회수 증가
$query  = "update board set hit = hit + 1 where bNumber = $bNumber;";
@mysql_query($query);

// 쿼리 실행 : 해당 글 번호의 정보 가져오기
$query  = "select * from board where bNumber=$bNumber";
$result = @mysql_query($query);

for($i = 0 ; $i < 7; $i++){
    //echo mysql_result($result,0,$i);
    echo html_entity_decode (mysql_result($result,0,$i));               // html 엔터티를 해당 문자로 변환
    echo "|I|";
}

@mysql_close();