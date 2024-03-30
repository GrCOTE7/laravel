<footer>
    <a title="{{ ucfirst(\Carbon\Carbon::now()->isoFormat('LL')) }}">{{ ucfirst(\Carbon\Carbon::now()->calendar()) }}</a> -

    @php
        echo env('APP_NAME', 'oOo');
    @endphp
    (From php block in template) - PHP:{{ phpversion() }}

</footer>
