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
    <button type="button" id="add1" class="btn btn-primary" style="margin-right: 300px">Add new code</button>
    <table class="table table-bordered data-table" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>
@include('howitworksaddmodal')
@include('howitworkseditmodal')
<script type="text/javascript">
    $(function () {

        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('create.show') }}",
            },
            columns: [

                {data: 'id', name: 'id'},
                {data: 'code', name: 'code'},
                {data: 'actions', name: 'actions',orderable:false,serachable:false,sClass:'text-center'},
            ]

        });
        $(document).on('click', '#add1', function () {
            $('.addcode').modal('show');
        });
        $(document).on('click', '#savecode', function (e) {
            e.preventDefault();
            var formData = new FormData($('#add-form')[0]);
            $.ajax({
                type: 'post',
                url: "{{route('create.code')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status === true) {
                        $('.addcode').modal('hide');
                        $('.data-table').DataTable().ajax.reload(null, false);
                        $('#msg').text(data.message).show();
                    } else {
                        $('#msg').text(data.message).show();
                    }
                }
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click','#editP', function(){
            var code_id = $(this).data('id');
            $.post('{{ route("getup.codedata") }}',{id:code_id}, function(data){
                $('.editcode').modal('show');
                $('.editcode').find('input[name="cid"]').val(data.codes.id);
                $('.editcode').find('input[name="code"]').val(data.codes.code);
            },'json');
        });
        $(document).on('click', '#updatecode', function (e) {
            e.preventDefault();
            var formData = new FormData($('#update-form')[0]);
            $.ajax({
                type: 'post',
                url: "{{route('update.codedata')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status === true) {
                        $('.editcode').modal('hide');
                        $('.data-table').DataTable().ajax.reload(null, false);
                        $('#msg').text(data.message).show();
                    } else {
                        $('#msg').text(data.message).show();
                    }
                }
            });
        });
        $(document).on('click','#deletep', function(){
            var code_id = $(this).data('id');
            $.post('{{ route("delete.codedata") }}',{id:code_id}, function(data){
                if(data.status=== true) {
                    $('.data-table').DataTable().ajax.reload(null, false);
                    $('#msg').text(data.message).show();
                }else{
                    $('#msg').text(data.message).show();
                }
            },'json');
        });
    });
</script>
