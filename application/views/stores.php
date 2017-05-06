<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Kinduct Challenge Store Page</title>
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
                        <a class="navbar-brand" href="#">Kinduct Codeigniter Challenge</a>
                    </div>

                </div>
            </nav>
        </header>
        <div class="container">
            <section id="header-store-page">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Store Finder</h1>
                        <h4 class="text-center">Please Select a Country and a City</h4>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control" name="country" id="country">
                                        <option>Select Country</option>
                                        <?php foreach ($countries as $contry) { ?>
                                            <option value="<?php echo $contry->country_id; ?>"><?php echo $contry->country; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">City:</label>
                                    <select class="form-control" name="City" id="city" class="city" disabled="">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                        </div>
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
                                <th>Store</th>
                                <th>Inventory</th>
                                <th>Customers</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>Store 1</td>
                                <td>34 Title's</td>
                                <td><a href="#" class="btn btn-primary">Manage</a></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Store</th>
                                <th>Inventory</th>
                                <th>Customers</th>
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

        <!--Custom Ajax Operations and Javascript Functions-->
        <script type="text/javascript">

            //Countries and City Depedent dropdwon functionality
            $(document).ready(function () {
                $('#country').on('change', function () {
                    var country_id = $(this).val();
                    if (country_id == '') {
                        $('#city').prop('disabled', true);
                    } else {
                        $('#city').prop('disabled', false);
                        $.ajax({
                            url: "<?php echo base_url(); ?>/index.php/stores/get_cities",
                            type: 'POST',
                            data: {'country_id': country_id},
                            beforeSend: function () {
                                $("#city option:gt(0)").remove();
                                $('#city').find("option:eq(0)").html("Please wait..");
                            },
                            success: function (data) {
                                /*get response as json */
                                $('#city').find("option:eq(0)").html("Select City");
                                var obj = jQuery.parseJSON(data);
                                $(obj).each(function ()
                                {
                                    var option = $('<option />');
                                    option.attr('value', this.value).text(this.label);
                                    $('#city').append(option);
                                });
                                /*ends */
                            },
                            error: function () {
                                console.log('Error Occurred');
                            }

                        });
                    }
                });
            });

            // Store Dependent On City Value DropDown.
            $('#city').on('change', function () {
                var city_id = $(this).val();
                if (city_id == '') {
                    //anything we can perform or we can change it to !==
                } else {
                    console.log(city_id);
                    $.ajax({
                        url: "<?php echo base_url();?>/index.php/stores/get_stores",
                        type: 'POST',
                        data: {'city_id': city_id},
                        success: function (data) {
                            
                        }, error: function () {

                        }

                    });
                }
            });
        </script>
    </body>
</html>
