<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" id="tableHeading">
        <h1>{name}</h1>
        {error_messages}
    </div>
    <!-- Table -->
    <form action="/recipe/detail/save" method="post">
    <table class="table">
        
        <thead>
            <tr>
                <th>Item</th> 
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                  <td>{fname}</td> 
                  <td>{fquantity}</td>
                </tr>
        </tbody>
        
    </table>
        {zsubmit} <a class="btn btn-default" role="button" href="/recipe/detail/cancel">Cancel</a>
        <a class="btn btn-default" role="button" href="/recipe/detail/delete">Delete</a>
    </form>
</div>

