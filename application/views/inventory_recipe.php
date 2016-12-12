<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" id="tableHeading"><h1>Inventory Recipe</h1></div>
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Ingredent Name</th>
                <th>Recipe</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="30">{inventoryName}</td>
            </tr>
            {menu}
                <tr>
                    <td>{name}</td>
                </tr>
            {/menu}
        </tbody>
    </table>
</div>