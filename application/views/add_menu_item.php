<h2>Menu Maintenance</h2>
{error_messages}

<form action="/newmenu/save" method="post" enctype="multipart/form-data">
    <hr/>
    <!--
    <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" name="name" class="form-control" id="menu-item-name" placeholder="Enter item name here">
    </div><br/>
    
    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" id="menu-item-description" name="description" ></textarea>
    </div><br/>
    
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" class="form-control" id="menu-item-price" placeholder="1.00">
    </div><br/>
    
    <div class="form-group">
        <label for="picture">Picture</label>
        <input type="file" name="picture" class="form-control" id="menu-item-picture">
    </div><br/>
    -->
    
    {fname}
    {fdescription}
    {fprice}
    <div class="form-group">
        <label for="picture">Picture</label>
        <input type="file" id="picture" name="picture"/>
    </div>
    
    
    <div>
        {zsubmit}
        <a class="btn btn-default" href="/menu/cancel">Cancel</a>
    </div>
</form>
