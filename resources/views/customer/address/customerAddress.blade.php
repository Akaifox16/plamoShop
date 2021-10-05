<!DOCTYPE html>
<html>

<head>
    <title>Customer Addresses</title>
</head>

<body>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif

    <h1>{{$customer[0]->customerName}}</h1>
    <table>
        <tr>
            <td>selected</td>
            <td>No.</td>
            <td>address</td>
            <td>city</td>
            <td>state</td>
            <td>postal code</td>
            <td>country</td>
        </tr>

        @foreach ($addresses as $address)
        <tr>
            <td>
                @if ($address->selected == 1)
                <input type="radio" name="addrNo" value='{{$address->AddressNo}}' checked="checked">
                @else
                <input type="radio" name="addrNo" value='{{$address->AddressNo}}'>
                @endif
            </td>
            <td> {{$address->AddressNo}} </td>
            <td>
                <p>{{$address->AddressLine1}}</p>
                <p>{{$address->AddressLine2}}</p>
            </td>
            <td> {{$address->City}} </td>
            <td> {{$address->State}} </td>
            <td> {{$address->PostalCode}} </td>
            <td> {{$address->Country}} </td>
            <td> <a href="/edit-address/{{$address->CustomerID}}/{{$address->AddressNo}}">edit</a> </td>
            <td><form action="/delete-address/{{$address->CustomerID}}/{{$address->AddressNo}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="#" onclick="event.preventDefault();this.parentNode.submit()">del</a>
                </form> 
            </td>
        </tr>

        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> <a href="/add-address/{{$addresses[0]->CustomerID}}/">add new</a> </td>
            <td><a href="/customer-list">Back</a></td>
        </tr>
    </table>
</body>

</html>