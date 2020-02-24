<html>
    <head>
        <title>
            product form
        </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        ?>

        <!-- showing all product data -->
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Total Value</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $data as $value ) : ?>
                        <tr>
                            <th scope="row"><?php echo $value['id'] ?></th>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['in_stock'] ?></td>
                            <td><?php echo $value['price'] ?></td>
                            <td><?php echo $value['created_at'] ?></td>
                            <td><?php echo $value['total_val_num'] ?></td>
                            <td>
                            <button type="button" class="btn btn-outline-primary btn-sm">Edit</button>
                            <button type="button" class="btn btn-outline-danger btn-sm">Delete</button>

                            </td>
                        </tr>
                    <?php endforeach ?>
                    
                </tbody>
            </table>
        </div>

        <!-- product create from -->
        
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <hr>
                    <h5>Create New Product</h5>
                    <form id="_p_f" method="POST" action="/create" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" id="_name" aria-describedby="nameHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Price</label>
                            <input type="number" class="form-control" name="price" id="_price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="_quantity">
                        </div>
                        <button type="submit" class="btn btn-primary" id="_c">Create</button>
                    </form>
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript" src="/assets/js/dev.js" ></script>
</html>

