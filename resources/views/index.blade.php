@extends('layout.master')
@section('content')
<div class="row justify-content-center align-items-center mt-4 mr-0">
    <div class="col-12 col-md-8">
        <form class="row mb-4 ajaxForm form-validate" method="post" id="form" action="{{route('task.store')}}">
            @csrf
            <div class="col-7"><input type="text" class="form-control" name="name" id="name"> </div>
            <div class="col-3">
                <select class="form-control " name="project" id="project">
                    <option value="">Select Project</option>
                    <option value="0">HTML</option>
                    <option value="1">PHP</option>
                    <option value="2">LARAVEL</option>
                </select>
            </div>
            <div class="col-2"><button class="btn btn-success btn-block btn-lg" type="submit" id="add">Add</button></div>
        </form>
        <div class="card">
            <div class="card-header">
                <h4>Filter</h4>
                <div class="card-header-action">
                    <form>
                        <select class="form-control" id="filter">
                    <option value="-1" data-url="{{route('task.filter',['id'=>-1])}}">All</option>
                    <option value="0" data-url="{{route('task.filter',['id'=>0])}}">HTML</option>
                    <option value="1" data-url="{{route('task.filter',['id'=>1])}}">PHP</option>
                    <option value="2" data-url="{{route('task.filter',['id'=>2])}}">LARAVEL</option>
                </select>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped" id="sortable-table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <i class="fas fa-th"></i>
                                </th>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Project</th>
                                <th>Date</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @include('components.tasks')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.edit_task_modal')
<script>
$('#filter').change(function(){
 
        $.ajax({
            type: 'GET',
            url:  $(this).find(':selected').data('url'),
            error: function(error) {
                console.log(error.responseText);
            },
            success: function(response) {
                $('.list').html(response);
            }
        });
})
    var callBackFunction = function() {
        var url = '{{route('task.list')}}';
        $.ajax({
            type: 'GET',
            url: url,
            error: function(error) {
                console.log(error.responseText);
            },
            success: function(response) {
                $('.list').html(response);

            }
        });
    }

       function editTask(url,id) {
        
        jQuery('#editTask').modal('show', {
            backdrop: 'true'
        });

          $.ajax({
             url: url,
             processData: false,
                    contentType: false,
             error :function(error){
               console.log(error.responseText);
             },
         success: function(response){

            var w=jQuery('#editTask input[name="name"]').val(response.name)
            var u=jQuery('#editTask select').val(response.project).change()
            var u=jQuery('#editTask form').attr('action','{{url('/task/update')}}/'+id)
               }
        });
    }   

    function deleteTask(url){
   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'DELETE',
            url:url,
            processData: false,
            contentType: false,
            dataType: 'json',
                    error: function(error) {
                console.log(error.responseText);

                if (error.status == 422) {
                    var a = error.responseJSON.errors;
                }
            },
            success: function(response) {
                console.log(response);

                callBackFunction();
            },
            complete: function(data) {
         }
  })
}

$(function() {
    var validator = $(".form-validate2").validate({
        rules: {
            name: {
                'required': true
            },
            project: {
                required: true,
            },
        },
        errorElement: "span"
    })

        var validator = $(".form-validate2").validate({
        rules: {
            name: {
                'required': true
            },
            project: {
                required: true,
            },
        },
        errorElement: "span"
    })

    $(".ajaxForm").submit(function(e) {
        var form = $(this)
             ajaxSubmit(e, form, callBackFunction, "POST");
    })

     $(".ajaxForm2").submit(function(e) {
           var form = $(this)
          ajaxSubmit(e, form, callBackFunction, "POST");

    })

})
</script>
@endsection
