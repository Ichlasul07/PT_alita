<!-- resources/views/locations/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Locations</h1>
        <a href="javascript:void(0)" class="btn btn-info" id="create-new-location">Add New</a>
        <br><br>
        <table class="table table-bordered table-striped" id="location-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal for Add/Edit -->
    <div class="modal fade" id="location-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="locationModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <form id="locationForm" name="locationForm" class="form-horizontal">
                        <input type="hidden" name="code" id="code">
                        <div class="form-group">
                            <label for="code" class="col-sm-2 control-label">Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Enter Code" value="" maxlength="10" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="" maxlength="100" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script>
        var SITEURL = '{{ url('/') }}';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#location-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: SITEURL + "/locations",
                    type: 'GET',
                },
                columns: [{
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });

            $('#create-new-location').click(function() {
                $('#btn-save').val("create-location");
                $('#code').val('');
                $('#locationForm').trigger("reset");
                $('#locationModalLabel').html("Add New Location");
                $('#location-modal').modal('show');
            });

            $('body').on('click', '.edit', function() {
                var location_code = $(this).data('code');
                $.get('loactions/edit/' + location_code, function(data) {
                    $('#locationCrudModal').html("Edit Location");
                    $('#btn-save').val("edit-location");
                    $('#ajax-location-modal').modal('show');
                    $('#location_code').val(data.id);
                    $('#name').val(data.name);
                    $('#location_code').val(data.location_code);
                    $('#birth_date').val(data.birth_date);
                });
            });

            $('body').on('click', '.delete-location', function() {
                var code = $(this).data('code');
                if (confirm("Are you sure you want to delete this location?")) {
                    $.ajax({
                        type: "GET",
                        url: SITEURL + "/locations/delete/" + code,
                        success: function(data) {
                            if (data.success) {
                                var oTable = $('#location-table').DataTable();
                                oTable.ajax.reload();
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

            $('body').on('submit', '#locationForm', function(e) {
                e.preventDefault();
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');
                $.ajax({
                    type: 'POST',
                    url: SITEURL + "/locations/store",
                    data: $(this).serialize(),
                    success: function(data) {
                        $('#locationForm').trigger("reset");
                        $('#location-modal').modal('hide');
                        $('#btn-save').html('Save changes');
                        var oTable = $('#locations-table').DataTable();
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
