<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">

  <title>PIN Gen</title>

  <script type="module">
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');
  </script>

  <link rel="stylesheet" href="css/app.css">

  <meta name="description" content="Page description">
  <meta property="og:title" content="PIN Number Gen">
  <meta property="og:description" content="Generates a PIN Number">
  <meta property="og:image" content="https://www.mywebsite.com/image.jpg">
  <meta property="og:image:alt" content="Image description">
  <meta property="og:locale" content="en_GB">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <meta property="og:url" content="https://www.mywebsite.com/page">
  <link rel="canonical" href="https://www.mywebsite.com/page">

  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <meta name="theme-color" content="#FF00FF">
</head>

<body>
  <div id="app">
    <pin-number csrf_token="{{ csrf_token() }}"></pin-number>
  </div>  

  <!-- Content -->
  <script src="js/app.js" type="module"></script>
</body>
</html>