<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spencer - Preferences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">

    @vite(['resources/css/custom.css'])
</head>
<body class="bg-light">
<x-header />
<main class="d-flex">
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @foreach($allSettings as $setting)
            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="fw-medium text-dark"> {{ ucfirst(str_replace('_',' ',$setting->name)) }}</span>
                <div class="form-check form-switch fs-4">
                    @php
                        $customLabels = [
                            'czech' => 'Čeština',
                            'english' => 'English',
                            'german' => 'Deutsch'
                        ];
                        

                        $toggleOption = $setting->options->whereIn('option_data', ['dark', 'show', 'enable'])->first();
                        $isToggle = ($setting->options->count() === 2 && $toggleOption);
                    @endphp
                    @if ($isToggle)
                    <input class="form-check-input" type="checkbox" role="switch" 
                        name="options[{{ $setting->id }}]" 
                        value="{{ $toggleOption->id }}"
                        {{ in_array($toggleOption->id, $currentSelect) ? 'checked' : '' }}>
                    @else
                        <select name="options[{{ $setting->id }}]" class="form-select fs-6">
                            @foreach ($setting->options as $option)
                                @php
                                    $dName = $customLabels[$option->option_data] ?? ucfirst($option->option_data);
                                @endphp
                                <option value="{{ $option->id }}"
                                    {{ in_array($option->id, $currentSelect) ? 'selected' : '' }}>
                                    {{ $dName }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        @endforeach
        <button type="submit">Save and Refresh</button>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
