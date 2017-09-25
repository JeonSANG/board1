<?php
$id = $_GET['id'];
$pass = $_GET['pass'];

define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// 입력 값 확인
if ( $id === "" || $id === " " || $id === "id"){
    echo "<script> alert('아이디를 입력하세요'); ";
    echo "window.location.href = 'login.html'</script>";
}
else if ( $pass === "" || $pass === " " || $pass === "password" ){
    echo "<script> alert('패스워드를를 입력하세요'); ";
    echo "window.location.href = 'login.html'</script>";
}
// 문제가 없을 시 데이터 베이스 연결 후 바른 아이디 비밀번호인지 맞추어 본다.
else {
    // 데이터 베이스 연결
    $db_conn = @mysql_connect( HOST,USER,PASS);

    // 데이터 베이스 선택
    @mysql_select_db(DB_Name);

    // 입력 값이 데이터베이스에 있는 지 검색
    $query = "select * from membertable where id='$id' and password='$pass';";
    ;
    $result = @mysql_query($query);
    // 로그인 성공, 'index.html'로 이동
    if( mysql_result($result,0,0) != null  ){
        session_start();
        $_SESSION['id'] = @mysql_result($result,0,0);
        $_SESSION['name'] = @mysql_result($result,0,2);

        @mysql_close();
        echo "<script> window.location.href=\"index.html\"</script>";
    }
    // 로그인 실패, 로그인 창으로 돌아가기
    else {
        @mysql_close();
        echo "<script> alert('로그인 실패! 존재하지 않는 회원입니다.'); ";
        echo "window.location.href = \"login.html\"</script>";
    }
}

