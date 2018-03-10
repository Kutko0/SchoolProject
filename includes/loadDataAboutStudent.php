<?php
    include('dbFunc.php');
    include('classicFunc.php');

    $spravy = getComments($_POST['newhash_id']);
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
<script>
    
    var changeHeight = heightOfDefCo + $('.dennikCo').height() + $('#formComment').height() - 200;
    if(changeHeight > heightOfDefCo){
        $('.defCo').css('height', changeHeight + "px");
    }
    $('#overlay').css('height', $(document).height() + "px");
</script>