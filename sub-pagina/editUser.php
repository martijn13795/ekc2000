<?php include '../includes/html.php'; ?>
<link href="../css/bootstrap-editable.css" rel="stylesheet">
<script src="../js/bootstrap-editable.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <div class="container">
        <h1>Bewerk gebruikers</h1>
        <hr>
        <?php
        $user = new User();
        if ($user->isLoggedIn() && $user->hasPermission('admin')) {
        ?>
                <table class="table table-striped table-bordered myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gebruikersnaam</th>
                        <th>Email</th>
                        <th>Naam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Geslacht</th>
                        <th>Team</th>
                        <th>Trainer</th>
                        <th>Geboortedatum</th>
                        <th><i title="Verwijderen" style="cursor: auto; padding-left: 7px;" class="fa fa-trash-o"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users = $db->query("SELECT * FROM users");
                    if ($users->count()) {
                        foreach ($users->results() as $user) {
                            echo '
                            <tr>
                                <td>' . escape($user->id) . '</td>
                                <td><span class="username" id="' . escape($user->id) . '">' . escape($user->username) . '</span></td>
                                <td><span class="mail" id="' . escape($user->id) . '">' . escape($user->mail) . '</span></td>
                                <td><span class="name" id="' . escape($user->id) . '">' . escape($user->name) . '</span></td>
                                <td><span class="surname_prefix" id="' . escape($user->id) . '">' . escape($user->surname_prefix) . '</span></td>
                                <td><span class="surname" id="' . escape($user->id) . '">' . escape($user->surname) . '</span></td>
                                <td><span class="gender" id="' . escape($user->id) . '" data-type="select">'; if(escape($user->gender == 'M')){echo 'Man';} if(escape($user->gender == 'F')){echo 'Vrouw';} echo '</span></td>
                                <td><span class="team" id="' . escape($user->id) . '" data-type="select">';
                                    $getTeams = $db->query("SELECT teams.name FROM users INNER JOIN players ON users.id = players.user_id INNER JOIN teams ON players.team_id = teams.id WHERE users.id = '$user->id'");
                                    if ($getTeams->count()) {
                                        foreach ($getTeams->results() as $getTeam) {
                                            echo escape($getTeam->name);
                                        }
                                    } else {
                                        echo 'Geen';
                                    } echo '
                                </span></td>
                                <td><span class="trainer" id="' . escape($user->id) . '" data-type="select">';
                                    $getTrainers = $db->query("SELECT teams.name FROM users INNER JOIN trainers ON users.id = trainers.user_id INNER JOIN teams ON trainers.team_id = teams.id WHERE users.id = '$user->id'");
                                    if ($getTrainers->count()) {
                                        foreach ($getTrainers->results() as $getTrainer) {
                                            echo escape($getTrainer->name);
                                        }
                                    } else {
                                        echo 'Geen';
                                    } echo '
                                </span></td>
                                <td><span class="birthdate" id="' . escape($user->id) . '">' . escape($user->birthdate) . '</span></td>
                                <td><span class="delete" id="' . escape($user->id) . '" onclick="removeUser(' . escape($user->id) . ')"><i title="Verwijderen" style="padding-left: 7px;" class="fa fa-trash-o"></i></span></td>
                            </tr>
                             ';
                        }
                    }
                    ?>
                    </tbody>
                </table>
        <?php
        }
        ?>
    </div>
    <script>
        $(document).ready(function() {
            $('.myTable').dataTable({
                "fnDrawCallback": function( oSettings ) {
                    editTable();
                },
                "aoColumnDefs" : [ {
                    'bSortable' : false,
                    'aTargets' : [ 10 ]
                } ]
            });
        });

        function removeUser(id){
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u deze gebruiker wilt verwijderen?<br><br>' +
                    '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function removeTrue(id){
            $.get('../includes/editUser.php?id=' + id + '&data=delete&colum=delete'), function(data){
                $('#result').html(data);
            };
            location.reload();
        }

        function editTable() {
            jQuery(document).ready(function () {
                $.fn.editable.defaults.mode = 'inline';
                $(".team").editable({
                    source: [
                        <?php
                        $teams = $db->query("SELECT id, name FROM teams");
                        if ($teams->count()) {
                            $teamsArray = array();
                            foreach ($teams->results() as $team) {
                                $teamsArray[escape($team->id)] = escape($team->name);
                            }
                            asort($teamsArray);
                            foreach ($teamsArray as $id => $name) {
                                echo '{value: ' . escape($id) . ', text: \'' . escape($name) . '\'},';
                            }
                            echo '{value: \'10000\', text: \'Geen\'}';
                        }
                        ?>
                    ]
                });

                $(".trainer").editable({
                    source: [
                        <?php
                        $teams = $db->query("SELECT id, name FROM teams");
                        if ($teams->count()) {
                            $teamsArray = array();
                            foreach ($teams->results() as $team) {
                                $teamsArray[escape($team->id)] = escape($team->name);
                            }
                            asort($teamsArray);
                            foreach ($teamsArray as $id => $name) {
                                echo '{value: ' . escape($id) . ', text: \'' . escape($name) . '\'},';
                            }
                            echo '{value: \'10000\', text: \'Geen\'}';
                        }
                        ?>
                    ]
                });

                $('.username').editable();
                $('.mail').editable();
                $('.name').editable();
                $('.surname_prefix').editable();
                $('.surname').editable();
                $('.gender').editable({
                    source: [
                        {value: 'M', text: 'Man'},
                        {value: 'F', text: 'Vrouw'}
                    ]
                });
                $('.birthdate').editable();

            });
        }

        $(document).on('click', '.editable-submit', function () {
            var x = $(this).closest('td').children('span').attr('id');
            var y = $('.input-sm').last().val();
            var z = $(this).closest('td').children('span');
            var colum = $(this).closest('td').children('span').attr('class').split(' ')[0];
            $.ajax({
                url: "../includes/editUser.php?id=" + x + "&data=" + y + "&colum=" + colum,
                type: 'GET',
                success: function (s) {
                    if (s == 'status') {
                        $(z).html(y);
                    }
                    if (s == 'error') {
                        alert('Error Processing your Request!');
                    }
                },
                error: function (e) {
                    alert('Error Processing your Request!!');
                }
            });
        });
    </script>
<?php include '../includes/htmlUnder.php'; ?>