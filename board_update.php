<?php
// 게시판 리스트을 업데이트 하거나 검색 결과를 보내준다.
$get_page = $_GET['page'];                 // 페이지 받아오기
$get_mode = $_GET['mode'];                 // 해야할 작업이 무엇인지 받아오기

// 데이터베이스 연결 관련 상수
define("HOST","localhost");
define("USER","root");
define("PASS","autoset");
define("DB_Name","board_site");

// sql 쿼리 문에 쓸 변수 설정
$tableName = "board";
$NumberOfPage = 5;                                                 // 한 페이지에 들어갈 게시글의 수
$FirstPage = $NumberOfPage * ( (+$get_page) - 1 );                 // 한 페이지의 첫번쨰 글의 bNumber;

// 데이터 베이스 연결
$db_conn = @mysql_connect( HOST,USER,PASS);
// 데이터 베이스 선택
@mysql_select_db(DB_Name);

// 해야할 작업에 따른 쿼리문 설정
if ($get_mode === "update"){
    $query = "select bNumber, bTitle, name, bDate, hit from $tableName order by bDate desc limit  $FirstPage, $NumberOfPage;";
} elseif ($get_mode === "research") {
    $option = $_GET['option'];
    $rs_value = $_GET['value'];

    if($option == "제목"){
        $where = "bTitle like \"%$rs_value%\" ";
    } elseif ($option == "내용"){
        $where = "bContents like \"%$rs_value%\" ";
    } elseif ($option == "작성자"){
        $where = "name like \"%$rs_value%\" ";
    } else{ //if ($option == "제목 + 내용 + 작성자")
        $where = "bTitle like \"%$rs_value%\" || bContents like \"%$rs_value%\" || name like \"%$rs_value %\"";
    }
    $query = "select bNumber, bTitle, name, bDate, hit from $tableName where $where order by bDate desc limit  $FirstPage, $NumberOfPage;";
}

// 쿼리 실행
$result = @mysql_query($query);
if($result){
    // 쿼리 입력 성공
    for ($i = 0; $i < $NumberOfPage; $i++){
        for($j = 0; $j < 5; $j++){
            echo @mysql_result($result, $i, $j);
            echo "||";
        }
    }
} else {
    // 쿼리 입력 실패
    echo false;
}

// 총 게시글 개수 구하기
if ($get_mode === "update"){
    $query = "select count(*) from $tableName;";
} elseif ($get_mode === "research") {
    $query = "select count(*) from board where $where";
}

$result = @mysql_query($query);
$NumberOfRecord = @mysql_result($result, 0, 0);
echo $NumberOfRecord;
@mysql_close();
