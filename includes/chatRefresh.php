<?php
    include_once('db.php');

        $select = mysql_query('SELECT * FROM chatbox') or die(mysql_error());

        while ($selecting = mysql_fetch_array($select)) {
//                                        echo '<li class="right clearfix">
//                                                <span class="chat-img pull-right">
//                                                    <img src="/images/user.jpg" alt="User Avatar" class="img-circle avatar" />
//                                                </span>
//                                                <div class="chat-body clearfix">
//                                                    <div class="header">
//                                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>' . $selecting['dateTime'] . '</small>
//                                                        <strong class="pull-right primary-font">' . $selecting['userID'] . '</strong>
//                                                </div>
//                                                    <p>
//                                                        ' . $selecting['message'] . '
//                                                    </p>
//                                                </div>
//                                              </li>';
            echo '<li class="left clearfix">
                                                <span class="chat-img pull-left">
                                                    <img src="/images/user.jpg" alt="User Avatar" class="img-circle avatar" />
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font">Gast</strong> <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time"></span>' . $selecting['dateTime'] . '</small>
                                                    </div>
                                                    <p>
                                                        ' . $selecting['message'] . '
                                                    </p>
                                                </div>
                                            </li>';
        }
mysql_close();