<?php
     include 'header.php';
?>

        <h1>Wecome to Users Store</h1>

        <?php
            if(!isset($_SESSION["user_username"])){
                echo '<h3>Please Sign up or login to find out who are using this website</h3>';
            }

        ?>
        

        <div class="tabular container my-4">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                    <th style="text-align: center;" scope="col">S.No</th>
                    <th style="text-align: center;" scope="col">Username</th>
                    <?php
                    if(isset($_SESSION['user_username'])&&$_SESSION["user_id"]==1){
                         echo '<th style="text-align: center;" scope="col">Actions</th>';   
                    }
                    ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "includes/dbh.inc.php";
                        $query = "SELECT * FROM people;";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $no = 0;
                        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $no++;
                            echo '<tr>
                            <th scope="row">'. $no . '</th>
                            <td>'. $result['username'] .'</td>';
                            if(isset($_SESSION['user_username'])&&$_SESSION["user_id"]==1){
                                echo '<td><button class="edit btn btn-sm btn-primary" id='. $result['id'] . '>Edit</button> <button class="delete btn btn-sm btn-danger" id=d'. $result['id'] . '>Delete</button></td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>


<?php
    include 'footer.php';
?>








