@if (count($list) >0)

@php
    $x=1;
@endphp
@foreach ($list as $l)

<tr>
    <td>
        <div class="sort-handler">
            <i class="fas fa-th"></i>
        </div>
    </td>
    <td>{{$x}}</td>
    <td class="align-middle">
     {{$l->name}}
    </td>
    <td>
        @php
            $arr=["HTML","PHP","LARAVEL"]
        @endphp
        
           {{$arr[$l->project]}}
    </td>
    <td>    {{$l->created_at->diffForHumans()}}</td>
    <td>
        <button href="#" class="btn btn-danger delete" onclick="deleteTask('{{route('task.destroy',['id'=>$l->id])}}')">Delete</button>
        <button href="#" class="btn btn-primary"  data-toggle="modal" onclick="editTask('{{route('task.edit',['id'=>$l->id])}}',{{$l->id}})">Edit</button>
    </td>
</tr>
@php
    $x++;
@endphp
@endforeach
@else
<div>Nothing Here</div>
@endif