<?php
// 게시글 삭제
$get_bNumer = $_GET['bNumber'];

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 쿼리 실행 : 해당 글 번호 글. 댓글, 댓글의 댓글 삭제
$query  = "delete from board where bNumber = $get_bNumer;";
@mysql_query($query);

$query  = "delete from feedback where bNumber = $get_bNumer;";
@mysql_query($query);

$query  = "delete from fb_fb where bNumber = $get_bNumer;";
@mysql_query($query);

@mysql_close();
echo "<script>window.location.href = 'index.html'</script>";
