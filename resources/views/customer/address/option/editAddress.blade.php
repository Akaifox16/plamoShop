<!DOCTYPE html>
<html>

<head>
    <title>Customer Address | Edit</title>
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/edit-address/{{$address->CustomerID}}/{{$address->AddressNo}}" method="post">
        <table>
        <tr><input type="hidden" name="_token" value="{{ csrf_token() }}"></tr>
            <tr><input type="hidden" name="customerID" value="{{ $address->CustomerID }}"></tr>
            <tr>
                <td><input type="text" readonly="true" name="addressNo" value="{{$address->AddressNo}}"></td>
                <td><label for="addressNo">addressNo. </label></td>
            </tr>
            <tr>
                <td><input type='text' name='addressLine1' value="{{$address->AddressLine1}}"/></td>
                <td><label for="addressLine1">address line 1</label></td>
            <tr>
                <td><input type='text' name='addressLine2' value="{{$address->AddressLine2}}"/></td>
                <td><label for="addressLine2">address line 2</label></td>
            </tr>
            <tr>
                <td><input type="text" name='city' value="{{$address->City}}"/></td>
                <td><label for="city">city</label></td>
            </tr>
            <tr>
                <td><input type="text" name='state' value="{{$address->State}}"/></td>
                <td><label for="state">state</label></td>
            </tr>
            <tr>
                <td><input type="text" name='postCode' value="{{$address->PostalCode}}"/></td>
                <td><label for="postalCode">postalCode</label></td>
            </tr>
            <tr>
                <td><input type="text" name='country' value="{{$address->Country}}"/></td>
                <td><label for="country">country</label></td>
            </tr>

            <tr>
                <td ><input type='submit' value="Edit address" /></td>
                <td><a href="/customer-address/{{ $address->CustomerID }}">Back</a></td>
            </tr>
        </table>
    </form>
</body>

</html>