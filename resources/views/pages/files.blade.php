@extends ('layouts.main')
@section('title')
    Files
@endsection

@section('main')
    <h1>Files list</h1>

    <div class="container">
        <h3 style="font-family: arial">{{ $data->folder }} . ' Fichiers de 0 à {{ $data->nbFiles }}</h3>

        <table class="table table-sm table-bordered table-rounded m-auto" style="width: 97%">
            @foreach ($data->files as $k => $file)
                <tr>
                    <td style="text-align: right;background-color:{{ $file['bgColor'] }};">{{ $k }}</td>
                    <td style="background-color:{{ $file['bgColor'] }};">{{ $file['name'] }}</td>
                    <td style="text-align: right;background-color:{{ $file['bgColor'] }};">{{ $file['adsCount'] }}</td>
                    <td style="text-align: center;background-color:{{ $file['bgColor'] }};">{{ $file['createdAt'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
