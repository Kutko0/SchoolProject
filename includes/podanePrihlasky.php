<?php
    if(isset($_GET['f'])){
        echo "<p style='color:red;font-weight:800;width:300px;margin:auto;margin-top:25px;
                    margin-bottom:-40px;font-size:20px;text-align:center;'>
                    Nastala chyba, skuste<br>to znova neskvor! </p>";
    }else if(isset($_GET['s'])){
        echo "<p style='color:green;font-weight:800;width:300px;margin:auto;margin-top:25px;
                    margin-bottom:-40px;font-size:20px;text-align:center;'>
                    Uspesna akcia! </p>";
    }

?>

<div class="defCo">
    <div class="prihCo">
       <form action="../includes/formVal.php" method="post">
        <?php
                while ($row = mysqli_fetch_assoc($prihlasky)) {
                    echo "<div class='prihLine'>
                            <p><b>Meno : </b>" . getRealName($row["student_hash"]) . "</p>
                            <p><b>Trieda : </b>" . getClass($row["student_hash"]) . "</p>
                            <p><b>Typ : </b>" . $row["typ"] . "</p>
                            <p><b>Tema : </b>" . $row["tema"] . "</p>
                            <p><b>Poznamka : </b>" . $row["poznamka"] . "</p>
                            <button type='submit'  name='hashY'
                                value='" . $row["student_hash"] . "'
                                class='yesPrihBtn'>Potvrdit</button>
                            <button type='submit' name='hashN'
                                value='" . $row["student_hash"] . "'
                                class='noPrihBtn'>Zamietnut</button>
                        </div>";
                }
            ?>
        </form>
    </div>


</div>
