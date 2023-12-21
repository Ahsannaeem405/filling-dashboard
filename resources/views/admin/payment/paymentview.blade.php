<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
        color: white
    }

    .custom-th,
    .custom-td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .custom-th {
        text-align: left;
    }
</style>

<table class="custom-table">
    <tr>
        <th class="custom-th">Client Name:</th>
        <td class="custom-td">{{ $payment->client_name }}</td>
    </tr>
    <tr>
        <th class="custom-th">User Name:</th>
        <td class="custom-td">{{ $payment->user->name }}</td>
    </tr>
    <tr>
        <th class="custom-th">BTC Wallet:</th>
        <td class="custom-td">{{ isset($payment->user->wallet) ? $payment->user->wallet : '-' }}</td>
    </tr>
    <tr>
        <th class="custom-th">Price</th>
        <td class="custom-td">{{ $payment->price }}</td>
    </tr>
    <tr>
        <th class="custom-th">Status</th>
        @if ($payment->status)
            <td class="custom-td">
                @if ($payment->status === 'paid')
                    Ausgezahlt
                @elseif($payment->status === 'reject')
                    Abgelehnt
                @elseif($payment->status === 'pending')
                    Ausstehend
                @endif
            </td>
        @else
            <td class="custom-td">waiting for approval</td>
        @endif
    </tr>
    @if ($payment->status === 'reject')
        <tr>
            <th class="custom-th">Reason</th>
            <td class="custom-td">{{ $payment->reason }}</td>
        </tr>
    @endif
    <tr>
        <th class="custom-th">Issue Date</th>
        <td class="custom-td">{{ $payment->created_at->format('d M Y') }}</td>
    </tr>
</table>
