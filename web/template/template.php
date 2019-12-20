<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php page_title(); ?> | <?php site_name(); ?></title>
  <link href="data:image/gif;base64,R0lGODlhEAAQAPIFAIANDcQTE+4+Pv+8APitrf///wAAAAAAACH5BAUKAAUALAAAAAAQABAAAANHWLrcFcHJB8FscEQKIeteQIxEp1QAAAksyVLWI4xsK3AyScw1F8w64K6gEohIF9XK+NkQA0pQDKpIRUGgKjVV6cS4PudlnAAAOw==" rel="icon">
  <style>html{display:none}</style>
  <link href="/static/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <main>
    <article>
      <h2><?php page_title(); ?></h2>
      <?php page_content(); ?>
    </article>
  </main>
  
  <footer>
    <p><a href="/?page=sitemap">More generators (sitemap)</a></p>
    <p>Based on the <a href="https://perchance.org/wofocgen-testversion">WoF OC Generator</a> hosted on perchance.org.</p>
    <p>Written in PHP. <a href="https://git.sr.ht/~wychmire/wofocgen">Opensource</a> and available under the ISC license.</p>
    <p>Created by Wychmire - Hosted by Heroku</p>
    <p><?php site_version(); ?></p>
  </footer>

</body>

</html>