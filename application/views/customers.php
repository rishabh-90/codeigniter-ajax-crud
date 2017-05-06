<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Kinduct Challenge Store Page - Store Customers Page</title>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
                        <h1 class="text-center">Store Customers</h1>
                        <p class="text-center"><b>Store ID: </b>23 <b>City: </b>XYZ <b>Country: </b>xyz</p>
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
                        <tbody>
                            <tr class="text-center">
                                <td>Aggarwal</td>
                                <td>Rishabh</td>
                                <td><span class="glyphicon glyphicon-ok"></span></td>
                                <td>
                                    <ul>
                                        <li>Title 1</li>
                                    </ul>
                                </td>
                                <td>
                                    <button class="btn btn-warning"><i class ="glyphicon glyphicon-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                             <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Active</th>
                                <th>Films Checked Out</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
