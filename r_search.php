<!-- 검색결과 출력-->
<!DOCTYPE HTML>
<html>
<head>
<?php //로그인 세션 처리
	header("Cache-Control: no cache");
	session_cache_limiter("private_no_expire");
	ini_set("session.cache_expire", 43200);  
	ini_set("session.cookie_lifetime", 43200);  
	session_start();
	if(!isset($_SESSION['user_id'])) 
	{
		echo "<script>document.location.href='index.php';</script>";
		exit;
	}
?>
<title>검색 결과</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
<link rel="stylesheet" href="assets/css/main.css"/>
</head>
<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">
	<!-- Main -->
	<div id="main">
		<div class="inner">
		<header id="header">				
				<div style="float:left">
					<h1>검색 결과</h1>
				</div>
				<div style="text-align:right">
					<a href="index.php"><span class="fa fa-times fa-3x"></span></a> 
				</div>
		</header>
			<!-- Content -->
			<section>
			<h4>
			<?php //DB 처리
			ini_set('display_errors', '0');
			$s = mysql_connect("localhost", "ID", "PW") or die("■ 데이터베이스 접속 상태 : 실패.<br></br>"); 
			mysql_query("SET NAMES utf8");
			//print "■ 데이터베이스 접속 상태 : 성공.<br></br>"; 
			mysql_select_db("DB NAME"); $c1_d = $_POST["c1"]; 
			$re = mysql_query("SELECT * FROM NUM WHERE MatrixNum LIKE '$c1_d' or id LIKE '$c1_d'"); 
						if ($result = mysql_fetch_array($re)) 
						{ 
							if(empty($result[1]))
							{
                                if(empty($result[4]))
                                {
                                    echo "시설물 "; 
								    echo $result[5];
								    echo "에 대한 검색 결과입니다. "; 
								    echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								        </form><form method='post' action='list_view.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								        </form></ul>"; mysql_close($s); return;
                                }
								    echo "시설물 "; 
								    echo $result[5];
								    echo "에 대한 검색 결과입니다. "; 
                                    echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								        </form><form method='post' action='list_view.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								        </form></ul>"; mysql_close($s); return;
							}
							
							else if(empty($result[0])||empty($result[2])||empty($result[3]))
				            {
                                if(empty($result[4]))
                                {
                                    echo "시설물 "; 
								    echo $result[5];
								    echo "(#$result[1])";
								    echo "에 대한 검색 결과입니다. "; 
								    echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								        </form><form method='post' action='list_view.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								        </form></ul>"; mysql_close($s); return;
                                }
								    echo "시설물 "; 
								    echo $result[5];
								    echo "(#$result[1])";
								    echo "에 대한 검색 결과입니다. "; 
								    echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								        </form><form method='post' action='list_view.php'>
									   <div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								        </form></ul>"; mysql_close($s); return;						
				            }
				            else
				            {
                                if(empty($result[4]))
                                {
                                    echo "시설물 "; 
								    echo $result[5];
								    echo "(#$result[1])"; 
								    echo "번은 "; 
								    if($result[1]==341||$result[1]==344)
								    {
								        echo "철거된 시설물입니다."; mysql_close($s); return;
								    }
								    switch($result[0])
								    {

									case '1' : echo "2-2xxxxxxxx와 연결."; mysql_close($s);	
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;										
								
									case '2' : echo "2-2xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;	
									
							
									case '3' : echo "2-1xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;	
									
							
									case '4' : echo "3xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;
									
								
									case '5' : echo "2-1xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;

								
									case '6' : echo "2-1xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;

							
									case '7' : echo "3xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='' class=''></a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;

								    } 
                                }
                                else
                                {
								    echo "시설물 "; 
								    echo $result[5];
								    echo "(#$result[1])"; 
								    echo "번은 "; 
								 
								    switch($result[0])
								    {

						 	
									case '1' : echo "2-2xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;										
								
							
									case '2' : echo "2-2xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;	
									
						
									case '3' : echo "2-1xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;	
									
							
									case '4' : echo "3xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;
									
				
									case '5' : echo "2-1xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;

					
									case '6' : echo "2-1xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;

						
									case '7' : echo "3xxxxxxxx와 연결."; mysql_close($s);
									echo "</br></br><ul class='actions'><li><a href='$result[4]' class='button large'>위치</a></li><form method='post' action='pdf-run/search.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='이력카드'></div>
								    </form><form method='post' action='list_view.php'>
									<div style='float:left;'><input type='hidden' name='c1' value='$result[5]'></div>	<div style='float:left;' ><input type='submit' class='button large' value='내역'></div>
								    </form></ul>"; return;

								    } 
							     }    									
						      }
                            }
						else //일부 글자로 검색시 처리
						{
				            $cnt = mysql_query("select count(*) as cnt from NUM WHERE MatrixNum LIKE '%$c1_d%' or id LIKE '%$c1_d%'");
                            $cntrow = mysql_fetch_array($cnt);
                            $cntre = $cntrow['cnt'];
                            $re2 = mysql_query("SELECT * FROM NUM WHERE MatrixNum LIKE '%$c1_d%' or id LIKE '%$c1_d%'"); 
                            $re3 = mysql_query("SELECT * FROM NUM WHERE MatrixNum LIKE '%$c1_d%' or id LIKE '%$c1_d%' limit 1"); 
                          
							if($cntre == 0)
							{
								header("location: ./error1.html");
							}

                            echo "※ '$c1_d'를 포함하는 결과 '$cntre'개가 검색되었습니다. 버튼 클릭 시 해당 페이지로 이동합니다. ※"."<br><br>";                
                        
                            while($row = mysql_fetch_array($re2)){                                
                            echo "<form method='post' action='r_search.php' style='display:inline'><input type='hidden' value='$row[5]' name='c1'><input type='submit' value='$row[5]'></form>";
                            }                          
						} 			
				?></h4>
			</section>
		</div>
	</div>
</div>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/returnpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>