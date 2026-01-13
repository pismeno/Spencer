<form action="/group/create" method="POST">
    @csrf
    @if($errors->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="text" name="name" value="{{ old('name') }}">
    <input type="text" name="description" value="{{ old('description') }}">
    <button type="submit">Create Group</button>
</form>
