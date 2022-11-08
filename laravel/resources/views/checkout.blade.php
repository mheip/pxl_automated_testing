<table border="1" align="center" style="text-align: center;">
    <tr>
        <td>
            Name
        </td>
        <td>
            Unit price
        </td>
        <td>
            Ammount
        </td>
        <td>
            Discount percentage
        </td>
        <td>
            Discount amount
        </td>
        <td>
            Total price
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
                @if(isset($product['discount']))
                    {{ $product['discount'] }}
                @endif
            </td>
            <td>
                @if(isset($product['discountAmount']))
                    {{ $product['discountAmount'] }}
                @endif
            </td>
            <td>
                {{ $product['totalPrice'] }}
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Price:</td>
        <td>{{ $totalPriceFull }}</td>
    </tr>
    <tr>
        <td colspan="3">Discount percentage:</td>
        <td>{{ $globalDiscountPercentage }}%</td>
    </tr>
    <tr>
        <td colspan="3">Discount amount:</td>
        <td>{{ $globalDiscountAmount }}</td>
    </tr>
    <tr>
        <td colspan="3">Discounted Price:</td>
        <td>{{ $totalPrice }}</td>
    </tr>
    <tr>
        <td colspan="3">BTW Amount:</td>
        <td>{{ $btwAmount }}</td>
    </tr>
    <tr>
        <td colspan="3">Price incl:</td>
        <td>{{ $totalPriceInclBTW }}</td>
    </tr>
</table>
