<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="name" class="from-label">Name</label>
                        <input type="text" class="form-cntrol" id="name" name="name" value="{{ $Student->name }}">
                    </div>
                    <div class="mb-3 row">
                        <label for="city" class="from-label">City</label>
                        <input type="text" class="form-cntrol" id="city" name="city" value="{{ $Student->city }}">
                    </div>
                    <div class="mb-3 row">
                        <label for="marks" class="from-label">Marks</label>
                        <input type="number" class="form-cntrol" id="marks" name="marks" value="{{ $Student->marks }}">
                    </div>
                    <button class="btn btn-primary">UPDATE</button>

                </form>
                @if(session()->has('status'))
                <div class="alert alert-success"></div>
                {{ session('status') }}

                @endif
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>
