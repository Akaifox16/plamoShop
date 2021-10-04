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
                <input type="radio" name="addrNo" value='{{$address->addressNo}}' checked="checked">
                @else
                <input type="radio" name="addrNo" value='{{$address->addressNo}}'>
                @endif
            </td>
            <td> {{$address->addressNo}} </td>
            <td>
                <p>{{$address->addressLine1}}</p>
                <p>{{$address->addressLine2}}</p>
            </td>
            <td> {{$address->city}} </td>
            <td> {{$address->state}} </td>
            <td> {{$address->postalCode}} </td>
            <td> {{$address->country}} </td>
            <td> <a href="/edit-address/{{$address->customerID}}/{{$address->addressNo}}">edit</a> </td>
            <td><form action="/delete-address/{{$address->customerID}}/{{$address->addressNo}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="#" onclick="event.preventDefault();this.parentNode.submit()">del</a>
                </form> 
            </td>
        </tr>

        @endforeach
        <tr>
            <td> <a href="">save</a> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> <a href="/add-address/{{$addresses[0]->customerID}}/">add new</a> </td>
            <td><a href="/customer-list">Back</a></td>
        </tr>
    </table>
</body>

</html>