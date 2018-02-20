<form action="../" method="post">
    <button type='submit' name='logOffButton' id='logOffBtn'>Odhlásiť</button>
</form>

<div class='defCo'>
    <div class='userInterface'>
        <div class="mainInfo">
            <p class='userName'><b><?php echo $_SESSION['rname']; ?></b></p>
            <p class='userType'>Typ účtu: učiteľ</p>
        </div>
        <div class='mainArea ucitelMainArea'>
            <a href='../user/index.php?ti=pp' class='opSquare'>Podané <br> prihlášky</a>
            <a href='../user/index.php?ti=oz' class='opSquare' id="odZiaci">Odmietnutý <br> žiaci</a>
            <a href='../user/index.php?ti=mz' class='opSquare' id="mojZiaci">Moji <br> žiaci</a>
        </div>
    </div>
</div>
