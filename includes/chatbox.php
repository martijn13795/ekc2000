<?php
    include_once('db.php');

    $message = $_POST['message'];

if ($_POST['message'] == null || $_POST['message'] == ""){
    echo "voer een bericht in";
}else {

    if(mysql_query("INSERT INTO chatbox (message) VALUES ('$message')")) {
        $select = mysql_query('SELECT * FROM chatbox ORDER BY messageID DESC') or die(mysql_error());

        while ($selecting = mysql_fetch_array($select)) {
            echo '<li class="right clearfix">
                                                <span class="chat-img pull-right">
                                                    <img src="/images/user.jpg" alt="User Avatar" class="img-circle avatar" />
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>' . $selecting['dateTime'] . '</small>
                                                        <strong class="pull-right primary-font">' . $selecting['userID'] . '</strong>
                                                </div>
                                                    <p>
                                                        ' . $selecting['message'] . '
                                                    </p>
                                                </div>
                                              </li>';break;
        }
    }else {
        echo "insertion failed";
    }
}
mysql_close();
?>