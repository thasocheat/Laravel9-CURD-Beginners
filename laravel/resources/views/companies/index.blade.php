<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 9 CURD Example Tutorial</h2>
                </div>
                <div class="pull-right mb-2">
                    <a href="{{ route('companies.create') }}" class="btn btn-success">Create Company</a>
                </div>
            </div>
        </div>
        @if($message = Session::get('success'))
        {{-- <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div> --}}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p >{{ $message }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            
        @endif

        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Company Name</th>
                <th scope="col">Company Email</th>
                <th scope="col">Compnay Address</th>
                <th scope="col" width="280px">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($companies as $company)
                <tr>
                    {{-- <td>{{$company->id}}</td> --}}
                    <td>{{ ++$i }}</td>
                    <td>{{$company->name}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->address}}</td>
                    <td>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
              @endforeach  
              
            </tbody>
          </table>
          {!! $companies->links() !!}
          
    </div>
    
</body>
</html>