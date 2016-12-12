<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" id="tableHeading">
        <div class="title">
             <h1>Inventory</h1>
        </div>
        <div class="cartBox">
            <?php
                $role = $this->session->userdata('userrole');

                if($role == "admin"){
                    echo "<a class=\"addBtn\" role=\"button\" href=\"/inventory/detail/add\">Add</a>";
                }
            ?>
        </div>
    </div>
    
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Quantity</th>
              <th></th>
            </tr>
        </thead>
        <tbody>
            {ingreds}
                <tr>
                    <td>{id}</td>
                    <td><a href="inventory/{id}">{name}</a></td>
                    <td>{quantity}</td>
                    <td>
                        <?php
                            $role = $this->session->userdata('userrole');

                            if($role == "admin"){
                                echo "<a class=\"btn btn-default\" role=\"button\" href=\"/inventory/detail/edit/{id}\">Edit</a>";
                                echo "<a class=\"btn btn-default\" role=\"button\" href=\"/inventory/detail/delete/{id}\">Delete</a>";
                            }
                        ?>
                    </td>
                </tr>
            {/ingreds}
        </tbody>
    </table>
    
</div>