<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>내역 수정</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- 테이블 크기 조절용 css -->
    <style>
        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
    <?php
        ini_set("session.cache_expire", 43200);  
        ini_set("session.cookie_lifetime", 43200);  
        session_start();
        if(!isset($_SESSION['user_id'])) 
        {
            echo "<meta http-equiv='refresh' content='0;url=index.php'>";
            exit;
        }
        $user_id = $_SESSION['user_id'];
        if($user_id == 'XXXXX') 
        {
            echo "<meta http-equiv='refresh' content='0;url=index.php'>";
            exit;
        }
    ?>
</head>

<script>
    // 입력을 제한 할 특수문자의 정규식
    var replaceId = /[''""]/gi;
    $(document).ready(function() {
        $("#content").on("focusout", function() {
            var x = $(this).val();
            if (x.length > 0) {
                if (x.match(replaceId)) {
                    x = x.replace(replaceId, "");
                }
                $(this).val(x);
            }
        }).on("keyup", function() {
            $(this).val($(this).val().replace(replaceId, ""));
        });
    });
</script>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <div id="main">
            <div class="inner">
                <!-- Header -->
                <header id="header">
                    <h1>내역 수정</h1>
                    <div style="text-align:right">
                        <a href="board_list.php"><span class="fa fa-times fa-3x"></span></a>
                    </div>
                </header>
                <!-- Banner -->
                <section id="banner">
                    <div class="content">
                        <?php
                            //커넥션 객체 생성 (데이터 베이스 연결)
                            $conn = mysqli_connect("localhost", "ID", "PW","DB NAME");
                            $board_no = $_GET["board_no"];
                            echo $board_no."번째 글 수정 페이지<br>";
                            //board 테이블을 조회하여 board_no의 값이 일치하는 행의 board_no, board_title, board_content, board_user, board_date 필드의 값을 가져오는 쿼리
                            $sql = "SELECT board_no, board_title, board_content, board_user, board_date FROM board WHERE board_no = '".$board_no."'";
                            $result = mysqli_query($conn,$sql);
                            if($row = mysqli_fetch_array($result)){
                        ?>
                        <br>
                        <form action="/board_update_action.php" method="post">
                            <table class="table table-bordered" style="width:100%">
                                <tr>
                                    <td style="width:10%">순번</td>
                                    <td style="width:20%"><input type="text" name="board_no" value="<?php echo $row["board_no"]?>" readonly></td>
                                </tr>
                                <tr>
                                    <td style="width:10%">시설물 ID</td>
                                    <td style="width:20%"><input type="text" name="board_title" value="<?php echo $row["board_title"]?>"></td>
                                </tr>
                                <tr>
                                    <td style="width:10%">조치내용</td>
                                    <td style="width:20%"><input type="text" name="board_content" value="<?php echo $row["board_content"]?>"></td>
                                </tr>
                                <tr>
                                    <td style="width:10%">날짜</td>
                                    <td style="width:20%"><input type="datetime-local" name="board_date" value="<?php echo $row["board_date"]?>"></td>
                                </tr>
                            </table>
                            <br>
                            <?php
                                }
                                //커넥션 객체 종료
                                mysqli_close($conn);
                            ?>
                            <button class="btn btn-primary" type="submit">수정</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>