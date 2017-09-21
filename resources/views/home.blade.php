<!DOCTYPE HTML>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Affinity Web Service</title>
  <meta name="description" content="A Web Service that delivers information on faculty engagement">
  <link rel="icon" href="//www.csun.edu/sites/default/themes/csun/favicon.ico" type="image/x-icon">
  <script src="//use.typekit.net/gfb2mjm.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">
  <link rel="stylesheet" href="{{ url('css/metaphor.css') }}">
  <link rel="stylesheet" href="{{ url('css/tomorrow.css.min') }}">
  <style>
    /* Style the tab */
    div.tab {
      overflow: hidden;
    }

    /* Style the buttons inside the tab */
    div.tab button {
      background-color: #f1f1f1;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    div.tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    div.tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      padding: 6px 12px;
      border: 2px solid #ccc;
      border-top: none;
    }

    .inactive {
      display: none;
    }

  </style>
</head>
<body>
<div class="section section--sm">
  <div class="container type--center">
    <h1 class="giga type--thin">Affinity Web Service</h1>
    <h3 class="h1 type--thin type--gray">Delivering Faculty Interests &amp; Badges</h3>
  </div>
</div>

<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <a class="header--sm" href="{{ url('/') }}"><strong>DOCUMENTATION</strong></a>
        <ul class="nav">
          <li class="nav__item"><a class="nav__link" href="#introduction">Introduction</a></li>
          <li class="nav__item"><a class="nav__link" href="#getting-started">Getting Started</a></li>
          <li class="nav__item"><a class="nav__link" href="#collections">Collections</a></li>
          <li class="nav__item"><a class="nav__link" href="#subcollections">Subcollections</a></li>
        </ul>
        <a class="header--sm" href="{{ url('/about/version-history') }}"><strong>Version History</strong></a>

      </div>

      <div class="col-md-9">
        <h2 id="introduction" class="type--header type--thin">Introduction</h2>
        <p>The Affinity web service gives information acknowledging and celebrating teaching interests and accomplishments and helps promote faculty community and networking. This information is derived from the Research and Graduate Studies and faculty submited information using <a href="">Scholarships</a>. The web service provides a gateway to access the information via a REST-ful API. The information is retrieved by creating a specific URI and giving values to filter the data. The information that is returned is a JSON object that contains a set of interest or badges attached to a particular member; the format of the JSON object is as follows:</p>

        <div class="tab">
          <button id="badges-btn" class="tablinks active">Badges</button>
          <button id="interests-btn" class="tablinks">Interests</button>
        </div>


        <div id="badges-content" class="tabcontent">
        <pre class="prettyprint"><code>{
  "success": "true",
  "status": 200,
  "api": "affinity",
  "version": "1.0",
  "collection": "badges",
  "count": 2,
  "badges": [
    {
      "name": "Probationary Faculty Grant",
      "issuer": "Faculty Development",
      "url_image": "https://cdn.metalab.csun.edu/badges/FacDev.png",
      "url_web": "http://www.csun.edu/undergraduate-studies/faculty-development/probationary-faculty-support-program",
      "award_date": "2014"
    },
    {
      "name": "Teaching Conference Grant",
      "issuer": "Faculty Development",
      "url_image": "https://cdn.metalab.csun.edu/badges/FacDev.png",
      "url_web": "http://www.csun.edu/undergraduate-studies/faculty-development/competition-attending-teaching-conference",
      "award_date": "Fall 2015"
    }
  ]
}</code></pre>
</div>
<div id="interests-content" class="tabcontent inactive">
<pre class="prettyprint"><code>{
  "success": "true",
  "status": 200,
  "api": "affinity",
  "version": "1.0",
  "collection": "interests",
  "count": 1,
  "interests": [
    {
      "title": "Sample Research Interest",
      "short_name": null,
      "parent_attribute_id": "research:11",
      "hierarchy": "Architectural Engineering",
      "count": 6
    }
  ]
}</code></pre>
</div>
        <br>
        <h2 id="getting-started" class="type--header type--thin">Getting Started</h2>
        <ol>
          <li><strong>GENERATE THE URI:</strong> Find the usage that fits your need. Browse through subcollections, instances and query types to help you craft your URI.</li>
          <li><strong>PROVIDE THE DATA:</strong> Use the URI to query your data. See the Usage Example session.</li>
          <li><strong>SHOW THE RESULTS</strong></li>
        </ol>
        <p>Loop through the data to display its information. See the Usage Example session.</p>
        <br>
        <h2 id="collections" class="type--header type--thin">Collections</h2>
        <strong>All Badges Listing</strong>
        <ul>
          <li><a href="{{url('/1.0/badges')}}">{{url('api/1.0/badges')}}</a></li>
        </ul>
        <strong>All Interest Listing</strong>
        <ul>
          <li><a href="{{url('api/1.0/interests')}}">{{url('api/1.0/interests')}}</a></li>
          <li><a href="{{url('api/1.0/interests/personal')}}">{{url('api/1.0/interests/personal')}}</a></li>
          <li><a href="{{url('api/1.0/interests/research')}}">{{url('api/1.0/interests/research')}}</a></li>
          <li><a href="{{url('api/1.0/interests/academic')}}">{{url('api/1.0/interests/academic')}}</a></li>
        </ul>
        <br>
        <h2 id="subcollections" class="type--header type--thin">Subcollections</h2>
        <strong>Specified person's Badges</strong>
        <ul>
          <li><a href="{{url('api/1.0/badges?email='.$email['alexandra'])}}">{{url('api/1.0/badges?email='.$email['alexandra'])}}</a></li>
        </ul>
        <strong>Specified person's Interests</strong>
        <ul>
          <li><a href="{{url('api/1.0/interests?email='.$email['steve'])}}">{{url('api/1.0/interests?email='.$email['steve'])}}</a></li>
          <li><a href="{{url('api/1.0/interests/personal?email='.$email['steve'])}}">{{url('api/1.0/interests/personal?email='.$email['steve'])}}</a></li>
          <li><a href="{{url('api/1.0/interests/research?email='.$email['steve'])}}">{{url('api/1.0/interests/research?email='.$email['steve'])}}</a></li>
          <li><a href="{{url('api/1.0/interests/academic?email='.$email['steve'])}}">{{url('api/1.0/interests/academic?email='.$email['steve'])}}</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="metalab-footer">
  <div class="metalab-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="metalab-branding">
            <img src="//www.csun.edu/faculty/imgs/meta-logo-horz.png" alt="CSUN META Lab Logo">
            <ul class="list--unstyled">
              <li><a href="http://metalab.csun.edu">metalab.csun.edu</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <ul class="list--unstyled metalab-tagline">
            <li>Explore. Learn. Go Beyond.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ url('js/metaphor.js') }}"></script>
<script src="{{ url('js/run_prettify.js') }}"></script>
<script>
  $(document).ready(function(){
      $("#badges-btn").click(function(){
        $("#interests-btn").removeClass("active");
        $("#badges-btn").addClass("active");
        $("#interests-content").addClass("inactive");
        $("#badges-content").removeClass("inactive");
      });

      $("#interests-btn").click(function(){
        $("#badges-btn").removeClass("active");
        $("#interests-btn").addClass("active");
        $("#badges-content").addClass("inactive");
        $("#interests-content").removeClass("inactive");
      });
  });
</script>
<!--
  __  __   ___   _____     _
 |  \/  | | __| |_   _|   /_\       Explore Learn Go Beyond
 | |\/| | | _|    | |    / _ \      https://www.metalab.csun.edu/
 |_|  |_| |___|   |_|   /_/ \_\
    _       _        _     ___
  _| |_    | |      /_\   | _ )
 |_   _|   | |__   / _ \  | _ \
   |_|     |____| /_/ \_\ |___/
-->
</body>
</html>
