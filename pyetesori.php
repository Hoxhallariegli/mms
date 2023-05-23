<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <style>
        .tab-pane{
            height: 500px;
            background-color: gray;
            text-align: center;
            margin: auto;
        }

    </style>

</head>
<body>
<div id="rootwizard">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul>
                    <li><a href="#tab1" data-toggle="tab" class="my_link" id='1'>First</a></li>
                    <li><a href="#tab2" data-toggle="tab" class="my_link" id='2'>Second</a></li>
                    <li><a href="#tab3" data-toggle="tab" class="my_link" id='3'>Third</a></li>
                    <li><a href="#tab4" data-toggle="tab" class="my_link" id='4'>Fourth</a></li>
                    <li><a href="#tab5" data-toggle="tab" class="my_link" id='5'>Fifth</a></li>
                    <li><a href="#tab6" data-toggle="tab" class="my_link" id='6'>Sixth</a></li>
                    <li><a href="#tab7" data-toggle="tab" class="my_link" id='7'>Seventh</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane" id="tab1">

        </div>
        <div class="tab-pane" id="tab2">
            2
        </div>
        <div class="tab-pane" id="tab3">
            3
        </div>
        <div class="tab-pane" id="tab4">
            4
        </div>
        <div class="tab-pane" id="tab5">
            5
        </div>
        <div class="tab-pane" id="tab6">
            6
        </div>
        <div class="tab-pane" id="tab7">
            7
        </div>
        <ul class="pager wizard">
            <li class="previous first" style="display:none;"><a href="#">First</a></li>
            <li class="previous"><a href="#">Previous</a></li>
            <li class="next last" style="display:none;"><a href="#">Last</a></li>
            <li class="next"><a href="#">Next</a></li>
        </ul>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script src="my_js.js"></script>


</body>
</html>
