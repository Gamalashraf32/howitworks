<!DOCTYPE html>
<html>
<head>
    <title>datatable</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    </head>
<body>
    <button class="btn btn-sm btn-primary"   id="editP">Update</button>
<form action="{{url('create_code')}}" method="get">
    <button class="btn btn-sm btn-primary"   id="addcode">addcode</button>
</form>
<div class="modal fade editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="update-form">
                    @csrf
                    <input type="hidden" name="pid">
                    <div class="form-group">
                        
                        <span class="text-danger error-text product_name_error"></span>
                        <div class="alert alert-danger" id="failed_msg" style="display: none;">
                            make sure you have changed the content
                    </div>
                        <label for="">code</label>
                        <input type="text" class="form-control" name="code" placeholder="Enter product name">
                        <span class="text-danger error-text product_name_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>




<div class="modal fade editProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="update-form">
                    @csrf
                    <input type="hidden" name="pid">
                    <div class="form-group">
                        
                        <span class="text-danger error-text product_name_error"></span>
                        <div class="alert alert-danger" id="failed_msg" style="display: none;">
                            make sure you have changed the content
                            </div>
                            
                                    @include('howitworkspdf')
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</form><script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(function(){
            
});



    $(document).on('click','#editP', function(){
            var code_id = $(this).data('id');
            $('.editProduct').find('form')[0].reset();
            $('.editProduct').find('span-error-text').text();
            $.post('{{ route("showeditdata") }}',
            {}, 
            function(data){
            $('.editProduct').modal('show'); 

              },'json');
           });
        
    
           $('#update-form').on('submit',function(e){
                e.preventDefault();
                var formData = new FormData($('#update-form')[0]);
                $.ajax({
                url: "{{ url('/view')}}",
                dataType: 'json',
                type:'post',
                data: formData,
                processData: false,
            contentType: false,
            cache: false,       
            
            success:function(data)
            {
                if (data.status===true)
                    { 
                     $('.editProduct').modal('hide');  
                    $('#success_msg').show();
                    $('.editProducts').modal('show'); 

                    }
                    else
                    {
                        $('#failed_msg').show();

                    } 
            }
                });
            });
        

    </script>
