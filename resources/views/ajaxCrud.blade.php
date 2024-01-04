<html>

<head>
    <title>How To Create AJAX CRUD Operation In Laravel 10 - Techsolutionstuff</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>

<body>

    <div class="container">
        <h1> AJAX CRUD </h1>
        <button class="btn btn-primary mb-4" id="createNewProduct" data-target="#mymodel"> Add New
            User</button>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <!-- <th>Password</th> -->
                    <th>Address</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody id="list_todo">
                @foreach($todos as $todo)
                <tr id="row_todo{{$todo->id}}">
                    <td>{{$todo->id}}</td>
                    <td>{{$todo->name}}</td>
                    <td>{{$todo->email}}</td>
                    <!-- <td>{{$todo->password}}</td> -->
                    <td>{{$todo->address}}</td>
                    <td>
                        <button type="button" id="edit_todo" data-id="{{$todo->id}}"
                            class="btn btn-sm btn-info ml-1">Edit</button>
                        <!-- <button type="button" id="delete" data-id="{{$todo->id}}"
                            class="btn btn-sm btn-danger ml-1">Delete</button> -->
                        <button type="button" class="btn btn-sm btn-danger ml-1 delete-btn"
                            data-id="{{$todo->id}}">Delete</button>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="crud_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="todoForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id" />
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name_todo" name="name"
                                    placeholder="Enter Name" value="" required>
                            </div>
                        </div>
                        <!-- for email -->
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email_todo" name="email"
                                    placeholder="Enter Email" value="" required />
                            </div>
                        </div>
                        <!-- for password 
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="Enter Password" value="" required />
                            </div>
                        </div>-->
                        <!-- for address -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="address" id="address" name="address"
                                    placeholder="Enter Address" class="form-control" />
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="savedata" value="create">Add
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $("#createNewProduct").on('click', function() {
        $('#todoForm').trigger('reset');
        $('#modelHeading').html('Add todo');
        $("#crud_modal").modal('show');
    });

    $("#edit_todo").on('click', function() {
        var id = $(this).data('id');
        console.log(id);
        $.get('todos/' + id + '/edit', function(res) {
            $("#modelHeading").html('Edit Todo');
            $("#id").val(res.id);
            $("#name_todo").val(res.name);
            $("#email_todo").val(res.email);
            $("#address").val(res.address);
            $("#crud_modal").modal('show');
        });
    });


    // $("form").on('submit', function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: "todos/store",
    //         data: $("#todoForm").serialize(),
    //         type: 'POST',
    //         cache: false
    //     }).done(function(res) {
    //         var row = '<tr id="row_todo_' + res.id + '">';
    //         row += '<td>' + res.id + '</td>';
    //         row += '<td>' + res.name + '</td>';
    //         row += '<td>' + res.email + '</td>';

    //         row += '<td>' + res.address + '</td>';
    //         row += '<td>' + '<button type="button" class="btn btn-info-sm">Edit</button>' +
    //             '<button type="button" class="btn btn-danger-sm">Delete</button>' + '</td>';

    //         if ($('#id').val()) {
    //             $("#row_todo_" + res.id).replaceWith(row);
    //         } else {
    //             $("#list_todo").prepend(row);
    //         }
    //         $("#todoForm").trigger('reset');
    //         $("#crud_modal").modal('hide');
    //     });
    // });
    $("form").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "todos/store",
            data: $("#todoForm").serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
                var row = '<tr id="row_todo_' + res.id + '">';
                row += '<td>' + res.id + '</td>';
                row += '<td>' + res.name + '</td>';
                row += '<td>' + res.email + '</td>';
                row += '<td>' + res.address + '</td>';
                row += '<td>' +
                    '<button type="button" class="btn btn-info-sm edit-btn" data-id="' + res.id +
                    '">Edit</button>' +
                    '<button type="button" class="btn btn-danger-sm delete-btn" data-id="' + res
                    .id + '">Delete</button>' +
                    '</td>';
                if ($('#id').val()) {
                    $("#row_todo_" + res.id).replaceWith(row);
                } else {
                    $("#list_todo").prepend(row);
                }
                $("#todoForm").trigger('reset');
                $("#crud_modal").modal('hide');
            },
            error: function(error) {
                console.error("Error storing record:", error);
            }
        });
    });



    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    type: 'DELETE',
                    url: "todos/destroy/" + id,
                    success: function(response) {

                        // console.log(response.message);
                        alert(response.message);


                        $("#row_todo_" + id).remove();
                    },
                    error: function(error) {
                        console.error("Error deleting record:", error);
                    }
                });
            }
        });
    });
    </script>

</body>