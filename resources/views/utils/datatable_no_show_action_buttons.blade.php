<div class="row">
    @can('edit ' . $model)
    <div class="col-md-4">
        <a href="{{ route($editRoute, $id) }}" class="btn btn-primary btn-xs"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
    </div>
    @endcan

    @can('delete ' . $model)
    <div class="col-md-4">
        <form action="{{ route($destroyRoute, $id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this {{$model}}?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
        </form>
    </div>
    @endcan
</div>
