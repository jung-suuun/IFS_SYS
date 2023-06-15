<!DOCTYPE HTML>
<html>

<head>
    <title>0000 검색시스템</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="assets/css/main.css?after" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body class="is-preload">
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <header id="header">
                    <h1>0000 검색시스템</h1>
                </header>
                <section id="banner">
                    <div class="content">
                        <?
                            ini_set("session.cache_expire", 43200);  
                            ini_set("session.cookie_lifetime", 43200);  
                            session_start();
                            if(!isset($_SESSION['user_id'])) 
                            {
                                echo "<p>로그인이 필요합니다. <a href='login.html'>[로그인]</a></p>";
                            }
                            else
                            {
                                echo "<p>현재 로그인 상태입니다. <a href='logout.php'>[로그아웃]</a>";
                                echo "</p>";
                            }
                        ?>
                        <section>
                            <div style="border:3px double #0180cd; border-radius: 1.5%; padding:12px; 12px; 12px; 12px; ">
                                <span style="color:black">※ 정확한 장비 ID 입력 시 해당 장비가, 일부만 입력 시 포함하는 장비 전부가 검색됩니다.</span><br><br>
                                <form method="post" action="r_search.php">
                                    <div style="width:40%;  float:left;"><input type="text" style="height:50px; letter-spacing: 1px" name="c1"></div>
                                    <div style="width:60%; float:right;"><input type="submit" value="검색"></div>
                                </form><br><br>
                                <i class="fa fa-exclamation-triangle" border="0" onclick="alert('위치 검색 이후 화면에서 카카오맵 열기 버튼을 클릭해야 현재 위치를 불러올 수 있습니다.'); "> <strong>모바일 위치 검색 시 주의사항</strong></i><br>
                            </div>
                        </section><br>
                        <section>
                            <div>
                                <a href="manual.php" class="button small" style="margin-bottom: 10px;">매뉴얼</a>
                                <a href="board_list.php" class="button small" style="margin-bottom: 10px;">내역</a>

                                <script>
                                    var filter = "win16|win32|win64|mac|macintel";
                                    if (navigator.platform) {
                                        if (filter.indexOf(navigator.platform.toLowerCase()) < 0) {
                                            document.write('');
                                        } else {
                                            document.write('<a href="routemap.php" class ="button small" style="margin-bottom: 10px;">지도</a>');
                                        }
                                    }
                                </script>

                            </div>
                        </section>
                    </div>

                </section>

                <script>
                    $(document).ready(function() {
                        $('#favorite').on('click', function(e) {
                            var bookmarkURL = window.location.href;
                            var bookmarkTitle = document.title;
                            var triggerDefault = false;
                            if (window.sidebar && window.sidebar.addPanel) {
                                // Firefox version  < 23 
                                window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
                            } else if ((window.sidebar && (navigator.userAgent.toLowerCase().indexOf('firefox') > -1)) || (window.opera && window.print)) {
                                // Firefox version >= 23 and Opera Hotlist 
                                var $this = $(this);
                                $this.attr('href', bookmarkURL);
                                $this.attr('title', bookmarkTitle);
                                $this.attr('rel', 'sidebar');
                                $this.off(e);
                                triggerDefault = true;
                            } else if (window.external && ('AddFavorite' in window.external)) {
                                // IE Favorite 
                                window.external.AddFavorite(bookmarkURL, bookmarkTitle);
                            } else { // WebKit - Safari/Chrome 
                                alert((navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Cmd' : 'Ctrl') + '+D 키를 눌러 즐겨찾기에 등록하실 수 있습니다.');
                            }
                            return triggerDefault;
                        });
                    });
                </script>

                <script>
                    var filter = "win16|win32|win64|mac|macintel";
                    if (navigator.platform) {
                        if (filter.indexOf(navigator.platform.toLowerCase()) < 0) {
                            document.write('');
                        } else {
                            document.write('<a href="#" id="favorite" title="즐겨찾기 등록">▶ 즐겨찾기 추가</a>&nbsp;');
                        }
                    }
                </script>


                <script>
                    var filter = "win16|win32|win64|mac|macintel";
                    var binInfo = navigator.userAgent;
                    if (binInfo.indexOf(" SISUL_Android") > -1) {
                        document.write('');
                    } else {
                        if (navigator.platform) {
                            if (filter.indexOf(navigator.platform.toLowerCase()) < 0) {
                                document.write('<a href="down/app.php">▶ APP 설치하기</a>');
                            } else {
                                document.write('');
                            }
                        }
                    }
                </script>
                <span style="color:#0180cd;" id="test" style="cursor: hand" onclick="if(plain.style.display=='none'){plain.style.display=''; test.innerText = '▼ 웹 사이트 사용법'} else {plain.style.display='none'; test.innerText = '▶ 웹 사이트 사용법'}">▶ 웹 사이트 사용법</span>
                <div id="plain" style="display: none">
                    <script>
                        var filter = "win16|win32|win64|mac|macintel";
                        if (navigator.platform) {
                            if (filter.indexOf(navigator.platform.toLowerCase()) < 0) {
                                document.write('<div style="position: relative; height:0; padding-bottom: 56.25%; margin: 0px 0px;"> <iframe width="560" height="315" src="https://www.youtube.com/embed/xxxxxxx" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: absolute; width:100%; height:100%;"></iframe></div>');
                            } else {
                                document.write('<iframe width="560" height="315" src="https://www.youtube.com/embed/xxxxxxxxxx" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!-- Design: <a href="https://html5up.net">HTML5 UP</a>. Web Configure: -->
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>