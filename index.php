<?php
//var_dump($_POST);
$conn = mysqli_connect(
  "localhost",
  "alexnet",
  "alexnet1234",
  "opentutorials");

$sqlcmd = "SELECT * from topic limit 100";
$res = mysqli_query($conn, $sqlcmd);
if(true != $res) {
  // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
  echo "조회하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
  error_log(mysqli_error($conn));
}

$list = "";
while($row = mysqli_fetch_array($res)) {
  //<li><a href='index.php?id=19'>MySQL</a></li>
   $list = $list . "<li><a href='index.php?id={$row['id']}'>{$row['title']}</a></li>";
}

$article = array(
  'id'=>NULL,
  'title'=>"Welcome",
  'description'=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
);
if(isset($_GET['id'])) {
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sqlcmd = "SELECT * from topic where id='$filtered_id'";
  $res = mysqli_query($conn, $sqlcmd);
  if(true != $res) {
    // 개발시에만 이렇게 화면에, 제대로 개발시에는 파일에 로그를 쌓도록 하는게 좋음
    echo "조회하는 과정에서 문제가 발생했습니다. 관리자에게 문의 주세요.";
    error_log(mysqli_error($conn));
  }

  $row = mysqli_fetch_array($res);
  $article['id'] = $row['id'];
  $article['title'] = $row['title'];
  $article['description'] = $row['description'];
}

$hyperlink_menu = "<a href=\"create.php\">Create</a>";
if(isset($_GET['id'])) {
      $hyperlink_menu = $hyperlink_menu . "<br><a href=\"update.php?id={$article['id']}\">Update</a>";
       $hyperlink_menu = $hyperlink_menu . "<br><form action=\"process_delete.php\" method=\"post\">";
       $hyperlink_menu = $hyperlink_menu . "  <p><input type=\"hidden\" name=\"id\" value=\"{$article['id']}\"></p>";
       $hyperlink_menu = $hyperlink_menu . "  <p><input type=\"submit\" value=\"delete\"></p>";
       $hyperlink_menu = $hyperlink_menu . "</form>";
}

//print_r(article);
//< ?php echo $list; ? >
//< ?=$list;? >
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href='index.php'>WEB</a></h1>
    <ol>
      <?=$list?>
    </ol>
    <?=$hyperlink_menu?>
    <h2><?=$article['title']?></h2>
     <?=$article['description']?>
  </body>
</html>