<?php
/*  로그아웃 버튼
    세션 종료 및 세션 배열 모두 삭제
 */
session_unset();
session_destroy();

echo "<script> window.location.href = 'index.html' </script>";