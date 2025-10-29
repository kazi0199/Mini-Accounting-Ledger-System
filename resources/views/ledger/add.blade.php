<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transition</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>

<div class="container">
    <div class="row">
        <br>
        
        <h1>Add Transition</h1>
        {{-- <h3><a href="{{ route('transition.history',$transactions->id) }}" class="btn btn-primary">View Transaction</a></h3> --}}


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('store.transition') }}" method="POST" >
            @csrf
        
            <div class="form-group">
                <label>Account:</label>
                <select name="account_id"  class="form-control">

                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach

                </select>
            </div>
            <br>

            <div class="form-group">
                <label>Type:</label>
                <select name="type"  class="form-control">

                    <option value="debit">Debit</option>
                    <option value="credit">Credit</option>

                </select>
            </div>
            <br>

            <div class="form-group">
                <label>Amount:</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <br>

            <div class="form-group">
                <label>Note:</label>
                <input type="text" name="note" class="form-control" required>
            </div>
            <br>

            <div class="form-group">
                <input type="submit" value="Add Transition" class="btn btn-primary">
            </div>


        </form> 

    </div>
</div>
    
</body>
</html>