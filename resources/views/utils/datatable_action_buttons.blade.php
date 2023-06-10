<div class="row">
    <div class="col-md-4">
            <a href="{{ route($showRoute, $id) }}" class="btn btn-success btn-xs"><i class="fa-sharp fa-solid fa-eye"></i></a>
    </div>
    <div class="col-md-4">
            <a href="{{ route($editRoute, $id) }}" class="btn btn-primary btn-xs"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
    </div>
    <div class="col-md-4">
            <form action="{{ route($destroyRoute, $id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this event?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
            </form>
        </div>
</div>
