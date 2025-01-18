<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report</title>
  <style>
    table {
      width: 100%;
    }
    table, td {
      border: 1px solid;
    }
  </style>
</head>
<body>
    <h1 style="text-align:center;">Transaction Report</h1>
    <table>
      <thead>
        <tr>
          <td>No</td>
          <td>Transaction Date</td>
          <td>Type</td>
          <td>Due Date</td>
          <td>Return Date</td>
          <td>Book</td>
          <td>Member</td>
          <td>Late Fee</td>
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $index => $transaction)
          <tr>
            <td>{{ $index }}</td>
            <td>{{ $transaction->transaction_date }}</td>
            <td>{{ $transaction->transaction_type }}</td>
            <td>{{ $transaction->due_date }}</td>
            <td>{{ $transaction->return_date }}</td>
            <td>{{ $transaction->book->title }}</td>
            <td>{{ $transaction->member->name }}</td>
            <td>{{ $transaction->late_fee }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
</body>
</html>