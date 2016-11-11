<!DOCTYPE html>
<html ng-app>
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      
    <title>bookmarks</title>
     
    <!-- include material design CSS -->
    <link rel="stylesheet" href="public/css/materialize.css" />
     
    <!-- include material design icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
     
</head>
<body>
<?php require $view ?>
    <input type="text" ng-model="search">
<p>Du suchst gerade nach: {{search}}</p>
    
<!-- page content and controls will be here -->
 
<!-- include jquery -->
<script type="text/javascript" src="publics/js/jquery.min.js"></script>
 
<!-- material design js -->
<script src="public/js/materialize.min.js"></script>
 
<!-- include angular js -->
<script src="public/js/angular.js"></script>
 
<script>
// angular js codes will be here
 
// jquery codes will be here
</script>
 
</body>
</html>