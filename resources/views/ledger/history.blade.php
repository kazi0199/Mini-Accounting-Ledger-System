<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction History - {{ $account->name }}</title>

    {{-- BootStrap CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{--Dynamic Data table CSS--}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">



</head>
<body>

  <div class="container">
    <h2>Ledger History for {{ $account->name }}</h2>
    <div class="row">

        <h3><a href="{{ route('add.form') }}" class="btn btn-primary">Add Transaction</a></h3>
        
        <div>
          @if (session('success'))
           <div class="alert alert-success">
             {{ session('success') }}
           </div>
          @endif
        </div>

        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Running Balance</th>
                </tr>
            </thead>
            <tbody>

                @php
                  $runningBalance = 0;
                  $totalDebit = 0;
                  $totalCredit = 0;
                @endphp

              @foreach ($transactions as $transaction)
                @php
                  if($transaction->type === 'debit')
                  {
                    $runningBalance += $transaction->amount;
                    $totalDebit += $transaction->amount;
                  }
                  else
                  {
                    $runningBalance -= $transaction->amount;
                    $totalCredit += $transaction->amount;
                  }
                @endphp

                <tr class="{{ $transaction->type }}">
                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->note }}</td>
                    <td>{{ $runningBalance }}</td>
                </tr>

              @endforeach

            </tbody>

            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>Debit: {{ $totalDebit }} <br>Credit: {{ $totalCredit }}</td>
                    <td colspan="2">Final Balance: {{ $runningBalance }}</td>
                </tr>
            </tfoot>

        </table>
        <br><br>

        <form action="{{ route('sendEmail',$account->id) }}" method="POST">
          @csrf
        
          <button type="submit" class="btn btn-info">Send Transaction Report</button>
        </form>



    </div>
  </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            responsive: true,
            pageLength: 50,
        });
    });
    </script>
    
</body>
</html>