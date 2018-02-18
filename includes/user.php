<?php
//    switch($_SESSION['status']){
//        case 1:
//            $status = 'ziak';
//            break;
//        default:
//            $status = 'Chris Angel';
//            break;
//    }

?>

<form action="../" method="post">
    <button type='submit' name='logOffButton' id='logOffBtn'>Odhlasit</button>
</form>

<div class='defCo'>
    <div class='userInterface'>
        <div class="mainInfo">
            <p class='userName'><b><?php echo $_SESSION['rname']; ?></b></p>
            <p class='userType'>Typ uctu: ziak <?php // echo $status; ?></p>
        </div>
        <div class='howTo'><button id='howToBtn'>Ako na to?</button></div>
        <div class='mainArea'>
            <a href='../user/index.php?ui=inf' class='opSquare'>Moje <br> info</a>
            <a href='../user/index.php?ui=prih' class='opSquare' id='squarePrihlaska'>Podat <br> prihlasku</a>
        </div>
    </div>
</div>


<div id='overlay'>
    <div class='overlayMainBox'>
        <div class='overlayTitle'>
           	<h2>Postup</h2>
        </div>
        <div class='overlaySteps'>
            <p>1. Nahraj si svoje info (<i>Moje Info</i>)</p>
            <p>2. Vyber si ucitela (<i>Podat prihlasku</i>)</p>
            <p>3. Pridaj informacie o svojom<br>
                &nbsp;&nbsp;&nbsp; projekte (<i>Podat prihlasku</i>)</p>
            <p>4. Odosli prihlasku</p>
        </div>
        <button id='closeOverlay'>Zavriet</button>
    </div>
</div>

<script type="text/javascript">
    $('#howToBtn').click(function(){
        $('#overlay').show();
    });
    $('#closeOverlay, #overlay').click(function(){
        $('#overlay').hide();
    });
</script>
