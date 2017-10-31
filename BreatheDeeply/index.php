<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Welcome</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../Capstone/css/landingpage.css">
  <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../Capstone/js/landingpage.js"></script>
  <script src="../Capstone/js/scroll.js"></script>


</head>
<body>
<section class="intro">
  <div class="inner">
    <div class="content title">
      <h1>Breathe Deeply</h1>
      <a class="btn" href="products.php">Let's Start</a>
    </div>
  </div>
</section>
<div id="back-top">
  <div class="arrow"></div>
  <div class="stick"></div>
</div>

<section id="what-is">
  <div class="container">
    <h3>What is <span class="highlight"><b>OUR PROJECT</b></span>?</h3>
    <p>
        In daily life, it's normal for people to ignore air quality and get harmed by air pollution.<br>
        In Brisbane, our project help you know everyday's air condition including air quality and weather.<br>
        We provide you reasonable suggestions on out-door activities to prevent you from harm of air pollution.<br>
    </p>
  </div>
</section>

<hr class="clearfix" width="80%">

<section id="showcase1">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="showcase1-left">
          <img src="https://dummyimage.com/500x350/00c4ff/fff.png&text=air+quality">
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="showcase1-right">
          <h1>Monitor air quality in Brisbane</h1>
          <p>
              let the mourners come. Let aeroplanes circle moaning overhead Scribbling on the sky the message He Is Dead. Put crepe bows round the white necks of public doves,
              Let the traffic policemen wear black cotton gloves. He was my North, my South, my East and West.
              My working week and my Sunday rest, My noon, my midnight, my talk, my song; I thought that love would last forever; I was wrong.
              The stars are not wanted now: put out every one; Pack up the moon and dismantle the sun; Pour away the ocean and sweep up the wood; For nothing now can ever come to any good.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<hr class="clearfix" width="80%">
<section id="showcase2">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="showcase2-left">
          <h1>Weather Information</h1>
          <p>
              let the mourners come. Let aeroplanes circle moaning overhead Scribbling on the sky the message He Is Dead. Put crepe bows round the white necks of public doves,
              Let the traffic policemen wear black cotton gloves. He was my North, my South, my East and West.
              My working week and my Sunday rest, My noon, my midnight, my talk, my song; I thought that love would last forever; I was wrong.
              The stars are not wanted now: put out every one; Pack up the moon and dismantle the sun; Pour away the ocean and sweep up the wood; For nothing now can ever come to any good.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="showcase2-right">
          <img src="https://dummyimage.com/500x350/87e1e6/fff.png&text=weather">
        </div>
      </div>
    </div>
  </div>
</section>

<hr class="clearfix" width="80%">

<section id="showcase3">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="showcase3-left">
          <img src="https://dummyimage.com/500x350/97a9ed/fff.png&text=Recommendation">
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="showcase3-right">
          <h1>Reasonable Recommendation</h1>
          <p>
              let the mourners come. Let aeroplanes circle moaning overhead Scribbling on the sky the message He Is Dead. Put crepe bows round the white necks of public doves,
              Let the traffic policemen wear black cotton gloves. He was my North, my South, my East and West.
              My working week and my Sunday rest, My noon, my midnight, my talk, my song; I thought that love would last forever; I was wrong.
              The stars are not wanted now: put out every one; Pack up the moon and dismantle the sun; Pour away the ocean and sweep up the wood; For nothing now can ever come to any good.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<hr class="bot-line" width="100%">
<script>
    window.sr = ScrollReveal();
    sr.reveal('.showcase1-left',{
        duration:2000,
        origin:'top',
        distance:'200px'
    });
    sr.reveal('.showcase1-right',{
        duration:2000,
        origin:'right',
        distance:'300px'
    });
    sr.reveal('.showcase2-left',{
        duration:2000,
        origin:'left',
        distance:'300px'
    });
    sr.reveal('.showcase2-right',{
        duration:2000,
        origin:'right',
        distance:'300px'
    });
    sr.reveal('.showcase3-left',{
        duration:2000,
        origin:'right',
        distance:'1000px'
    });
    sr.reveal('.showcase3-right',{
        duration:2000,
        origin:'left',
        distance:'1000px'
    });
    sr.reveal('#what-is div',{
        duration:2000,
        origin:'bottom'
    });
</script>
</body>
</html>
