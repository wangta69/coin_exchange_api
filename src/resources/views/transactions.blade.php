<table class="api-result">
    <thead>
        <th>분류</th>
        <th>거래체결일자</th>
        <th>체결수량</th>
        <th>체결가격</th>
        <th>체결금액</th>
        <th>거래수수료</th>
        <th>거래후 currency</th>
        <th>거래후 krw</th>
    </thead>
    <tbody>
        
        @foreach ($data as $index => $item)
        <tr>
            <td>{{ $item->search_str }}</td>
            <td>{{ $item->transfer_date }}</td>
            <td>{{ $item->units }}</td>
            <td>{{ $item->krw_currency }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->fee }}</td>
            <td>{{ $item->currency_remain }}</td>
            <td>{{ $item->krw_remain }}</td>
        </tr>
        @endforeach
    </tbody>
    
</table>