<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
$more=25;
if(isset($_POST['more'])){$more=$_POST['more'];}
$messages = $db->query("SELECT * FROM( SELECT * FROM messages ORDER BY id DESC LIMIT $more) messages ORDER BY id ASC");
if ($messages->count()) {
    ?><script>var totalMessages = 0;</script><?php
    foreach ($messages->results() as $message) {
        ?><script>
            totalMessages = totalMessages + 1;
            localStorage.setItem("totalMessages", totalMessages);
        </script><?php
        $messageSQL = $db->query("SELECT name, IconPath, id FROM users WHERE id = '{$message->user_id}'");
        foreach ($messageSQL->results() as $user_id) {
            $userMessage = new User($message->user_id);
            if ($userMessage->hasPermission("dev")) {
                echo '<li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="' . escape($user_id->IconPath) . '" alt="' . escape($user_id->name) . '" class="img-circle avatar" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">' . escape($user_id->name) . ' || ' . escape($userMessage->getGroup()) . '</strong> <small class="pull-right text-muted">';
                if ($user->isLoggedIn() && $user->data()->id == $user_id->id) {
                    echo '<i title="Verwijderen" class="fa fa-trash-o" onclick="removeMes(' . escape($message->id) . ')"></i>';
                }
                            echo '<span class="glyphicon glyphicon-time"></span>' . escape($message->date) . '</small>
                        </div>
                        <p>
                        ' . $message->message . '
                        </p>
                    </div>
                </li>';
            } elseif ($user->isLoggedIn()) {
                echo '<li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="' . escape($user_id->IconPath) . '" alt="' . escape($user_id->name) . '" class="img-circle avatar" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">' . escape($user_id->name) . '</strong> <small class="pull-right text-muted">';
                if ($user->isLoggedIn() && $user->hasPermission("admin")) {
                    if ($message->approved == 0){
                        echo '<i title="Goedkeuren" class="fa fa-check" style="font-size: 15px; color: green; cursor: pointer;" onclick="approveMes(' . escape($message->id) . ')"></i> ';
                    }
                    if ($message->approved == 1){
                        echo '<i title="Afkeuren" class="fa fa-close" style="font-size: 15px; color: red; cursor: pointer;" onclick="disapproveMes(' . escape($message->id) . ')"></i> ';
                    }
                }
                if ($user->isLoggedIn() && ($user->data()->id == $user_id->id || $user->hasPermission("admin"))) {
                    echo '<i title="Verwijderen" class="fa fa-trash-o" onclick="removeMes(' . escape($message->id) . ') & del();"></i>';
                }
                echo '<span class="glyphicon glyphicon-time"></span>' . escape($message->date) . '</small>
                        </div>
                        <p>
                        ' . escape($message->message) . '
                        </p>
                    </div>
                </li>';
            } elseif ($message->approved == 1) {
                echo '<li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="' . escape($user_id->IconPath) . '" alt="' . escape($user_id->name) . '" class="img-circle avatar" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">' . escape($user_id->name) . '</strong> <small class="pull-right text-muted">';
                echo '<span class="glyphicon glyphicon-time"></span>' . escape($message->date) . '</small>
                        </div>
                        <p>
                        ' . escape($message->message) . '
                        </p>
                    </div>
                </li>';
            }
        }
    }
} else {
    echo '<li class="right clearfix">
            <div class="chat-body clearfix">
                <div class="header">
                    <h4>Er zijn nog geen berichten</h4>
                </div>
            </div>
          </li>';
}