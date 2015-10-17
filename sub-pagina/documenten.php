<?php include '../includes/html.php'; if ($user->isLoggedIn()) { ?>
    <div class="container">
        <h1>Documenten</h1><hr>
        <form method="post" action="">
            <label>Naam van Document:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="60" REQUIRED><br>
            <input type="file" id="file" name="files" REQUIRED><br>
            <input type="submit" class="btn btn-success">
        </form>
    </div>
<?php } ?>