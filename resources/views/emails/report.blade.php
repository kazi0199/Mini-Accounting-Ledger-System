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

    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .debit { background-color: #d4edda; }
        .credit { background-color: #f8d7da; }
    </style>

</head>
<body>

  <div class="container">
    <h2>Ledger History for {{ $account->name }}</h2>
    <div class="row">
        

        <table  class="table table-striped table-bordered">
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


    </div>
  </div>


    
</body>
</html>