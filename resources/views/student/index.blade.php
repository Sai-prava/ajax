<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
</head>

<body>
    <h3>Dashboard</h3>
    <div class="col-md-6">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($alldata as $data)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->number }}</td>
                        <td>{{ $data->address }}</td>
                        <td>{{ $data->description }}</td>

                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $data->id }}"><i class="bi bi-pencil"></i></button>
                            <a href="{{ route('student.delete', $data->id) }}" class="btn btn-danger btn-sm"><i
                                    class="bi bi-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update/Edit </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('student.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $data->name }}">

                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputPassword1" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="email"
                                                value="{{ $data->email }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputPassword1" class="form-label">Number</label>
                                            <input type="number" class="form-control" name="number"
                                                value="{{ $data->number }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputPassword1" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $data->address }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleInputPassword1" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" cols="30" rows="3">{{ $data->description }}</textarea>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('auth.logout') }}" class="btn btn-warning">Logout</a>

    <div>
        @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('student.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control mt-3" required><br>
        <button type="submit" class="btn btn-success">Import</button>
    </form>
    </div>
    <div class="mt-1">
        <div style="margin-left:52%">
            <h3>Add the Data</h3>
        </div>
    </div>


    <div class="col-md-6" style="margin-left: 52%;border: 1px solid grey;padding: 15px;max-width: 40%;">

        <form action="{{ route('student.store') }}" method="post">
            @csrf

            <div class="mb-2">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">

            </div>
            <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email">
            </div>
            <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Number</label>
                <input type="number" class="form-control" name="number">
            </div>
            <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Address</label>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea class="form-control" name="description" cols="30" rows="3"></textarea>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
