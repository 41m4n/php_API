<!DOCTYPE HTML>
<html>

<head>
    <title>Senzo Warranty System</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- custom css -->
    <style>
    .m-r-1em {
        margin-right: 1em;
    }

    .m-b-1em {
        margin-bottom: 1em;
    }

    .m-l-1em {
        margin-left: 1em;
    }

    .mt0 {
        margin-top: 0;
    }
    </style>
</head>

<body>
    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Senzo Customer</h1>
        </div>



        <button class='btn btn-primary m-b-1em' data-toggle='modal' data-target='#exampleModal'>Add Customer</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong>
                            <h5 class="modal-title" id="exampleModalLabel">Add Senzo Customer</h5>
                        </strong>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="addCustForm"
                            method="post">
                            <table class='table table-hover table-responsive table-bordered'>
                                <tr>
                                    <td>Customer Name</td>
                                    <td><input type='text' required="true" name='custName' class='form-control' /></td>
                                </tr>
                                <tr>
                                    <td>Customer Email</td>
                                    <td><input type="text" required="true" name='custEmail'
                                            class='form-control'></textarea></td>
                                </tr>
                                <tr>
                                    <td>Customer Phone</td>
                                    <td><input type='text' required="true" name='custPhone' class='form-control' /></td>
                                </tr>
                                <tr>
                                    <td>Customer Address</td>
                                    <td><input type='text' required="true" name='custAddress' class='form-control' />
                                    </td>
                                </tr>
                                <tr>

                                </tr>
                            </table>

                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        <input type='submit' name="addCust" value='Save' class='btn btn-primary' />
                        </form>
                    </div>

                </div>
            </div>

            <script>
            $(document).ready(function() {
                outputData();

                function outputData() {
                    $.ajax({
                        url: "output.php",
                        success: function(data) {
                            $('tbody').html(data)
                        }

                    });
                }
            });
            </script>

        </div>

    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- <script type='text/javascript'>
    // confirm record deletion
    function delete_user(custID) {

        var answer = confirm('Are you sure to delete this user?');
        if (answer) {
            // if user clicked ok, 
            // pass the id to delete.php and execute the delete query
            window.location = 'deleteCustomer.php?custID=' + custID;
        }
    }
    </script> -->

</body>

</html>

<script>
// will run if create product form was submitted
$(document).on('submit', '#create-product-form', function() {
    var form_data = JSON.stringify($(this).serializeObject());

    // submit form data to api
    $.ajax({
        url: "http://localhost/WarrantySystem1/api/customer/addCust.php",
        type: "POST",
        contentType: 'application/json',
        data: form_data,
        success: function(result) {
            // product was created, go back to products list
            //showProducts();
        },
        error: function(xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
        }
    });

    return false;
});
</script>