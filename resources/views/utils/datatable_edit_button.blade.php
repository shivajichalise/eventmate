@can('edit ' . $model)
<div class="row">
    <div class="col-md-4">
        <a href="{{ route($editRoute, $id) }}" class="btn btn-primary btn-xs"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
    </div>
</div>
@endcan
