<?php 
$pages = ['home','student','prof','about','register','login','admin'];
if(isset($_GET['page'])){
    $page = $_GET['page'];
    if(in_array($page,$pages))
        header('location:view/'.$page);
    else   
        header('location:view/includes/404');
}else
    header('location:view/home');



