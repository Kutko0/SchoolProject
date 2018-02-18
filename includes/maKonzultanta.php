<div class="defCo">
    <h2 style="font-family: Poppins;
                font-weight: 600;
                color: rgba(124, 255, 124,1);
                margin-top:25px;">
                Tvoja prihlaska bola potvrdena,<br>
                tvoj konzultant je <u style="color: rgba(75, 255, 75,1);"><?php echo $_SESSION['konzultant'];?></u>
            </h2>

        <div class="prihPraca" >
            <h3 style="border-bottom:solid 2px"><b>Moja praca</b></h3>
            <p><b>Tema</b> : <?php echo $info[0]; ?></p>
            <p><b>Typ </b>: <?php echo $info[1] ; ?></p>
            <p><b>Moja poznamka </b>: <?php echo $info[2]; ?></p>
        </div>

</div>
