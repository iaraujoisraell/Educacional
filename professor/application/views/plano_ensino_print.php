
 <style type="text/css">


        *{
            margin: 0px;
            padding: 0px;
            font-family: Fineness Regular;
        }
        a:link { text-decoration:none;  }
        a:visited { text-decoration:none;  }
        a:hover { text-decoration:none;  }
        a:active { text-decoration:none;  }


        /* > Para o input */
        .input-search{
            width: 300px;
            border: 1px solid #CCC;
            padding:5px 14px;
            font-size:12px;
            margin:10px 0;
            float:left;

            -webkit-border-radius:15px;
            -moz-border-radius:15px;
            -ms-border-radius:15px;
            -o-border-radius:15px;
            border-radius:15px;
        }
        .input-search::-webkit-input-placeholder{ font-style:italic }
        .input-search:-moz-placeholder			{ font-style:italic }
        .input-search:-ms-input-placeholder		{ font-style:italic }





    </style>
    <style>
    table {
    border-collapse: collapse;
    text-align: justify;
}

 th, tr {
    border: 1px solid black;
    text-align: justify;
}

td{
    text-align: justify;
}
</style>
<?php 
//$this->load->view('header'); //let's assume that we already have 'header' view file
?>
<?php echo $the_content; ?>
<?php 
//$this->load->view('footer'); //let's assume that we already have 'footer' view file
?>