<!-- Custom fonts for this template-->
<link href="{{ asset("vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link href="{{ asset("style/sb-admin-2.min.css") }}" rel="stylesheet">
<link href="{{ asset("style/responsive.css") }}" rel="stylesheet">
<style>
    span.form-control{
        height: auto !important;
    }

    input[type=number] { 
        -moz-appearance: textfield;
        appearance: textfield;
        margin: 0; 
    }

    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }

    table td.middle, table.table tbody tr td{
        vertical-align: middle !important;
    }

    table.table thead tr th:nth-child(1)    , 
    table.table tbody tr td:nth-child(1), 
    table thead th{
        text-align: center;
        vertical-align: middle !important;
    }

    .w-100{
        width: 100% !important;
    }

    @media only screen and (min-width: 992px) {
        .w-lg-50{
            width: 50% !important;
        }

        .w-lg-auto{
            width: auto !important;
        }
    }
</style>