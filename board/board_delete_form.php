<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="shortcut icon" href="images/favicon.ico">
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
        if($user_id == 'xxxxxxx') 
        {
            echo "<meta http-equiv='refresh' content='0;url=index.php'>";
            exit;
        }
    ?>
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <div id="main">
            <div class="inner">
                <!-- Header -->
                <header id="header">
                    <h1>내역 삭제</h1>
                    <div style="text-align:right">
                        <a href="board_list.php"><span class="fa fa-times fa-3x"></span></a>
                    </div>

                </header>

                <!-- Banner -->
                <section id="banner">
                    <div class="content">

                        <?php
                            //board_list.php 페이지에서 넘어온 글 번호값 저장 및 출력
                            $board_no = $_GET["board_no"];
                            echo $board_no."번째 글 삭제 페이지</br></br>";
                        ?>
                        <!-- board_delete_action.php 페이지로 post방식을 이용하여 값 전송 -->
                        <form action="/board_delete_action.php" method="post">
                            <table class="table table-bordered" style="width:100%">
                                <tr>
                                    <td>비밀 번호를 입력하세요.</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="board_pw">
                                        <input type="hidden" name="board_no" value="<?php echo $board_no ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-primary" type="submit">삭제</button></td>
                                </tr>
                            </table>
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