<?php
// 게시글의 댓글을 가져온다.
$bNumber = $_GET['bNumber'];

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 쿼리 실행 : 해당 글 번호의 정보 가져오기
$query  = "select fNumber, fwriter, fContents, fDate, id from feedback where bNumber=$bNumber";
$result = @mysql_query($query);
$Num_record = @mysql_num_rows($result);                         // 레코드 개수

for($i = 0 ; $i < $Num_record; $i++){
    for($j = 0 ; $j < 5; $j++) {
        //echo mysql_result($result,0,$i);
        echo html_entity_decode(mysql_result($result, $i, $j));               // html 엔터티를 해당 문자로 변환
        echo "|I|";
    }
}

$query = "select count(*) from feedback where bNumber = $bNumber;";
$result = @mysql_query($query);
$NumberOfRecord = @mysql_result($result, 0, 0);
echo $NumberOfRecord;

@mysql_close();