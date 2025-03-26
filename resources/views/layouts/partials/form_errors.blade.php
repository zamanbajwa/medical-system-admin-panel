@if(Session::get('errors'))
    <div id="form-errors" class="bg-danger">
        <ul class="list-none error-list">
            @foreach(Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach

        </ul>
    </div>
@endif