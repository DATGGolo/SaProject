<!doctype html>
<?php
session_start();
include '../../php/FindOrder.php';
include_once '../../php/DataBase.php';
@logInSure();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>更新客戶</title>
        <!-- 連結思源中文及css -->
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC" rel="stylesheet">
        <link href="../../images/user.jpg" rel="icon">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/menu.css" rel="stylesheet">
        <link href="assets/css/main.css" rel="stylesheet">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="assets/js/sweetalert.min.js" type="text/javascript"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!------------------------->
    </head>

    <body>
        <?php
        $nameErr = $emailErr = $genderErr = $idErr = $birErr = $phoneErr = $DateErr = "";
        $name = $id = $bir = $num = $phone = $email = "";
        $sure = true;

        if (isset($_POST["Reg"])) {
            $name = $_POST["name"];
            $id = $_POST["id"];
            $bir = $_POST["bir"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];

            if (empty($_POST["name"])) {

                $nameErr = "姓名是必填的!";
                $sure = false;
            }

            if (empty($_POST["id"])) {
                $idErr = "身分證是必填的!";
                $sure = false;
            } else {
                $idtest = test_input($_POST["id"]);
                if (!preg_match("/^[A-Z]{1}[0-9]{9}$/", $idtest)) {
                    $idErr = "身分證不符合格式!";
                    $sure = false;
                }
            }

            if (empty($_POST["bir"])) {
                $birErr = "生日是必填的!";
                $sure = false;
            } else {
//            $date = (strtotime($bir) - strtotime(date('Y-m-d'))) / (365*3+366);
                $age = round((time() - strtotime($bir)) / (24 * 60 * 60) / 365.25, 0);

                if ($age < 20) {
                    $birErr = "低於20歲無法訂房!";
                    $sure = false;
                }
            }

            if (empty($_POST["phone"])) {
                $phoneErr = "手機是必填的!";
                $sure = false;
            } else {
                $phonetest = test_input($_POST["phone"]);
                if (!preg_match("/^09[0-9]{8}$/", $phonetest)) {
                    $phoneErr = "手機號碼不符合格式!";
                    $sure = false;
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "E-mail是必填的!";
                $sure = false;
            }
            if ($sure) {

                $db = DB();
                $sql = "UPDATE \"顧客資料\" \n" .
                        "SET \"顧客編號\" = ".$_SESSION["idNum"].",\n" .
                        "\"顧客名稱\" = '".$_POST["name"]."',\n" .
                        "\"生日\" = '".$_POST["bir"]."',\n" .
                        "\"身分證字號\" = '".$_POST["id"]."',\n" .
                        "\"連絡電話\" = '".$_POST["phone"]."',\n" .
                        "\"電子郵件\" = '".$_POST["email"]."',\n" .
                        "\"性別\" = '".$_POST["gender"]."' \n" .
                        "WHERE\n" .
                        "	\"顧客編號\" =" . $_SESSION["idNum"];

                $db->query($sql);
//                echo 'swal("新增成功！", "回到客戶總覽 或是 客戶新增?", "success").then(function (result) {
//                    
//                    window.location.href = "http://tw.yahoo.com";
//                }); ';

                echo '        <script>
            swal({
                title: "更改成功！",
                text: "回到客戶總覽 或是 更新客戶?",
                icon: "success",
                buttons: {
                    1: {
                        text: "客戶總覽",
                        value: "客戶總覽",
                    },
                    2: {
                        text: "更新客戶",
                        value: "更新客戶",
                    },
                },

            }).then(function (value) {
                switch (value) {
                    case"客戶總覽":
                        window.location.href = "all.php";
                        break;
                    case"更新客戶":
                        window.location.href = "change.php";
                        break;
                        

                }
            })
        </script>  ';


//                header("Location:all.php");
            } else {
                $mes = $idErr . $birErr . $phoneErr . $DateErr;
                echo '<script>  swal({
                text: "' . $mes . '",
                icon: "error",
                button: false,
                timer: 3000,
            }); </script>';
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <!-- Header -->
        <header id="header" class="alt">
            <div class="logo"><a href="../../index/index.html">渡假村 <span>RESORT</span></a></div>
            <a href="#menu">Menu</a>
        </header>

        <!-- Nav -->
        <nav id="menu">
            <ul class="links">
                <li><a href="../../news/news.html">最新消息</a></li>
                <li><a href="../../room/room.php">訂房服務</a></li>
                <li><a href="../../room/roomSpace.php">查詢空房</a></li>
                <li><a href="../../search/search.php">查詢訂房</a></li>
                <li><a href="../../about/about.html">關於我們</a></li>
                <li><a href="../../information/information.php">聯絡資訊</a></li>

                <li style="margin-top: 200%"><a href="../maneger/maneger.php">管理者介面</a></li>
                <li style="margin-top: 0%"><a href="../php/logOut.php">登出</a></li>
                </ul>
        </nav>

        <section id="One" class="wrapper style3">
            <div class="inner" style="z-index: 1">
                <header class="align-center">
                    <h2>Maneger Page</h2>
                </header>
            </div>
        </section>

        <!--**************************-->
        <div class ="nav">
            <ul id="navigation" style="z-index: 2; background:#F1EEC2;">        
                <li><a href="../userIndex.php" style="color:#000; ">主頁</a></li>            

                <li class="sub">         
                    <a href="#" style="color:#000; ">客戶</a>          
                    <ul style="z-index: 2; ">          
                        <li><a href="../customer/all.php">客戶總覽</a></li>
                        <li><a href="../customer/add.php">新增</a></li>                 
                        <li><a href="../customer/delete.php">刪除</a></li>
                        <li><a href="../customer/change.php">更新</a></li>                       
                    </ul>
                </li>              

                <li class="sub">         
                    <a href="#" style="color:#000; ">員工</a>          
                    <ul style="z-index: 2">          
                        <li><a href="../employee/all.php">員工總覽</a></li>
                        <li><a href="../employee/add.php">新增</a></li>
                        <li><a href="../employee/delete.php">刪除</a></li>
                        <li><a href="../employee/change.php">更新</a></li>                   
                    </ul>
                </li>     

                <li class="sub">         
                    <a href="#" style="color:#000; ">訂單</a>          
                    <ul style="z-index: 2">          
                        <li><a href="../order/all.php">訂單總覽</a></li>
                        <li><a href="../order/delete.php">刪除</a></li>
                        <li><a href="../order/change.php">更新</a></li>                   
                    </ul>
                </li>   

                          

            </ul>
        </div>




        <div class="container">          


            <!--~~~~~~~~~~~~~~~~~--> 
            <div class="content">
                <h2>更新客戶</h2>
                <hr/>
                
                <p>客戶編號:<?php echo $_SESSION["idNum"]; ?></p>
                <br>
                <br>
                
                <form method="post" action="">

                    <div class="6u 12u$(small)"> <p>姓名：</p>
                        <input type="text" name="name" id="name" value="<?php echo $_SESSION["name"]; ?>" placeholder="Name" required>
                    </div>

                    <br/>
                    <div class="6u 12u$(small)"> <p>身分證字號：</p>
                        <input type="text" name="id" id="id" value="<?php echo $_SESSION["cus_id"]; ?>" placeholder="ID" required>
                    </div>

                    <br/>
                    <div class="6u$ 12u$(small)"> 
                        <p>生日：</p>
                        <input type="date" name="bir" id="bir" value="<?php echo $_SESSION["bir"]; ?>" placeholder="yyyy-mm-dd" required>
                    </div>
                    <br/>
                    <p>性別：</p>

                    <div class="4u 12u$(small)">
                        <input type="radio" id="priority-low" name="gender"  value="男" checked>
                        <label for="priority-low">男</label>
                    </div>
                    <div class="4u$ 12u$(small)">
                        <input type="radio" id="priority-normal" name="gender" value="女" >
                        <label for="priority-normal">女</label>
                    </div>

                    <br/>
                    <div class="6u 12u$(xsmall)" ><p>手機：</p>
                        <input type="text" name="phone" id="phone" value="<?php echo $_SESSION["phone"]; ?>" placeholder="Phone" required>
                    </div>
                    <br/>
                    <div class="6u$ 12u$(xsmall)" ><p>E-mail：</p>
                        <input type="email" name="email" id="email" value="<?php echo $_SESSION["email"]; ?>" placeholder="email" required>
                    </div>	


                    <div class ="Err" style="color:red;">
                        <?php
                        echo "<p>" . $nameErr . "</p>";
                        echo "<p>" . $idErr . "</p>";
                        echo "<p>" . $birErr . "</p>";
                        echo "<p>" . $phoneErr . "</p>";
                        echo "<p>" . $emailErr . "</p>";
                        echo "<p>" . $DateErr . "</p>";
                        ?>
                    </div>

                    <div class="12u$">
                        <ul class="actions">
                            <div align="right"  style="margin-right: 5%">

                                <li><input type="submit" name="Reg" value="ADD"></li>

                            </div>
                        </ul>
                    </div>

                </form>


            </div>       

            <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrollex.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>

        </div>


        <!--~~~~~~~~~~~~~~~~~--> 
        <div class="footer">
            &copy; NTUB GROUP 10     
        </div>  
        <!--**************************-->    
    </body>

</html>
