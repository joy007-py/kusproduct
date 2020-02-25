<html>
    <head>
        <title>
            product name
        </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/assets/css/pro.css">
    </head>
    <body>
        <!-- showing all product data -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-9 product-container">
                    <h5>Product Name</h5>

                    <?php if( !empty( $data ) ) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product name</th>
                                <th scope="col">Quantity in stock</th>
                                <th scope="col">Price per item</th>
                                <th scope="col">Datetime submitted</th>
                                <th scope="col">Total value number</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="data_body">
                            <?php foreach( $data as $value ) : ?>
                                <tr>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo $value['quantity_in_stock'] ?></td>
                                    <td><?php echo $value['price'] ?></td>
                                    <td><?php echo $value['created_at'] ?></td>
                                    <td><?php echo $value['total_val_num'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-id="<?php echo $value['id']?>" data-btn='e'>Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $value['id']?>" data-btn='d'>Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php else:  ?>
                        <?php echo '<p style="text-align:center">no product found</p>' ?>
                    <?php endif ?>
                </div>
                <div class="col-sm-3">
                    <p>Create New Product</p>
                    <hr>
                    <form id="_p_f" method="POST" action="/create" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Price</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-success" id="_c" data-edit="false">Add</button>
                        <button type="submit" class="btn btn-danger" id="_cancel" style="visibility: hidden;">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="/assets/js/dev.js" ></script>
</html>

