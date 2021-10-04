<!DOCTYPE html>
<html>

<head>
    <title>Customer Info</title>
</head>

<body>
    <table>
        <tr>
            <td>CID</td>
            <td>customer name</td>
            <td>contact name</td>
            <td>phone</td>
            <td>credit</td>
        </tr>

        @foreach ($customers as $customer)
        <tr>
            <td> {{ $customer->customerNumber}} </td>
            <td> {{$customer->customerName}} </td>
            <td> {{$customer->contactFirstName}} {{$customer->contactLastName}} </td>
            <td> {{$customer->phone}} </td>
            <td> {{$customer->creditLimit}} </td>
            <td> <a href="/customer-address/{{$customer->customerNumber}}">address</a> </td>
        </tr>
        @endforeach
    </table>
</body>

</html>