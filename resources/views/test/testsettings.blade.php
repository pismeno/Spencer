
<form action="{{ route('settings.update') }}" method="POST">
    @csrf
    @foreach($allSettings as $setting)
        <strong>{{ $setting->name }}</strong>
        
        @foreach($setting->options as $option)
            <label>
                <input type="radio" 
                        name="options[{{ $setting->id }}]" 
                        value="{{ $option->id }}"
                        {{ in_array($option->id, $currentSelect) ? 'checked' : '' }}>
                {{ $option->option_data }} (ID: {{ $option->id }})
            </label>
        @endforeach
    @endforeach
    <button type="submit">Save and Refresh</button>
</form>