<h1>Orders Processed So Far</h1>

<table class="table">
    <tr>
        <th>Order #</th>
        <th>Date/time</th>
        <th>Amount</th>
    </tr>
    
    {orders}
    <tr>
        <td><a href="/order/examine/{number}">{number}</a></td>
        <td>{datetime}</td>
        <td>{total}</td>
    </tr>
    {/orders}
</table>