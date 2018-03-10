<?php
    if(isset($_POST['ziakSubmitComment'])){
        if(addComment($_SESSION['hash_id'], $_POST['comment'])){
            echo "<p style='color:green;font-weight:800;width:300px;margin:auto;margin-top:10px;
            margin-bottom:-10px;font-size:20px;text-align:center;'>
            Uspesne pridany<br> komentar! </p>";
        }else{
            echo "<p style='color:red;font-weight:800;width:300px;margin:auto;margin-top:10px;
            margin-bottom:-10px;font-size:20px;text-align:center;'>
            Nastala chyba! </p>";
        }
    }

?>

<div class="defCo">
    <h2 style="font-family: Poppins;
                font-weight: 600;
                color: rgba(124, 255, 124,1);
                margin-top:25px;">
                Tvoja prihlaska bola potvrdena,<br>
                tvoj konzultant je <u style="color: rgb(75, 255, 75);"><?php echo $_SESSION['konzultant'];?></u>
            </h2>

        <div class="prihPraca" >
            <h3 style="border-bottom:solid 2px"><b>Moja praca</b></h3>
            <p><b>Tema</b> : <?php echo $info[0]; ?></p>
            <p><b>Typ </b>: <?php echo $info[1] ; ?></p>
            <p><b>Moja poznamka </b>: <?php echo $info[2]; ?></p>
        </div>
        <button class='commentBtn'>Denník</button>
                
</div>
<div id="overlay" >
    <div class='overlayMainBox'>
        <div class="closeOverlayBtn2" id="closeOverLay2">X</div>
        <div class='overlayTitle'>
            <h2>Dennik</h2>
        </div>
        <div class='dennikCo'>
            <?php
                $spravy = getComments($_SESSION['hash_id']);
                if( $spravy === FALSE ){
                    echo "<h2>Ziadne spravy</h2>";
                }else{
                    if(isset($spravy)){
                        while ($row = mysqli_fetch_assoc($spravy)) {
                            if($row['status'] == '5'){
                                echo "<div class='commentLine'>
                                        <p>" . $row['time'] . "<br><b>Sprava od ucitela :</b>" . $row['sprava'] . "</p>
                                        </div>";
                            }else{
                                echo "<div class='commentLine ziakCommentLine'>
                                        <p>" . $row['time'] . "<br><b>Sprava od ziaka :</b>" . $row['sprava'] . "</p>
                                        </div>";
                            }
                        }
                    }
                }
            ?>
            
        </div>
            <form action="../user/index.php?ui=prih" method="post" id="formComment">
                <fieldset style="margin-bottom:5px;margin-top:10px;width:100%;min-height:55px;z-index:15;" >
                    <div class="formLine">
                        <textarea name='comment' rows="3" style="margin:auto;width:70%;float:none;"></textarea>
                    </div><br>
                    <button name="ziakSubmitComment" type="submit" 
                            style="margin-top:10px;margin-bottom:5px;
                            background-color:rgba(65,255,65,0.15);
                            border-color:rgb(65,255,65);
                            color:rgb(70,70,70);">Pridat</button>
                </fieldset>
            </form>
        <button id='closeOverlay'>Zavriet</button>

    </div>
</div>    
<script type="text/javascript">
    var heightOfDefCo = $('.defCo').height();
    $('.commentBtn, #sexyTest').click(function(){
        $('#overlay').show();
        var changeHeight = heightOfDefCo + $('.dennikCo').height() + $('#formComment').height() - 150;
        $('.defCo').css('height', changeHeight + "px");
        $('#overlay').css('height', $(document).height() + "px");
    });
    $('#closeOverlay, #closeOverLay2').click(function(){
        $('.defCo').css('height', heightOfDefCo + "px");
        $('#overlay').css('height', "100vh");
        $('#overlay').hide();
    });
</script>