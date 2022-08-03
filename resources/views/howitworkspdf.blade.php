<!DOCTYPE html>
<html>
<head>
    <title>datatable</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body>
<div class="container">
    <div class="alert alert-success" id="msg" style="display: none;">

    </div>
    <button type="button" id="add2" class="btn btn-primary" style="margin-right: 300px">Add new file</button>
    <table class="table table-bordered data-table1" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Link</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>
@include('howitworkspdfeditmodal')
@include('howitworkspdfaddmodal')
<script type="text/javascript">
    $(function () {

        $('.data-table1').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('createpdf.show') }}",
            },
            columns: [

                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: function(data){
                    return `<a href="${data.link}">PDF</a>`;
                    }, name: 'link'},
                {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
            ]

        });
        $(document).on('click', '#add2', function () {
            $('.addfile').modal('show');
        });
        $(document).on('click', '#savefile', function (e) {
            e.preventDefault();
            var formData = new FormData($('#add-pdf')[0]);
            $.ajax({
                type: 'post',
                url: "{{route('create.file')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status === true) {
                        $('.addfile').modal('hide');
                        $('.data-table1').DataTable().ajax.reload(null, false);
                        $('#msg').text(data.message).show();
                    } else {
                        $('#msg').text(data.message).show();
                    }
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click','#editt', function(){
            var code_id = $(this).data('id');
            $.post('{{ route("getup.file") }}',{id:code_id}, function(data){
                $('.editfile').modal('show');
                $('.editfile').find('input[name="fid"]').val(data.files.id);
                $('.editfile').find('input[name="title"]').val(data.files.title);
            },'json');
        });
        $(document).on('click', '#updatefile', function (e) {
            e.preventDefault();
            var formData = new FormData($('#edit-pdf')[0]);
            $.ajax({
                type: 'post',
                url: "{{route('update.filedata')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status === true) {
                        $('.editfile').modal('hide');
                        $('.data-table1').DataTable().ajax.reload(null, false);
                        $('#msg').text(data.message).show();
                    } else {
                        $('#msg').text(data.message).show();
                    }
                }
            });
        });
        $(document).on('click','#delete1', function(){
            var code_id = $(this).data('id');
            $.post('{{ route("delete.file") }}',{id:code_id}, function(data){
                if(data.status=== true) {
                    
                    $('.data-table1').DataTable().ajax.reload(null, false);
                    
                    $('#msg').text(data.message).show();
               
                }else{
                    $('#msg').text(data.message).show();
                }
            },'json');
        });
        });

    </script>
