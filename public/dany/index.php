<?php
    class DB
    {
        private $servername = "127.0.0.1";
        private $username = "tepuser";
        private $password = "-Txh9y#j_sJM";
        private $database = "teptar";
        public $conn;
        
        public function __construct(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        }

        function selIndex ($id_district) {
            if ($this->conn){echo "<div style='background: green; color: white; text-align: center; padding: 10px 0 10px 0'>Успешное соеднинение</div>";
            } else {die("Connection failed: ".mysqli_connect_error());}

            $sql = "SELECT `id`, `id_district`, `id_mark`, `id_report`, `index`, `date` FROM  `index` WHERE  `id_district` = '$id_district'";
            //echo  $sql;
            // Отправляем запрос;
            $res = $this->conn->query($sql);
            
            // var_dump($res);
            if ($res->num_rows > 0) {
                ?>
                <table border="4" cellspacing="0" cellpadding="10">
                <?php
                while ($row = $res->fetch_assoc()) {
                    // Вывод на экран;
                    echo "
                    <tr>
                      <th>ID:</th>
                      <th>Район:</th>
                      <th>Отчет:</th>
                      <th>Показатель:</th>
                      <th>Индекс:</th>
                      <th>Дата:</th>
                    </tr>
                    <tr>
                      <td>{$row["id"]}</td>
                      <td>{$row["id_district"]}</td>
                      <td>{$row["id_report"]}</td>
                      <td>{$row["id_mark"]}</td>
                      <td>{$row["index"]}</td>
                      <td>{$row["date"]}</td>
                    </tr>
                    ";
                }
                echo "</table>";
                // Если таблица пустая, будет выведено "Данных нет";
            } else {
                echo "Данных нет";
            }
        }
    }
    $DB = new DB();//Вывод класса
    $DB->selIndex(1);