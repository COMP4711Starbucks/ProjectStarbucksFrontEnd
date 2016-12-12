<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" id="tableHeading"><h1>Recipe Menu</h1></div>
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>#</th> 
                <th>Menu</th>
            </tr>
        </thead>
        <tbody>
            {names}
                <tr>
                  <td>{id}</td> 
                  <td>
                      <a href="recipe/{id}">{name}</a>
                  </td>       
                </tr>
            {/names}
        </tbody>
    </table>
</div>