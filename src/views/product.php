<html>
    <head>
        <title>
            product name
        </title>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="/assets/css/util.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/inventry_style.css">
    <!--===============================================================================================-->
    </head>
    <body>
        
        <div class="limiter">
           
		<div class="container-table100">
            
			<div class="wrap-table100 col-sm-9">

                <h5 class="text-center mb-4">List of Products</h5>
				<div class="table100 ver1 zm-b-110">
					<table data-vertable="ver1">
						<thead>
							<tr class="row100 head">
								<th class="column100 column1" data-column="column1">Product Name</th>
								<th class="column100 column2" data-column="column2">Quantity in Stock</th>
								<th class="column100 column3" data-column="column3">Price per Item</th>
								<th class="column100 column4" data-column="column4">Datetime Submitted</th>
								<th class="column100 column5" data-column="column5">Total Value Number</th>
                                <th class="column100 column7" data-column="column7">Manage</th>
							</tr>
						</thead>
						<tbody id="data_body">
                            <?php foreach( $data as $value ) : ?>
							<tr class="row100">
								<td class="column100 column1"><?php echo $value['name'] ?></td>
								<td class="column100 column2"><?php echo $value['quantity_in_stock'] ?></td>
								<td class="column100 column3"><?php echo $value['price'] ?></td>
								<td class="column100 column4"><?php echo $value['created_at'] ?></td>
								<td class="column100 column5"><?php echo $value['total_val_num'] ?></td>
								<td class="column100 column7">
                                    <a href="#" class="ed">
                                        <i class="fa fa-pencil" data-id="<?php echo $value['id']?>" data-btn='e'></i>
                                    </a>
                                    <a href="#" class="del">
                                        <i class="fa fa-trash" data-id="<?php echo $value['id']?>" data-btn='d'></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <?php endforeach ?>
						</tbody>
					</table>
				</div>
            </div>

            <div class="col-sm-3 p-0">
                <h5 class="mb-4">Create New Product</h5>
                <div class="vio_bg">
                   
                    
                    <form id="_p_f" method="POST" action="/create" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Price</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-success ad_btn" id="_c" data-edit="false">Add</button>
                        <button type="submit" class="btn btn-danger" id="_cancel" style="visibility: hidden;">Cancel</button>
                    </form>
                </div>
            </div>
	</div>
    </body>
    <script type="text/javascript" src="/assets/js/dev.js" ></script>
</html>

