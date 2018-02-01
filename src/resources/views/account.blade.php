<table class="api-result">
    <thead>
        <th>회원가입 일시</th>
        <th>회원ID</th>
        <th>거래 수수료</th>
        <th>1Currency 잔액</th>
    </thead>
    <tbody>
        

        <tr>
            <td>{{ $item->created }}</td>
            <td>{{ $item->account_id }}</td>
            <td>{{ $item->trade_fee }}</td>
            <td>{{ $item->balance }}</td>
        </tr>

    </tbody>
    
</table>