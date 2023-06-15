<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <h1>board_add_action.php</h1>
       
        <?php
            //board_add_form.php 페이지에서 넘어온 글 번호값 저장 및 출력
            $board_pw = $_POST["boardPw"];
            $board_title = $_POST["boardTitle"];
            $board_content = $_POST["boardContent"];
            $board_user = $_POST["boardUser"];
            $board_date = $_POST["boardDate"];
            echo "board_pw : " . $board_pw . "<br>";
            echo "board_title : " . $board_title . "<br>";
            echo "board_content : " . $board_content . "<br>";
            echo "board_user : " . $board_user . "<br>";
            echo "board_date : " . $board_date . "<br>";     
            $now1 = date("Y-m-d");
            $now2 = date("H:i");
            $now3 = $now1."T".$now2;
        
            
            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "ID", "PW", "DB NAME");
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            if(empty($board_pw)||empty($board_title)||empty($board_content)||empty($board_user))
            {
                mysqli_close($conn);
                header("Location: http://localhost/board_list.php");
            }
            if(empty($board_date))
            {
                $sql = "INSERT INTO board (board_pw, board_title, board_content, board_user, board_date) values ('".$board_pw."','".$board_title."','".$board_content."','".$board_user."','".$now3."')";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $sql = "ALTER TABLE board AUTO_INCREMENT=1";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $sql = "SET @CNT = 0";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $sql = "UPDATE board SET board.board_no = @CNT:=@CNT+1";
                $result = mysqli_query($conn,$sql);
            }
            else{
                 //board 테이블에 입력된 값을 1행에 넣고 board_date 필드에는 현재 시간을 입력하는 쿼리
                $sql = "INSERT INTO board (board_pw, board_title, board_content, board_user, board_date) values ('".$board_pw."','".$board_title."','".$board_content."','".$board_user."','".$board_date."')";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $sql = "ALTER TABLE board AUTO_INCREMENT=1";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $sql = "SET @CNT = 0";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $sql = "UPDATE board SET board.board_no = @CNT:=@CNT+1";
                $result = mysqli_query($conn,$sql);
                // 쿼리 실행 여부 확인
            }
           
            if($result) {
                echo "입력 성공: ".$result; //과제 작성시 에러메시지 출력하게 만들기
            } else {
                echo "입력 실패: ".mysqli_error($conn);
            }
            mysqli_close($conn);
            //헤더함수를 이용하여 리스트 페이지로 리다이렉션
            header("Location: http://localhost/board_list.php"); //헤더 함수를 이용해서 리다이렉션 시킬 수 있다.
        ?>
        
    </body>
</html>