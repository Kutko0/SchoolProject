<?php
    $successMsg = "<p style='color:green;font-weight:800;width:350px;margin:auto;margin-top:25px;
            margin-bottom:-50px;font-size:20px;text-align:center;'>
            Uspesne pridany<br> komentar!</p>";
    $failMsg = "<p style='color:red;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                Nastala chyba pri<br>odosielani! </p>";
    $failMsg2 = "<p style='color:red;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                Textove pole musi<br>byt vyplnene!</p>";
    
    if((isset($_GET['f']))){
        echo $failMsg;
    }else if(isset($_GET['ff'])){
        echo $failMsg2;
    }else if(isset($_GET['s'])){
        echo $successMsg;
    }
?>

<div class="defCo">
    <div class="prihCo">  
        <?php
                if($mojiZiaci->num_rows == 0){
                    echo '<h2 style="font-family: Poppins;
                                font-weight: 600;
                                color: rgba(255, 124, 124,1);
                                margin-top:25px;">
                                Žiadni žiaci!
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
                            <button value='" . $row["student_hash"] . "'
                                class='commentBtn'>Dennik</button>
                        </div>";
                }
            ?>
    </div>

<div id="overlay">
    <div class='overlayMainBox'>
        <div class="closeOverlayBtn2" id="closeOverLay2">X</div>
        <div class='overlayTitle'>
            <h2>Dennik</h2>
        </div>
        <div class='dennikCo'>
            
            
        </div>
            <form action="../includes/formVal.php" method="post" id="formComment">
                <fieldset style="margin-bottom:5px;margin-top:10px;width:100%;min-height:55px;z-index:15;" >
                    <div class="formLine">
                        <textarea require name='comment' rows="3" style="margin:auto;width:70%;float:none;"></textarea>
                    </div><br>
                    <button name="commentBtnForTeacher" type="submit" 
                            style="position:static;margin-top:10px;margin-bottom:5px;
                            background-color:rgba(65,255,65,0.15);
                            border-color:rgb(65,255,65);
                            color:rgb(70,70,70);" id="pridajMiHash">Pridat</button>
                </fieldset>
            </form>
        <button style="position:static;" id='closeOverlay'>Zavriet</button>

    </div>
</div>  

<script type="text/javascript">
    var heightOfDefCo = $('.defCo').height();
    $(document).ready(function(){
        $('.commentBtn').click(function(){
            $('#overlay').show();

            var hash_id = $(this).prop("value");
            $("#pridajMiHash").prop("value", hash_id);
            $('.dennikCo').load("../includes/loadDataAboutStudent.php", {
                newhash_id: hash_id
            });

        });
    });
    
    $('#closeOverlay, #closeOverLay2').click(function(){
        $('.defCo').css('height', heightOfDefCo + "px");
        $("#pridajMiHash").prop("value", " ");
        $('#overlay').css('height', "100vh");
        $('#overlay').hide();
    });

</script>
</div>
