<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
$messages = $db->query("SELECT * FROM messages ORDER BY id");
if ($messages->count()) {
    foreach ($messages->results() as $message) {
        $messageSQL = $db->query("SELECT name, IconPath FROM users WHERE id = '{$message->user_id}'");
        foreach ($messageSQL->results() as $user_id) {
            $userMessage = new User($message->user_id);
            if ($userMessage->hasPermission("dev")) {
                echo '<li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="' . escape($user_id->IconPath) . '" alt="' . escape($user_id->name) . '" class="img-circle avatar" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">' . escape($user_id->name) . ' || ' . escape($userMessage->getGroup()) . '</strong> <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time"></span>' . escape($message->date) . '</small>
                        </div>
                        <p>
                        ' . $message->message . '
                        </p>
                    </div>
                </li>';
            } else {
                echo '<li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="' . escape($user_id->IconPath) . '" alt="' . escape($user_id->name) . '" class="img-circle avatar" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">' . escape($user_id->name) . '</strong> <small class="pull-right text-muted">';
                if ($user->isLoggedIn() && $user->hasPermission("admin")) {
                    echo '<i class="fa fa-trash-o" onclick="removeMes(' . escape($message->id) . ') & del();"></i>';
                }
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
    //Echo bericht voor nog geen berichten?
    echo '<li class="right clearfix">
                <div class="chat-body clearfix">
                <div class="header">
                </div>
                <h4>Er zijn nog geen berichten</h4>
                </div>
                </li>';
}