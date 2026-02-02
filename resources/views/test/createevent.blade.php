<form action="/event/create" method="POST">
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
    <input type="text" name="title" value="{{ old('title') }}">
    <input type="text" name="description" value="{{ old('description') }}">
    <input type="datetime-local" name="deadline" value="{{ old('deadline') }}">
    <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}">
    <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}">
    <input type="number" name="group_id" value="{{ old('group_id') }}">
    <button type="submit">Create Event</button>
</form>
