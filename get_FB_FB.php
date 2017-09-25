<?php
// 댓글의 댓글을 해당 게시글에 보낸다.
// 해당 게시글의 게시글 번호를 받는다.
$get_bNumber = $_GET['bNumber'];

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 쿼리 설정
$query  = "select fNumber, fb_fNumber, id, fWriter, fContents, fDate from FB_FB where bNumber=$get_bNumber";

// 쿼리 실행
$result = @mysql_query($query);

// 레코드 갯수 값
$Num_record = @mysql_num_rows($result);

for($i = 0 ; $i < $Num_record; $i++){
    for($j = 0 ; $j < 6; $j++) {
        //echo mysql_result($result,0,$i);
        echo html_entity_decode(mysql_result($result, $i, $j));               // html 엔터티를 해당 문자로 변환
        echo "|I|";
    }
}

$query = "select count(*) from FB_FB where bNumber = $get_bNumber";
$result = @mysql_query($query);
$NumberOfRecord = @mysql_result($result, 0, 0);
echo $NumberOfRecord;
@mysql_close($db_conn);