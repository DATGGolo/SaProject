<!doctype html>
<?php
session_start();
include '../../php/FindOrder.php';
@include '../../DataBase.php';
@logInSure();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>新增客戶</title>
        <!-- 連結思源中文及css -->
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC" rel="stylesheet">
        <link href="../../images/user.jpg" rel="icon">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/menu.css" rel="stylesheet">
        <link href="assets/css/main.css" rel="stylesheet">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!------------------------->
    </head>

    <body>

        <!-- Header -->
        <header id="header" class="alt">
            <div class="logo"><a href="../index/index.html">渡假村 <span>RESORT</span></a></div>
            <a href="#menu">Menu</a>
        </header>

        <!-- Nav -->
        <nav id="menu">
            <ul class="links">
                <li><a href="../../news/news.html">最新消息</a></li>
                <li><a href="../../room/room.php">訂房服務</a></li>
                <li><a href="../../search/search.php">查詢訂房</a></li>
                <li><a href="../../about/about.html">關於我們</a></li>
                <li><a href="../../information/information.php">聯絡資訊</a></li>

                <li style="margin-top: 200%"><a href="../maneger/maneger.php">管理者介面</a></li>
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
                        <li><a href="../customer/add.php">新增</a></li>                 
                        <li><a href="../customer/delete.php">刪除</a></li>
                        <li><a href="../customer/change.php">更新</a></li>   
                        <li><a href="../customer/search.php">查詢</a></li>                     
                    </ul>
                </li>              

                <li class="sub">         
                    <a href="#" style="color:#000; ">員工</a>          
                    <ul style="z-index: 2">          
                        <li><a href="../employee/add.php">新增</a></li>
                        <li><a href="../employee/delete.php">刪除</a></li>
                        <li><a href="../employee/change.php">更新</a></li>   
                        <li><a href="../employee/search.php">查詢</a></li>                   
                    </ul>
                </li>     

                <li class="sub">         
                    <a href="#" style="color:#000; ">訂單</a>          
                    <ul style="z-index: 2">          
                        <li><a href="../order/add.php">新增</a></li>
                        <li><a href="../order/delete.php">刪除</a></li>
                        <li><a href="../order/change.php">更新</a></li>   
                        <li><a href="../order/search.php">查詢</a></li>                  
                    </ul>
                </li>   

                <li class="sub">         
                    <a href="#" style="color:#000; ">報表</a>          
                    <ul style="z-index: 2">          
                        <li><a href="/reports/import">進貨報表</a></li>
                        <li><a href="/reports/export">銷貨報表</a></li>
                        <li><a href="/reports/inventory">庫存報表</a></li>          
                    </ul>
                </li>          

            </ul>
        </div>




        <div class="container">          


            <!--~~~~~~~~~~~~~~~~~--> 
            <div class="content">
                <h2>客戶總覽</h2>
                <hr/>
                <?php
                $db = DB();
                $sql = "SELECT * from 顧客資料";
                $result = $db->query($sql);
//        echo '<table  border="1">';
//        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
////PDO::FETCH_OBJ 指定取出資料的型態
//            echo '<tr>';
//            echo '<td>' . $row->顧客編號 . "</td><td>" . $row->顧客名稱 . "</td>";
//            echo '</tr>';
//        }
//        echo '</table>';
                ?>



                <table id="myDataTalbe"  class="display"  >
                    <thead>
                        <!--必填-->

                        <tr>
                            <th>顧客編號</th>
                            <th>顧客名稱</th>
                            <th>生日</th>
                            <th>身分證字號</th>
                            <th>連絡電話</th>
                            <th>電子郵件</th>
                            <th>性別</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Apple</td>
                            <td>2000</td>
                            <td>
                                <button type="button" onclick='location.href = "change.php?"'>Edit</button>
                                <button type="button">Delete</button>
                            </td>
                        </tr>
                        <?php
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            //PDO::FETCH_OBJ 指定取出資料的型態
                            echo '<tr>';
                            echo '<td>' . $row->顧客編號 . "</td>"
                            . "<td>" . $row->顧客名稱 . "</td>"
                            . "<td>" . $row->生日 . "</td>"
                            . "<td>" . $row->身分證字號 . "</td>"
                            . "<td>" . $row->連絡電話 . "</td>"
                            . "<td>" . $row->電子郵件 . "</td>"
                            . "<td>" . $row->性別 . "</td>"
                            . "<td> <button type=\"button\" onclick='location.href=\"change.php?". $row->顧客編號."\"'>更新</button></td>"
                            . "<td> <button type=\"button\" onclick='location.href=\"delete.php?". $row->顧客編號."\"'>刪除</button></td>";

                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>


            </div>       

            <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrollex.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>
            <script language="javascript">

            </script>

        </div>


        <!--~~~~~~~~~~~~~~~~~--> 
        <div class="footer">
            &copy; NTUB GROUP 10     
        </div>  
        <!--**************************-->    
    </body>

</html>