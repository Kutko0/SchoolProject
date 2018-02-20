
<form action="../" method="post">
    <button type='submit' name='logOffButton' id='logOffBtn'>Odhlásiť</button>
</form>

<div class='defCo'>
    <div class='userInterface'>
        <div class="mainInfo">
            <p class='userName'><b><?php echo $_SESSION['rname']; ?></b></p>
            <p class='userType'>Typ účtu: žiak </p>
        </div>
        <div class='howTo'><button id='howToBtn'>Ako na to?</button></div>
        <div class='mainArea'>
            <a href='../user/index.php?ui=inf' class='opSquare'>Moje <br> info</a>
            <a href='../user/index.php?ui=prih' class='opSquare' id='squarePrihlaska'>Podať <br> prihlášku</a>
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
            <p>2. Vyber si učiteľa (<i>Podat prihlasku</i>)</p>
            <p>3. Pridaj informácie o svojom<br>
                &nbsp;&nbsp;&nbsp; projekte (<i>Podat prihlášku</i>)</p>
            <p>4. Odošli prihlášku</p>
        </div>
        <button id='closeOverlay'>Zavrieť</button>
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
