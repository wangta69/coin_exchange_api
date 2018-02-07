@if ($exchanger === 'bithumb')
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
@elseif ($exchanger === 'coinone')
<h3>계좌정보</h3>
<table class="api-result">
    <thead>
        <th>depositor</th>
        <th>accountNumber</th>
        <th>bankName</th>
    </thead>
    <tbody>
        
        <tr>
            <td>{{ $item->bankInfo->depositor }}</td>
            <td>{{ $item->bankInfo->accountNumber }}</td>
            <td>{{ $item->bankInfo->bankCode }}</td>
        </tr>
      

    </tbody>
    
</table>
<h3>이메일정보</h3>
이메일 : {{ $item->emailInfo->email }}
<h3>모바일정보</h3>
<table class="api-result">
    <thead>
        <th>userName</th>
        <th>phoneNumber</th>
        <th>phoneCorp</th>
    </thead>
    <tbody>
        
        <tr>
            <td>{{ $item->mobileInfo->userName }}</td>
            <td>{{ $item->mobileInfo->phoneNumber }}</td>
            <td>{{ $item->mobileInfo->phoneCorp }}</td>
        </tr>
      

    </tbody>
    
</table>
<h3>수수료정보</h3>
<table class="api-result">
    <thead>
        <tr>
            <th colspan="2">ltc</th>
            <th colspan="2">etc</th>
            <th colspan="2">btg</th>
            <th colspan="2">bch</th>
            <th colspan="2">btc</th>
            <th colspan="2">qtum</th>
            <th colspan="2">eth</th>
            <th colspan="2">xrp</th>
            <th colspan="2">iota</th>
        </tr>
        <tr>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
            <th>taker</th>
            <th>maker</th>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>{{ $item->feeRate->ltc->taker }}</td>
            <td>{{ $item->feeRate->ltc->maker }}</td>
            <td>{{ $item->feeRate->etc->taker }}</td>
            <td>{{ $item->feeRate->etc->maker }}</td>
            <td>{{ $item->feeRate->btg->taker }}</td>
            <td>{{ $item->feeRate->btg->maker }}</td>
            <td>{{ $item->feeRate->bch->taker }}</td>
            <td>{{ $item->feeRate->bch->maker }}</td>
            <td>{{ $item->feeRate->btc->taker }}</td>
            <td>{{ $item->feeRate->btc->maker }}</td>
            <td>{{ $item->feeRate->qtum->taker }}</td>
            <td>{{ $item->feeRate->qtum->maker }}</td>
            <td>{{ $item->feeRate->eth->taker }}</td>
            <td>{{ $item->feeRate->eth->maker }}</td>
            <td>{{ $item->feeRate->xrp->taker }}</td>
            <td>{{ $item->feeRate->xrp->maker }}</td>
            <td>{{ $item->feeRate->iota->taker }}</td>
            <td>{{ $item->feeRate->iota->maker }}</td>
        </tr>
      

    </tbody>
    
</table>
@endif