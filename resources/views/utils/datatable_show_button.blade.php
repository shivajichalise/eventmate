<div class="row">
    @can('view ' . $model)
    <div class="col-md-4">
            <a href="{{ route($showRoute, $id) }}" class="btn btn-success btn-xs"><i class="fa-sharp fa-solid fa-eye"></i></a>
    </div>
    @endcan
</div>
