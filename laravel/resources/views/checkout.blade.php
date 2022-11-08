Hello world
<table border="1" align="center" style="text-align: center;">
    <tr>
        <td>
            Name
        </td>
        <td>
            Eenheid prijs
        </td>
        <td>
            Aantal
        </td>
        <td>
            Totaal prijs
        </td>
    </tr>
    @foreach( $products as $product)
        <tr>
            <td>
                {{ $product['name'] }}
            </td>
            <td>
                {{ $product['unitPrice'] }}
            </td>
            <td>
                {{ $product['amount'] }}
            </td>
            <td>
                {{ $product['totalPrice'] }}
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Price: </td>
        <td>{{ $totalPrice }}</td>
    </tr>
    <tr>
        <td colspan="3">BTW Amount: </td>
        <td>{{ $btwAmount }}</td>
    </tr>
    <tr>
        <td colspan="3">Price inclusief BTW: </td>
        <td>{{ $totalPriceInclBTW }}</td>
    </tr>
</table>
