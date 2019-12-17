<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title><?php site_name(); ?></title>
  <link href="data:image/gif;base64,R0lGODlhEAAQAPIFAIANDcQTE+4+Pv+8APitrf///wAAAAAAACH5BAUKAAUALAAAAAAQABAAAANHWLrcFcHJB8FscEQKIeteQIxEp1QAAAksyVLWI4xsK3AyScw1F8w64K6gEohIF9XK+NkQA0pQDKpIRUGgKjVV6cS4PudlnAAAOw==" rel="icon">
  <style>body{display:none}</style>
  <link href="/static/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <main>
    <header>
      <h1><?php site_name(); ?></h1>
    </header>

    <article>
      <?php require 'includes/generator.php'; ?>
    </article>

    <footer>
      <p><a href="#" onclick="window.location.reload(false);">Reload</a> the page to generate a new character.<noscript> (Enable Javascript to use the link)</noscript></p>
      <p>Based on the <a href="https://perchance.org/wofocgen-testversion">WoF OC Generator</a> hosted on perchance.org.</p>
      <p>Written in PHP. <a href="https://git.sr.ht/~wychmire/wofocgen">Opensource</a> and available under the ISC license.</p>
      <p>Created by Wychmire - Hosted by Heroku</p>
      <p><?php site_version(); ?></p>
    </footer>
  </main>
</body>

</html>