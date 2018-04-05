<?php
//var_dump($_POST);
$conn = mysqli_connect(
  "localhost",
  "alexnet",
  "alexnet1234",
  "opentutorials");

$filtered = array(
  'title' =>htmlspecialchars(mysqli_real_escape_string($conn, $_POST['id'])),
  'description' => htmlspecialchars(mysqli_real_escape_string($conn, $_POST['description']))
);

$sqlcmd = "
  INSERT INTO topic
    (title, description, created)
    VALUE(
      '{$filtered['title']}',
      '{$filtered['description']}',
      NOW()
    );
";
$res = mysqli_query($conn, $sqlcmd);
if(true != $res) {
  // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
  echo "저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
  error_log(mysqli_error($conn));
}
else
{
  //header("Location: /index.php");
  echo '성공했습니다. <a href="index.php">돌아가기</a>';
}
?>