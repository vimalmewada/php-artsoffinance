<!doctype html>
<html lang="en">

<head>
    <title><?= htmlspecialchars($meta['title']) ?></title>
    <meta charset="UTF-8">
    <base href="/">
    <meta name="description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta['keywords']) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph for Social Media -->
    <meta property="og:title" content="<?= htmlspecialchars($meta['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="assets/img/logo1.png">
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@8.4.7/swiper-bundle.min.css" /> -->

    <link rel="stylesheet" href="assets/css/plugins/fontawesome-5.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/unicons.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=6fd6f641a783f' async='true'></script>
</head>

<body>

    <?php
if ($page == 'home' || $_SERVER['REQUEST_URI'] == '/') {
  include('views/partials/tradingview.php');
}
?>

    <?php include('views/partials/nav_bar.php') ?>