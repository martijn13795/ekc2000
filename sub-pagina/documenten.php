<?php include '../includes/html.php'; if ($user->isLoggedIn()) { ?>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Documenten</h1><hr>
        <div class="col-md-12 col-xs-12">
            <?php
            $user = new User();
            if ($user->isLoggedIn() && $user->hasPermission('admin')) {
                ?>
                <div class="hidden visible-lg">
                    <form method="post" action="../includes/documentUpload.php" name="myForm" class="myForm"
                          enctype="multipart/form-data">
                        <label>Naam van Document:</label><input type="text" id="name" class="form-control" name="name"
                                                                placeholder="Naam" maxlength="60" REQUIRED><br>
                        <input type="file" id="fileToUpload" name="fileToUpload" REQUIRED><br>
                        <input type="submit" id="submit" class="btn btn-success">
                    </form>
                    <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                    <br><br>

                    <div id="error"></div>
                </div>
                <?php
            }
            }
            $db = DB::getInstance();
            $documents = $db->query("SELECT * FROM documents ORDER BY date DESC");
            if ($documents->count()) {
                foreach ($documents->results() as $document) {
                    $image = $document->path;
                    $type = substr($document->path, -3);
                    if($type == "doc" OR $type == "ocx"){$image = "../images/doc.png";}
                    if($type == "xls" OR $type == "lsx"){$image = "../images/xls.png";}
                    if($type == "ppt" OR $type == "ptx"){$image = "../images/ppt.png";}
                    if($type == "pdf"){$image = "../images/pdf.png";}
                        echo '<div class="well albumsDiv"><a href="/' . $document->path . '"><img class="roundImg" src="' . $image . '"/><h3>'
                            . escape(str_replace('-', ' ', $document->name)) . '</h3></a><p>Geupload op: ' . escape(explode(" ", $document->date)[0]) . '</p><br></div>';
                }
            } else {
                echo '<div class="well albumsDiv"><br/><h3>Er zijn nog geen documenten beschikbaar</h3></div>';
            }
            ?>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('.myForm').ajaxForm({
            beforeSend: function () {
                $("#submit").hide();
                $("#error").show();
                $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
            },
            success: function (response) {
                $("#refresh").show();
                $("#error").show();
                $("#error").html(response);
                $("#name").val('');
                $("#fileToUpload").val('');
            }
        });
        $("#refresh").hide();
        $("#error").hide();
    });
</script>
<?php include '../includes/htmlUnder.php'; ?>