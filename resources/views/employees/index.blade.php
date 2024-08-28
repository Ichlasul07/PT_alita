<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DATA KARYAWAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>DATA KARYAWAN</h1>
        <a href="javascript:void(0)" class="btn btn-info ml-3 " id="create-new-employee">Add New</a>
        <br><br>
        <table class="table table-bordered table-striped" id="laravel_11_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Location </th>
                    <th>Birth Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="ajax-employee-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="employeeCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="employeeForm" name="employeeForm" class="form-horizontal">
                        <input type="hidden" name="employee_id" id="employee_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location_code" class="col-sm-2 control-label">Location Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="location_code" name="location_code"
                                    placeholder="Enter Location Code" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Birth Date</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    placeholder="Enter Birth Date" value="" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script>
        var SITEURL = 'http://127.0.0.1:8000/';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#laravel_11_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: SITEURL + "employees",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'location_code',
                        name: 'location_code'
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });

            $('#create-new-employee').click(function() {
                $('#btn-save').val("create-employee");
                $('#employee_id').val('');
                $('#employeeForm').trigger("reset");
                $('#employeeCrudModal').html("Add New Employee");
                $('#ajax-employee-modal').modal('show');
            });

            $('body').on('click', '.edit', function() {
                var employee_id = $(this).data('id');
                $.get('employees/edit/' + employee_id, function(data) {
                    $('#employeeCrudModal').html("Edit Employee");
                    $('#btn-save').val("edit-employee");
                    $('#ajax-employee-modal').modal('show');
                    $('#employee_id').val(data.id);
                    $('#name').val(data.name);
                    $('#location_code').val(data.location_code);
                    $('#birth_date').val(data.birth_date);
                });
            });


            $('body').on('click', '.delete', function() {
                var employee_id = $(this).data("id");
                if (confirm("Are you sure you want to delete this employee?")) {
                    $.ajax({
                        type: "GET",
                        url: SITEURL + "employees/delete/" + employee_id,
                        success: function(data) {
                            var oTable = $('#laravel_11_datatable').DataTable();
                            oTable.ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

            $('body').on('submit', '#employeeForm', function(e) {
                e.preventDefault();
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');
                $.ajax({
                    type: 'POST',
                    url: SITEURL + "employees/Store",
                    data: $(this).serialize(),
                    success: function(data) {
                        $('#employeeForm').trigger("reset");
                        $('#ajax-employee-modal').modal('hide');
                        $('#btn-save').html('Save changes');
                        var oTable = $('#laravel_11_datatable').DataTable();
                        oTable.ajax.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save changes');
                    }
                });
            });
        });
    </script>
</body>

</html>
