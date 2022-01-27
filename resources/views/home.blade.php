<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel Test 01/27/2022</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5" style="width: 60%">
        <form action="/search" method="get">
            <input type="text" name="username" id="username" class="form-control">
        </form>
        <br />
        <table class="table table-bordered mb-4">
            {{-- <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">DOB</th>
                </tr>
            </thead> --}}
            <tbody>
                @foreach($users as $data)
                <tr>
                    <td>
                        <img src="{{$data->avatar_url}}" alt="" srcset="" style="width: 40px; height:20px">
                    </td>
                    <td>{{ $data->name }}</td>
                    <td>Repos: {{ $data->public_repos }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    </div>
</body>

</html>