<script src="../ckeditor/ckeditor.js"></script>
<?php include '../includes/html.php';?>
    <div class="container"><br>
        <form action="" method="POST">
            <textarea class="ckeditor" name="editor1"></textarea><br>
            <input type="submit" value="Upload"/>
        </form>
        <?php
        if($_POST) {
            $text = $_POST['editor1'];

            echo $text;
        }

        ?>
    </div>