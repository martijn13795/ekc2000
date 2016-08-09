<?php include '../includes/html.php'; ?>
    <link href="../css/bootstrap-editable.css" rel="stylesheet">
    <script src="../js/bootstrap-editable.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <div class="container">
        <h1>Bewerk commissies</h1>
        <hr>
        <?php
        $user = new User();
        if ($user->isLoggedIn() && $user->hasPermission('admin')) {
            ?>
            <table class="table table-striped table-bordered myTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Telefoonnummer</th>
                    <th><i title="Verwijderen" style="cursor: auto; padding-left: 7px;" class="fa fa-trash-o"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $commissions = $db->query("SELECT * FROM commissions");
                if ($commissions->count()) {
                    foreach ($commissions->results() as $commission) {
                        echo '
                            <tr>
                                <td>' . escape($commission->id) . '</td>
                                <td><span class="name" id="' . escape($commission->id) . '">' . escape($commission->name) . '</span></td>
                                <td><span class="mail" id="' . escape($commission->id) . '">' . escape($commission->mail) . '</span></td>
                                <td><span class="phone" id="' . escape($commission->id) . '">' . escape($commission->phone) . '</span></td>
                                <td><span class="delete" id="' . escape($commission->id) . '" onclick="removeCommission(' . escape($commission->id) . ')"><i title="Verwijderen" style="padding-left: 7px; margin: 0 auto;" class="fa fa-trash-o"></i></span></td>
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
                    'aTargets' : [ 4 ]
                } ]
            });
        });

        function removeCommission(id){
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u deze commissie wilt verwijderen?<br><br>' +
                    '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function removeTrue(id){
            $.get('../includes/editCommission.php?id=' + id + '&data=delete&colum=delete'), function(data){
                $('#result').html(data);
            };
            location.reload();
        }

        function editTable() {
            jQuery(document).ready(function () {
                $.fn.editable.defaults.mode = 'inline';

                $('.name').editable();
                $('.mail').editable();
                $('.phone').editable();
            });
        }

        $(document).on('click', '.editable-submit', function () {
            var x = $(this).closest('td').children('span').attr('id');
            var y = $('.input-sm').last().val();
            var z = $(this).closest('td').children('span');
            var colum = $(this).closest('td').children('span').attr('class').split(' ')[0];
            $.ajax({
                url: "../includes/editCommission.php?id=" + x + "&data=" + y + "&colum=" + colum,
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