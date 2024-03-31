    @php
        $alerts = ['success', 'danger', 'info', 'warning', 'primary', 'secondary', 'light', 'dark'];
    @endphp
    @foreach ($alerts as $alert)
        @if (session()->has($alert))
            <div class="container mt-4">
                <div class="alert alert-{{ $alert }} alert-dismissible fade show" role="alert">
                    <strong>{{ ucfirst($alert) }}</strong>: {{ ucfirst(session($alert)) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
            {{ session()->forget($alert) }}
        @endif
    @endforeach
