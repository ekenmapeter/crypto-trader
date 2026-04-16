<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')


  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <link rel="stylesheet" type="text/css" href="css/swiper.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalaert2/6.4.2/sweetalert2.min.css">

  <title>{{ $title }} | Coinmexer</title>

      <meta name="keywords" content="Crypto Seller, Digital Currency, Bitcoin, Ethereum, Cryptocurrency, Online Payments, Virtual Currency, Secure Transactions.">
      <meta name="description" content="Buy and sell cryptocurrencies and e-gift cards safely and conveniently with our platform. Join us today">
      
      <!-- Facebook Meta Tags -->
      <meta property="og:title" content="{{ $title }}">
      <meta property="og:description" content="Buy and sell cryptocurrencies and e-gift cards safely and conveniently with our platform. Join us today">
      <meta property="og:image" content="https://www.coinmexer.com/favicon.png">
      <meta property="og:url" content="https://www.coinmexer.com">
      <meta property="og:type" content="website">
      
      <!-- Instagram Meta Tags -->
      <meta property="instagram:title" content="{{ $title }}">
      <meta property="instagram:description" content="Buy and sell cryptocurrencies and e-gift cards safely and conveniently with our platform. Join us today">
      <meta property="instagram:image" content="https://www.coinmexer.com/favicon.png">
      <meta property="instagram:url" content="https://www.coinmexer.com">
      <meta property="instagram:app_id" content="">
      
      <!-- Twitter Meta Tags -->
      <meta name="twitter:card" content="summary">
      <meta name="twitter:title" content="{{ $title }}">
      <meta name="twitter:description" content="Buy and sell cryptocurrencies and e-gift cards safely and conveniently with our platform. Join us today">
      <meta name="twitter:image" content="https://www.coinmexer.com/favicon.png">

      <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

<!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <script src="https://cdn.tailwindcss.com"></script>
    
<!-- SweetAlert -->
<script src="//code.tidio.co/jfykhrimops4yj1yvrvvmvuiy6zugdcl.js" async></script>
</head>
<body class="bg-gradient-to-b from-gray-900 via-purple-900 to-violet-600">

@include('sweetalert::alert')




