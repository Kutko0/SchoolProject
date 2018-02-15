<form action="../" method="post">
    <button type='submit' name='logOffButton' id='logOffBtn'>Odhlasit</button>
</form>

<div class='defCo'>
    <div class='userInterface'>
        <div class="mainInfo">
            <p class='userName'><b><?php echo $_SESSION['rname']; ?></b></p>
            <p class='userType'>Typ uctu: ucitel</p>
        </div>
        <div class='mainArea ucitelMainArea'>
            <a href='../user/index.php?ti=pp' class='opSquare'>Podane <br> prihlasky</a>
            <a href='../user/index.php?ti=oz' class='opSquare'>Odmietnuty <br> ziaci</a>
            <a href='../user/index.php?ti=mz' class='opSquare'>Moji <br> ziaci</a>
        </div>
    </div>
</div>
