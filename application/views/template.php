<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{pagetitle}</title>
        <meta charset="utf-8">
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/default.css"/>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" id="main"> 
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button> 
                    <a class="navbar-brand" href="/"><img src="/assets/images/logo.png" alt="Starbucks"/></a>
                    <div class="navbar-collapse collapse navbar-responsive-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="/menu">Menu</a></li>
                            
                            <?php
                                $role = $this->session->userdata('userrole');
                                
                                if($role != "guest"){
                                    echo "<li><a href=\"/inventory\">Inventory</a></li>";
                                    echo "<li><a href=\"/recipe\">Recipe</a></li>";
                                    echo "<li><a href=\"/sales_order\">Orders</a></li>";
                                }
                            ?>
                            
                            <li><a href="/toggle">Toggle Role</a></li>
                            <li><a>Role: {userrole}</a></li>
                        </ul><!-- end nav -->
                    </div><!-- end myNavvar -->
                </div><!-- container -->
            </div><!-- end navbar-fixed-top -->
            <div class="row">
                {content}
            </div><!-- end bigContent -->
        </div><!-- end container -->
    </body>
</html>