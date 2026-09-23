<!DOCTYPE html>
<html>
<head>
    <title>Leads</title>
</head>
<body>

    <h1>All Leads</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('leads.create') }}">Add New Lead</a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Lead Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Expected Deal Value</th>
        </tr>

        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->lead_name }}</td>
                <td>{{ $lead->company_name }}</td>
                <td>{{ $lead->email }}</td>
                <td>{{ $lead->phone }}</td>
                <td>{{ $lead->status }}</td>
                <td>{{ $lead->expected_deal_value }}</td>
            </tr>
        @endforeach

    </table>

</body>
</html>