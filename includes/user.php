
<div class='defCo'>
    <div class='userInterface'>
        <div class="mainInfo">
            <p class='userName'><b><?php echo $_SESSION['rname']; ?></b></p>
            <p class='userType'>Typ uctu: <?php echo $_SESSION['type']; ?></p>
        </div>
        <div class='howTo'><button id='howToBtn'>Ako na to?</button></div>
        <div class='mainArea'>
            <a href='../user/index.php?ci=inf' class='opSquare'>Moje <br> info</a>
            <a href='../user/index.php?ci=prh' class='opSquare' id='squarePrihlaska'>Podat <br> prihlasku</a>
        </div>
    </div>
</div>


<div id='overlay'>
    <div class='howToExplnation'>
        <div class='howToTitle'>
           	<h2>Postup</h2>
        </div>
        <div class='howToSteps'>
            <p>1. Somethin somethin</p>
            <p>2. Somethin somethin</p>
            <p>3. Somethin somethin</p>
            <p>4. Somethin somethin</p>
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
