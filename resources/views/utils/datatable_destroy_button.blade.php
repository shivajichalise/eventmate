<div class="row">
    @can('delete ' . $model)
    <div class="col-md-4">
        <form action="{{ route($destroyRoute, $id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this sub-event?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
        </form>
    </div>
    @endcan
</div>
