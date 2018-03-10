<?php include '../includes/html.php';
if ($user->isLoggedIn()) { ?>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
    <div class="container">
        <h1>Documenten</h1>
        <hr>
        <div class="col-md-12 col-xs-12">
            <?php
            if ($user->hasPermission('dev') || $user->hasPermission('documentupload')) {
            ?>
            <div class="hidden visible-lg">
                <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button>
                <br><br>
                <div id="uploadContainer" hidden>
                    <form method="post" action="../includes/documentUpload.php" name="myForm" class="myForm"
                          enctype="multipart/form-data">
                        <label>Naam van Document:</label><input type="text" id="name" class="form-control"
                                                                name="name"
                                                                placeholder="Naam" maxlength="60" REQUIRED><br>
                        <input type="file" id="fileToUpload" name="fileToUpload" REQUIRED><br>
                        <input type="submit" id="submit" class="btn btn-success">
                    </form>
                    <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                    <br><br>
                    <div id="error"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php
                    }

                    $db = DB::getInstance();
                    $documents = $db->query("SELECT * FROM documents ORDER BY date DESC");
                    if ($documents->count()) {
                        foreach ($documents->results() as $document) {
                            $userName = $db->query("SELECT name, surname FROM users WHERE id = $document->user_id")->first();
                            $image = $document->path;
                            $type = substr($document->path, -3);
                            if ($type == "doc" OR $type == "ocx") {
                                $image = "../images/doc.png";
                            }
                            if ($type == "xls" OR $type == "lsx") {
                                $image = "../images/xls.png";
                            }
                            if ($type == "ppt" OR $type == "ptx") {
                                $image = "../images/ppt.png";
                            }
                            if ($type == "pdf") {
                                $image = "../images/pdf.png";
                            }
                            echo '<div class="well albumsDiv">';
                            if ($user->data()->id == $document->user_id || $user->hasPermission("dev") || $user->hasPermission("documentremove")) {
                                echo '<i class="fa fa-trash-o" style="float: right;" onclick="removeDocument(' . escape($document->id) . ')"></i>';
                            }
                            echo '<a href="/' . $document->path . '"><img class="roundImg" src="' . $image . '"/><h3>'
                                . escape(str_replace('-', ' ', $document->name)) . '</h3></a><p>Geupload op: ' . escape(explode(" ", $document->date)[0]) . '</p>'; if ($user->isLoggedIn() && $user->hasPermission("dev")) {echo '<p>'.$userName->name . ' ' . $userName->surname .'</p>';} echo'<br></div>';
                        }
                    } else {
                        echo '<div class="well albumsDiv"><br/><h3>Er zijn nog geen documenten beschikbaar</h3></div>';
                    }
                } else {
                        include_once '403.php';
                }
                    ?>
                </div>
            </div>
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

        function showUpload() {
            $("#upload").attr("onclick", "hideUpload()");
            $("#upload").text("Verberg");

            $("#uploadContainer").show();
        }
        function hideUpload() {
            $("#upload").attr("onclick", "showUpload()");
            $("#upload").text("Upload");

            $("#uploadContainer").hide();
        }

        function removeDocument(id){
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u dit verslag wilt verwijderen?<br><br>' +
                    '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function removeTrue(id){
            $.get("includes/removeDocument.php?id=" + id), function(data){
                $('#result').html(data);
            };
            location.reload();
        }
    </script>
<?php include '../includes/htmlUnder.php'; ?>