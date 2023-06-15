<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
    ini_set("session.cache_expire", 43200);  
    ini_set("session.cookie_lifetime", 43200);  
    session_start();
    $id = $_POST['id'];
    $pw = md5($_POST['pw']);
    $mysqli = mysqli_connect("localhost","ID","PW","DB NAME");
    $check = "SELECT * FROM login WHERE user_id='$id'";
    $result = $mysqli->query($check); 
    if ($result->num_rows==1)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC); 
        if ($row['user_pw'] == $pw)
        {  
            $_SESSION['user_id'] = $id;           
            if(isset($_SESSION['user_id']))    
            {
                header('Location: ./ip_log.php');   
            }
            else{
                echo "<script type='text/javascript'>alert('로그인 에러. 관리자에게 문의하세요.');</script>";
                echo "<script type='text/javascript'>history.back();</script>";
            }            
        }
        else{
            echo "<script type='text/javascript'>alert('잘못된 ID나 PASSWORD를 입력했습니다.');</script>";  
            echo "<script type='text/javascript'>history.back();</script>";
    
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('잘못된 ID나 PASSWORD를 입력했습니다.');</script>";  
        echo "<script type='text/javascript'>history.back();</script>";
    }
?>
