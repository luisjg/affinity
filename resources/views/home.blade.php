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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">
  <link rel="stylesheet" href="https://cdn.metalab.csun.edu/metaphor/css/metaphor.css">
  <link rel="stylesheet" href="css/tomorrow.css.min">
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
        <p class="header--sm"><strong>Documentation</strong></p>
        <ul class="nav">
          <li class="nav__item"><a class="nav__link" href="#introduction">Introduction</a></li>
          <li class="nav__item"><a class="nav__link" href="#getting-started">Getting Started</a></li>
          <li class="nav__item"><a class="nav__link" href="#collections">Collections</a></li>
          <li class="nav__item"><a class="nav__link" href="#subcollections">Subcollections</a></li>
          <li class="nav__item"><a class="nav__link" href="#instances">Instances</a></li>
          <li class="nav__item"><a class="nav__link" href="#query">Query</a></li>
        </ul>
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
  "version": "affinity-1.0",
  "status": 200,
  "success": "true",
  "type": "badges",
  "count": 2,
  "badges": [
    {
      "id": 319,
      "badge_name": "Probationary Faculty Grant",
      "award_date": "2014",
      "badge_info": {
        "name": "Probationary Faculty Grant",
        "issuer": "Faculty Development",
        "url_image": "https://cdn.metalab.csun.edu/badges/FacDev.png",
        "url_web": "http://www.csun.edu/undergraduate-studies/faculty-development/probationary-faculty-support-program"
      }
    },
    {
      "id": 396,
      "badge_name": "Teaching Conference Grant",
      "award_date": "Fall 2015",
      "badge_info": {
        "name": "Teaching Conference Grant",
        "issuer": "Faculty Development",
        "url_image": "https://cdn.metalab.csun.edu/badges/FacDev.png",
        "url_web": "http://www.csun.edu/undergraduate-studies/faculty-development/competition-attending-teaching-conference"
      }
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
  "count": "1",
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
        {{--<h3 class="type--thin">The collection URI allows the consumer to obtain a list of interest or badges that are part of the entire data set.</h3>--}}
        <strong>All Interest Listing</strong>
        <ul>
          <li><a href="{{url('1.0/interests')}}">{{url('1.0/interests')}}</a></li>
          <li><a href="{{url('1.0/interests/personal')}}">{{url('1.0/interests/personal')}}</a></li>
          <li><a href="{{url('1.0/interests/research')}}">{{url('1.0/interests/research')}}</a></li>
          <li><a href="{{url('1.0/interests/teaching')}}">{{url('1.0/interests/teaching')}}</a></li>
        </ul>
        <strong>All Badges Listing</strong>
        <ul>
          <li><a href="{{url('/1.0/badges')}}">{{url('api/1.0/badge')}}</a></li>
        </ul>
        <br>
        <h2 id="subcollections" class="type--header type--thin">Subcollections</h2>
        {{--<h3 class="type--thin">The subcollection URI allows the consumer to obtain a list of interestthat are part of a specified data set.</h3>--}}
        {{--<strong>Interest Listing</strong>--}}
        {{--<ul>--}}
          {{--<li><a href="{{url('api/interests/research')}}">{{url('api/interests/research')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/teaching')}}">{{url('api/interests/teaching')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/personal')}}">{{url('api/interests/personal')}}</a></li>--}}
        {{--</ul>--}}
        {{--<strong>Interest Listing with Attached Members</strong>--}}
        {{--<ul>--}}
          {{--<li><a href="{{url('api/interests/members')}}">{{url('api/interests/members')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/research/members')}}">{{url('api/interests/research/members')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/teaching/members')}}">{{url('api/interests/teaching/members')}}</a></li>--}}
{{--          <li><a href="{{url('api/interests/personal/members')}}">{{url('api/interests/personal/members')}}</a></li>--}}
        {{--</ul>--}}
        {{--<strong>Interest Listing with Attached Scholarship Projects</strong>--}}
        {{--<ul>--}}
          {{--<li><a href="{{url('api/interests/projects')}}">{{url('api/interests/projects')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/research/projects')}}">{{url('api/interests/research/projects')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/teaching/projects')}}">{{url('api/interests/teaching/projects')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/personal/projects')}}">{{url('api/interests/personal/projects')}}</a></li>--}}
        {{--</ul>--}}
        {{--<br>--}}
        {{--<h2 id="instances" class="type--header type--thin">Instances</h2>--}}
        {{--<h3 class="type--thin">The instance URI allows the consumer to obtain information about a single interest or a single badge.</h3>--}}
        {{--<strong>Single Listing</strong>--}}
        {{--<ul>--}}
          {{--<li><a href="{{url('api/interests/research:1')}}">{{url('api/interests/research:1')}}</a></li>--}}
          {{--<li><a href="{{url('api/badges/badges:1')}}">{{url('api/interests/badges:1')}}</a></li>--}}

        {{--</ul>--}}
        {{--<h2 id="query" class="type--header type--thin">Query</h2>--}}
        {{--<h3 class="type--thin">The query URI allows a consumer to obtain a list of interest or badges that relate to a specified member.</h3>--}}
        {{--<strong>Specified Member's Interest</strong>--}}
        {{--<ul>--}}
          {{--<li><a href="{{url('api/interests/members?email=steven.fitzgerald@csun.edu')}}">{{url('api/interests/members?email=steven.fitzgerald@csun.edu')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/research/members?email=steven.fitzgerald@csun.edu')}}">{{url('api/interests/research/members?email=steven.fitzgerald@csun.edu')}}</a></li>--}}
          {{--<li><a href="{{url('api/interests/teaching/members?email=steven.fitzgerald@csun.edu')}}">{{url('api/interests/teaching/members?email=steven.fitzgerald@csun.edu')}}</a></li>--}}
{{--          <li><a href="{{url('api/interests/personal/members?email=steven.fitzgerald@csun.edu')}}">{{url('api/interests/personal/members?email=steven.fitzgerald@csun.edu')}}</a></li>--}}
        {{--</ul>--}}
        <strong>Specified person's Badges</strong>
        <ul>
          <li><a href="{{url('1.0/badges/alexandra.monchick@csun.edu')}}">{{url('1.0/badges/alexandra.monchick@csun.edu')}}</a></li>
          <li><a href="{{url('1.0/badges?email=alexandra.monchick@csun.edu')}}">{{url('1.0/badges?email=alexandra.monchick@csun.edu')}}</a></li>
        </ul>
        <strong>Specified person's Interests</strong>
        <ul>
          <li><a href="{{url('1.0/interests?email=steven.fitzgerald@csun.edu')}}">{{url('1.0/interests?email=steven.fitzgerald@csun.edu')}}</a></li>
          <li><a href="{{url('1.0/interests/personal?email=steven.fitzgerald@csun.edu')}}">{{url('1.0/interests/personal?email=steven.fitzgerald@csun.edu')}}</a></li>
          <li><a href="{{url('1.0/interests/teaching?email=steven.fitzgerald@csun.edu')}}">{{url('1.0/interests/research?email=steven.fitzgerald@csun.edu')}}</a></li>
          <li><a href="{{url('1.0/interests/research?email=steven.fitzgerald@csun.edu')}}">{{url('1.0/interests/teaching?email=steven.fitzgerald@csun.edu')}}</a></li>
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
            <img src="http://www.csun.edu/faculty/imgs/meta-logo-horz.png" alt="CSUN META Lab Logo">
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

<script src="https://cdn.metalab.csun.edu/metaphor/js/metaphor.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
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
