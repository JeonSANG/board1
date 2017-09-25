<?php
// 작성한 글 저장하기!
define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

$get_title = htmlspecialchars($_GET['bTitle']);                         // 글 제목, HTML 엔티티로 변환( 태그 입력, 오류 방지 )
$get_contents = htmlspecialchars($_GET['bContents']);                   // 글 내용, HTML 엔티티로 변환( 태그 입력, 오류 방지 )
$get_date  = DATE('Y-m-d H:i:s',time());
$get_id = $_GET['bWriter'];
$get_mode = $_GET['bMode'];

// 제목이 입력 되어 있는지 체크
if($get_title === "" || $get_title === null || $get_title === " 제목 "){
    echo "<script> alert('제목을 입력해 주세요 ');";
    echo "window.location.href = \"write_page.html\" </script>";
}

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

if($get_mode === "insert"){
    // 글 쓰기 모드
    $query = "insert into board values(0,'$get_title','$get_contents','$get_date','$get_id',(select name from membertable where  id = '$get_id'), 0);";
} elseif ($get_mode === "alter") {
    // 글 수정 모드
    $get_bNumber = $_GET['bNumber'];
    $query = "update board set bTitle = \"$get_title\", bContents = \"$get_contents\" where bNumber = $get_bNumber;";

}

if(@mysql_query($query)){
    echo "<script> alert('저장 성공'); ";
    echo " window.location.href = \"index.html\" </script>";
} else {
    echo "<script> alert('저장 실패');";
    echo "window.location.href = \"write_page.html\" </script>;";
}
@mysql_close($db_conn);