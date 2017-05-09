<!DOCTYPE html>
<!--
Customer View 
Rishabh Aggarwal rishabh.aggarwal@dal.ca
-->
<html>
    <head>
        <title>Kinduct Challenge Store Page - Store Customers Page</title>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assests/bootstrap-3.3.7-dist//css/bootstrap.min.css" />
        <!-- Optional theme -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assests/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            th{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Kinduct Codeigniter Challenge Rishabh Aggarwal</a>
                    </div>

                </div>
            </nav>
        </header>
        <div class="container">
            <section id="header-store-page">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Store Customers</h1>
                        <?php
                        $store_id = '';
                        $address_id = '';
                        foreach ($city_country as $c_c) {
                            ?>
                            <p class="text-center"><b>Store ID: </b><?php
                                echo $store_id = $c_c->store_id;
                                $address_id = $c_c->address_id;
                                ?> <b>City: </b><?php echo $c_c->city; ?> <b>Country: </b><?php echo $c_c->country; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </section> 

        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12">

                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="text-center">
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Active</th>
                                <th>Films Checked Out</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data">



                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td>
                                    <input type="hidden" name="storeid" id="newstoreid" value="<?php echo $store_id; ?>">
                                    <input type="hidden" name="storeid" id="newaddressid" value="<?php echo $address_id; ?>">
                                    <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control">
                                </td>
                                <td><input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control"></td>
                                <td><select class="form-control" name="customer_active" id="new-active">
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </td>
                                <td>N/A</td>
                                <td class="text-center"><button class="btn btn-primary" onclick="add_customer(<?php echo $store_id; ?>)"><i class="glyphicon glyphicon-plus-sign"></i></button></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>assests/jquery/jquery-3.2.1.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() ?>assests/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

        <!--UnderScore-->
        <script src="<?php echo base_url(); ?>assests/underscore/underscore-min.js"></script>

        <!--Custom Ajax Operations and Javascript Functions-->
        <script type="text/javascript">
                                    var save_method; //for save method string
                                    var table;
                                    
                                    // Edit Customer  Ajax request
                                    function edit_customer(id, customer_id)
                                    {
                                        save_method = 'update';
                                        $('#customer-form')[0].reset(); // reset form on modals
                                        $('#modal_form').modal('show');
                                        //Ajax Load data from ajax
                                        $.ajax({
                                            url: "<?php echo site_url('index.php/stores/get_customer'); ?>/" + id + "/" + customer_id,
                                            type: "GET",
                                            dataType: "JSON",
                                            success: function (data)
                                            {

                                                $('[name="customer_id"]').val(data.customer_id);
                                                $('[name="customer_firstname"]').val(data.first_name);
                                                $('[name="customer_lastname"]').val(data.last_name);
                                                $('[name="customer_active"]').val(data.active);
                                                //Making it Customer Active or Not for Update
                                                var num = data.active;
                                                $("#active-user select.select option[value=" + num + "]").prop("selected", true);
                                                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                                                $('.modal-title').text('Edit Customer'); // Set title to Bootstrap modal title

                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {
                                                alert('Somethin Went Wrong........');
                                            }
                                        });
                                    }



                                    function save()
                                    {
                                        var url;
                                        if (save_method == 'add')
                                        {
                                            url = "<?php echo site_url('index.php/stores/customer_add') ?>";
                                        } else
                                        {
                                            url = "<?php echo site_url('index.php/stores/customer_update') ?>";
                                        }

                                        // ajax adding data to database
                                        $.ajax({
                                            url: url,
                                            type: "POST",
                                            data: $('#customer-form').serialize(),
                                            dataType: "JSON",
                                            success: function (data)
                                            {
                                                //if success close modal and reload ajax table
                                                $('#modal_form').modal('hide');
                                                location.reload(); // for reload a page
                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {
                                                alert('Error adding / update data');
                                            }
                                        });
                                    }
                                    // Delete Customer
                                    function delete_customer(id)
                                    {
                                        if (confirm('Are you sure delete this customer?'))
                                        {
                                            // ajax delete data from database
                                            $.ajax({
                                                url: "<?php echo site_url('index.php/stores/delete_customer') ?>/" + id,
                                                type: "POST",
                                                dataType: "JSON",
                                                success: function (data)
                                                {

                                                    location.reload();
                                                },
                                                error: function (jqXHR, textStatus, errorThrown)
                                                {
                                                    alert('Error deleting data');
                                                }
                                            });
                                        }
                                    }
                                    
                                    //Add New Customer
                                    function add_customer() {
                                        $firstname = $('#firstname').val();
                                        $lastname = $('#lastname').val();
                                        $active = $('#new-active').val();
                                        $storeid = $('#newstoreid').val();
                                        $addressid = $('#newaddressid').val();
                                        if ($firstname === '' || $lastname === 'null') {
                                            alert('You Must Enter Last name or First Name to save a new Customer');
                                        }
                                        $.ajax({
                                            url: "<?php echo site_url('index.php/stores/add_customer'); ?>",
                                            data:
                                                    {
                                                        'firstname': $firstname,
                                                        'lastname': $lastname,
                                                        'active': $active,
                                                        'store_id': $storeid,
                                                        'addressid': $addressid
                                                    },
                                            type: 'POST',
                                            success: function (data) {
                                                location.reload();
                                            }
                                        });
                                    }

                                    // Underscore and formating customer Result Start From here
                                    var cust = <?php echo json_encode($customers); ?>;
                                    var store_id = <?php echo $store_id; ?>;
                                    console.log(store_id);
                                    // Underscore Starts
                                    $(document).ready(function () {
                                        //Var Customer Output

                                        //Sorting Mysql Result and Using Undersocre to Filter it out(Underscore Starts From here)
                                        var output = '';

                                        //Underscore Group By customer_id
                                        var customer = _.groupBy(cust, function (value) {
                                            return value.customer_id;
                                            console.log(value.customer_id);
                                        });
                                        //Mapping and pluck value for producing new array to combine movie in one json object based on Title
                                        var mapData = _.map(customer, function (group) {
                                            return {
                                                first_name: group[0].first_name,
                                                last_name: group[0].last_name,
                                                active: group[0].active,
                                                customer_id: group[0].customer_id,
                                                title: _.pluck(group, 'title')
                                            }
                                        });
                                        // Was not able to Sort Title but was able to sort by Last name
                                        var data = _.sortBy(mapData, function (num) {
                                            return num.last_name;
                                           
                                        });
                                        //console.log(JSON.stringify(check,null,2));
                                        for (var i = 0; i <= data.length; i++) {
                                            try {
                                                output += '<tr class = "text-center">' + '<td>'
                                                        + data[i].last_name + '</td>' +
                                                        '<td>' + data[i].first_name + '</td><td>';
                                                if (data[i].active === '1') {
                                                    output += '<span class="glyphicon glyphicon-ok"></span>';
                                                } else {
                                                    output += '<span class="glyphicon glyphicon-remove"></span>';
                                                }
                                                output += '</td>' +
                                                        '<td>';
                                                for (j = 0; j <= data[i].title.length - 1; j++) {
                                                    if (data[i].title[j].lenght !== 0) {
                                                        output += '<p>' + data[i].title[j] + '</p>';
                                                    } else {
                                                        output += '<p>N/A</p>';
                                                    }

                                                    //output += '<p>' + data[i].title[j] + '</p>';
                                                }
                                                output += '</td>' +
                                                        '<td>' + '<button class="btn btn-warning" onclick="edit_customer(' + data[i].customer_id + ',' + store_id + ')"><i class ="glyphicon glyphicon-pencil"></i></button>'
                                                        + '<button class="btn btn-danger" onclick="delete_customer(' + data[i].customer_id + ')"><i class="glyphicon glyphicon-trash"></i></button>' +
                                                        '</td>';
                                                '</tr>';
                                            } catch (e) {

                                            }

                                        }
                                        var update = document.getElementById('data');
                                        update.innerHTML = output;
                                    });
        </script>


        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Customer Form</h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="customer-form" class="form-horizontal">
                            <input type="hidden" value="" name="customer_id"/>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">First Name</label>
                                    <div class="col-md-9">
                                        <input name="customer_firstname" placeholder="First Name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Last Name</label>
                                    <div class="col-md-9">
                                        <input name="customer_lastname" placeholder="Last Name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group" id="active-user">
                                    <label class="control-label col-md-3">Customer Active</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="customer_active">
                                            <option value="1">True</option>
                                            <option value="0">False</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->
    </body>
</html>
