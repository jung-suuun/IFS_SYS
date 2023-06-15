<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>내역 등록</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="shortcut icon" href="images/favicon.ico">
    <?php
            ini_set("session.cache_expire", 43200);  
            ini_set("session.cookie_lifetime", 43200);  
            session_start();
            if(!isset($_SESSION['user_id'])) {
                echo "<meta http-equiv='refresh' content='0;url=index.php'>";
                exit;
            }
            if($user_id == 'XXXXXXX') {
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

<?
        $conn = mysqli_connect("localhost", "ID", "PW","DB NAME");
        $c2_d = $_POST["c2"]; 
    ?>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <div id="main">
            <div class="inner">
                <!-- Header -->

                <header id="header">
                    <h1>내역 등록</h1>
                    <div style="text-align:right">
                        <a href="board_list.php"><span class="fa fa-times fa-3x"></span></a>
                    </div>
                </header>

                <!-- Banner -->
                <section id="banner">
                    <div class="content">
                        <h5 style='color:red;'>※ 빈칸이 있을경우 조치내역 등록이 불가합니다. ※</h5>
                        <form class="form-horizontal" action="/board_add_action.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-2 control-label">작성 비밀번호 (1111이 초기 비밀번호로 설정되어 있습니다.) </label>
                                <div class="col-sm-10">
                                    <!-- 글 비밀번호 입력 상자 -->
                                    <input class="form-control" name="boardPw" id="password" type="password" value="1111" />
                                </div>
                            </div></br>
                            <div class="form-group">
                                <label for="exampleInputTitle1" class="col-sm-2 control-label">시설물 ID</label>
                                <div class="col-sm-10">
                                    <!-- 글 제목 입력 상자 -->
                                    <? echo "<input class='form-control' name='boardTitle' id='Title' type='text' value='$c2_d'/>"; ?>
                                </div>
                            </div></br>
                            <div class="form-group">
                                <label for="exampleInputContent1" class="col-sm-2 control-label">조치내용 : </label> <!-- (따옴표 "",''가 내용에 들어가면 에러가 발생합니다. 추후 수정예정.) -->
                                <div class="col-sm-10">
                                    <!-- 글 내용 입력 텍스트영역 -->
                                    <textarea class="form-control" name="boardContent" id="content" rows="5" cols="50" placeholder="Content"></textarea>
                                </div>
                            </div></br>
                            <div class="form-group">
                                <label for="exampleInputName1" class="col-sm-2 control-label">조치자 : </label>
                                <div class="col-sm-10">
                                    <!-- 작성자명 입력 상자 -->
                                    <input class="form-control" name="boardUser" id="name" type="text" placeholder="Name" />
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label for="exampleInputDate1" class="col-sm-2 control-label">날짜 (빈칸으로 두는 경우 현재 시간이 등록됩니다.) &nbsp;&nbsp;<i class="fa fa-exclamation-triangle" border="0" onclick="alert('익스플로러, 사파리, 파이어폭스에서는 날짜입력을 지원하지 않습니다. 해당 브라우저를 사용하는 경우에는 아래와 같은 형식으로 등록바랍니다. \n\n예시) 2020년 3월 26일 오후 4시 5분인 경우 - 2020-03-26T16:05'); "> <strong>주의사항</strong></i></label>
                                <div class="col-sm-10">
                                    <!-- 날짜 입력 상자 -->
                                    <input class="form-control" name="boardDate" id="date" type="datetime-local" placeholder="년도-월-일T시:분" />
                                </div>
                            </div>

                            <div></br>

                                <!-- 글 입력 버튼 -->
                                <button type="submit" value="글 입력">내역등록</button>

                                <!-- 입력 내용 초기화 버튼 -->
                                <button type="reset" value="초기화">초기화</button>

                            </div>
                        </form>
                        <script type="text/javascript">
                            //id가 XX인 객체에 변화가 생기면 checkXX 함수를 변화된 객체의 값을 매개로 호출
                            $("#password").change(function() {
                                checkPassword($('#password').val());
                            });
                            $("#Title").change(function() {
                                checkTitle($('#Title').val());
                            });
                            $("#content").change(function() {
                                checkTitle($('#content').val());
                            });
                            $("#name").change(function() {
                                checkName($('#name').val());
                            });

                            //입력된 변수의 길이를 참조하여 조건문을 통해 최소 입력 길이 유효성 검사를 하는 함수
                            function checkPassword(password) {
                                if (password.length < 4) {
                                    alert("비밀번호는 4자 이상 입력하여야 합니다.");
                                    $('#password').val('').focus();
                                    return false;
                                } else {
                                    return true;
                                }
                            }

                            function checkTitle(Title) {
                                if (Title.length < 2) {
                                    alert('제목은 2자 이상 입력해야 합니다.');
                                    $('#Title').val('').focus();

                                    return false;
                                } else {
                                    return true;
                                }
                            }

                            function checkContent(content) {
                                if (content.length < 2) {
                                    alert('내용은 2자리 이상 입력해야 합니다.');
                                    $('#content').val('').focus();
                                    return false;
                                } else {
                                    return true;
                                }
                            }

                            function checkName(name) {
                                if (name.length < 2) {
                                    alert('조치자명은 2자리 이상 입력해야 합니다.');
                                    $('#name').val('').focus();
                                    return false;
                                } else {
                                    return true;
                                }
                            }
                        </script>
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