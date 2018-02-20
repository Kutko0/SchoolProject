<div class="defCo">
    <div class="prihCo">
       <form action="../includes/formVal.php" method="post">
        <?php
                if($mojiZiaci->num_rows == 0){
                    echo '<h2 style="font-family: Poppins;
                                font-weight: 600;
                                color: rgba(255, 124, 124,1);
                                margin-top:25px;">
                                Ziadni ziaci!
                                </h2>';
                }
                while ($row = mysqli_fetch_assoc($mojiZiaci)) {
                    echo "<div class='prihLine' style='background-color:rgba(165, 249, 112 , 0.15);
                                                border-color:rgb(50, 255, 50);'>
                            <p><b>Meno : </b>" . getRealName($row["student_hash"]) . "</p>
                            <p><b>Trieda : </b>" . getClass($row["student_hash"]) . "</p>
                            <p><b>Typ : </b>" . $row["typ"] . "</p>
                            <p><b>Téma : </b>" . $row["tema"] . "</p>
                            <p><b>Poznámka : </b>" . $row["poznamka"] . "</p>
                            <button type='submit' name='hashNA'
                                value='" . $row["student_hash"] . "'
                                class='noPrihBtn'>Zamietnuť</button>
                        </div>";
                }
            ?>
        </form>
    </div>


</div>
