<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title><?= isset($title) ? $title : 'CIshop' ?> </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link href="/assets/libs/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/assets/libs/fontawesome-free-5.11.2-web/css/all.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/assets/css/app.css">
  </head>
  <body>
    <!-- Navbar -->
   <?php $this->load->view('layouts/_navbar'); ?>
   <!-- Endnavbar -->

<!-- Content -->
<?php $this->load->view($page); ?>
<!-- End Content -->

<script src="/assets/libs/jQuery/jquery-3.4.1.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/libs/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
<script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/assets/libs/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>