<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        if($db->query("SELECT * FROM messages WHERE id = '$id'")->count()){
            $db->query("DELETE FROM messages WHERE id = '$id'");
            ?>
            <script>
                $('.alert').remove();
                var tmpl = '<div class="alert alert-success alert-dismissable">'+
                    '<button class="close" data-dismiss="alert">&times;</button>'+
                    'Bericht is succesvol verwijderd.'+
                    '</div>';
                $('.row-fluid').append(tmpl);
                setTimeout(function(){
                    $('.alert').addClass('on');
                    setTimeout(function(){
                        $('.alert').removeClass('on');
                        setTimeout(function(){
                            $('.alert').remove();
                        },1000);
                    },5000);
                },10);

                $('#chatRefresh').load('/includes/chatRefresh.php');
            </script>
            <?php
        }
    }
}