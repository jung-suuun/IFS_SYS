<style type="text/css">
    a {
        text-align: center;
    }
</style>
<?php
	/* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
    $conn = mysqli_connect("localhost", "ID", "PW","DB NAME");
    $c1_d = $_POST["c1"]; 
	if(isset($_GET['page'])) 
	{
		$page = $_GET['page'];
	} 
	else 
	{
		$page = 1;
	}
	$sql = 'select count(*) as cnt from board order by board_no desc';
    $result = mysqli_query($conn,$sql);
	$row = $result->fetch_assoc();
	$allPost = $row['cnt']; //전체 게시글의 수
	$onePage = 9999; // 한 페이지에 보여줄 게시글의 수.
	$allPage = ceil($allPost / $onePage); //전체 페이지의 수
	if($page < 1 || ($allPage && $page > $allPage)) {
?>
<script>
    alert("존재하지 않는 페이지입니다.");
    history.back();
</script>
<?php
	exit;
	}
	$oneSection = 5; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
	$currentSection = ceil($page / $oneSection); //현재 섹션
	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

	if($currentSection == $allSection) 
	{
		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
	} 
	else 
	{
		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
	}

	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
	$paging = ''; // 페이징을 저장할 변수

	//첫 페이지가 아니라면 처음 버튼을 생성
	if($page != 1) 
	{ 
		$paging .= '<a href="./list_view.php?page=1"> [처음] </a>';
	}

	//첫 섹션이 아니라면 이전 버튼을 생성
	if($currentSection != 1) { 
		$paging .= '<a href="./list_view.php?page=' . $prevPage . '"> [이전] </a>';
	}

	for($i = $firstPage; $i <= $lastPage; $i++) 
	{
		if($i == $page) 
		{
			$paging .= '<a style="color:#0180cd;">'. $i . '</a>';
		} 
		else 
		{
			$paging .= ' <a style="color:#0180cd;">[</a><a href="./list_view.php?page=' . $i . '">' . $i . '</a><a style="color:#0180cd;">]</a> ';
		}
	}

	//마지막 섹션이 아니라면 다음 버튼을 생성
	if($currentSection != $allSection) 
	{ 
		$paging .= '<a href="./list_view.php?page=' . $nextPage . '"> [다음] </a>';
	}

	//마지막 페이지가 아니라면 끝 버튼을 생성
	if($page != $allPage) 
	{ 
		$paging .= '<a href="./list_view.php?page=' . $allPage . '"> [끝] </a>';
	}
	$paging .= '';

	/* 페이징 끝 */
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

	$c1_d = $_POST["c1"]; 
	$sql = "select * from board WHERE board_title like '$c1_d' order by board_no desc" . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지)
	$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>내역 확인</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="./assets/css/main.css" />
    <?php
		ini_set("session.cache_expire", 43200);  
		ini_set("session.cookie_lifetime", 43200);  
		session_start();
		if(!isset($_SESSION['user_id'])) 
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
                    <h1><?php echo "$c1_d";?>이력</h1>
                    <div style="text-align:right">
                        <a onClick="history.back()"><span class="fa fa-times fa-3x"></span></a>
                    </div>
                </header>
                </br>
                <div class="content">
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" class="date">조치일시</th>
                                    <th scope="col" class="content">조치내용</th>
                                    <th scope="col" class="user">조치자</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									while($row = $result->fetch_assoc())
									{
										$datetime = explode('T', $row['board_date']);
										$date = $datetime[0];
										$time = $datetime[1];
										$row['board_date'] = $date." ".$time;     
								?>
                                <tr>
                                    <td class="date"><?php echo $row['board_date']?></td>
                                    <td class="content"><?php echo $row['board_content']?></td>
                                    <td class="user"><?php echo $row['board_user']?></td>
                                    <?php 
                            			$check = $row['board_no'];
                        			?>
                                </tr>
                                <?php
									}
								?>
                            </tbody>
                        </table>
                        <?
                        if ( empty($check) ) 
                        {
                            echo "<div><center><form method='post' action='board_add_form.php'>
				            <input type='hidden' name='c2' value='$c1_d'><h3 style='text-align:center; color:black;'>등록된 장애이력이 없습니다.&nbsp;&nbsp;<!--<input type='submit' class='' value='장애 등록'>--!>
				            </form></h3> </center></div>";   
                        }   
                        else
                        {
                            echo "<!--<form method='post' action='board_add_form.php'>
                            <div style='float:left;'><input type='hidden' name='c2' value='$c1_d'></div>	<div style='float:left;' ><br><input type='submit' class='button small' value='장애 등록'></div>
                            </form>--!>";
                        }
						;?>
                        <div class="paging">
                            <p style="text-align:center;"><?php //echo $paging ?></p>
                        </div>
                    </div>
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