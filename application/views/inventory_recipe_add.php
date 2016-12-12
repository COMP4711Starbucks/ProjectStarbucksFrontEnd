<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" id="tableHeading">
        <h1>{action}</h1>
        {error_messages}
    </div>
    <!-- Table -->
    <form action="/inventory/detail/save" method="post">
        <table class="table">
            <tbody>
                <tr>
                    <td>{fname}</td>
                    <td>{fquantity}</td>
                </tr>
            </tbody>
        </table>
        {zsubmit} 
        <a class="btn btn-default" role="button" href="/inventory/detail/cancel">Cancel</a>
    </form>
</div>