@extends('layouts.master')

@section('title')
  Documentation
@endsection

@section('description')
  {{ env('APP_NAME') }} Web Service Documentation
@endsection

@section('content')
        <h2 id="introduction">Introduction</h2>
        <p>The Affinity web service gives information acknowledging and celebrating
          teaching interests and accomplishments and helps promote faculty community
          and networking. This information is derived from the Research and Graduate
          Studies and faculty submitted information using <a href="//www.csun.edu/faculty/scholarship">Scholarship</a>.
          The web service provides a gateway to access the information via a REST-ful
          API. The information is retrieved by creating a specific URI and giving
          values to filter the data. The information that is returned is a JSON
          object that contains a set of interest or badges attached to a particular
          member; the format of the JSON object is as follows:
        </p>
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
        <h2 id="getting-started">Getting Started</h2>
        <ol>
          <li><strong>GENERATE THE URI:</strong> Find the usage that fits your need. Browse through subcollections, instances and query types to help you craft your URI.</li>
          <li><strong>PROVIDE THE DATA:</strong> Use the URI to query your data. See the Usage Example session.</li>
          <li><strong>SHOW THE RESULTS</strong></li>
        </ol>
        <p>Loop through the data to display its information. See the Usage Example session.</p>
        <br>
        <h2 id="collections">Collections</h2>
        <strong>All Badges Listing</strong>
        <ul>
          <li><a href="{!! url('api/1.0/badges') !!}">{!! url('api/1.0/badges') !!}</a></li>
        </ul>
        <strong>All Interest Listing</strong>
        <ul>
          <li><a href="{!! url('api/1.0/interests') !!}">{!! url('api/1.0/interests') !!}</a></li>
          <li><a href="{!! url('api/1.0/interests/personal') !!}">{!! url('api/1.0/interests/personal') !!}</a></li>
          <li><a href="{!! url('api/1.0/interests/research') !!}">{!! url('api/1.0/interests/research') !!}</a></li>
          <li><a href="{!! url('api/1.0/interests/academic') !!}">{!! url('api/1.0/interests/academic') !!}</a></li>
        </ul>
        <br>
        <h2 id="subcollections">Subcollections</h2>
        <strong>Specified person's Badges</strong>
        <ul>
          <li><a href="{!! url('api/1.0/badges?email='.$email['alexandra']) !!}">{!! url('api/1.0/badges?email='.$email['alexandra']) !!}</a></li>
        </ul>
        <strong>Specified persons by Badge</strong>
        <ul>
          <li><a href="{!! url('api/1.0/badges?name=Teaching Conference Grant') !!}">{!! url('api/1.0/badges?name=Teaching Conference Grant') !!}</a></li>
          <li><a href="{!! url('api/1.0/badges?name=Teaching Conference Grant&email='.$email['alexandra']) !!}">{!! url('api/1.0/badges?name=Teaching Conference Grant&email='.$email['alexandra']) !!}</a></li>
        </ul>
        <strong>Specified person's Interests</strong>
        <ul>
          <li><a href="{!! url('api/1.0/interests?email='.$email['steve']) !!}">{!! url('api/1.0/interests?email='.$email['steve']) !!}</a></li>
          <li><a href="{!! url('api/1.0/interests/personal?email='.$email['steve']) !!}">{!! url('api/1.0/interests/personal?email='.$email['steve']) !!}</a></li>
          <li><a href="{!! url('api/1.0/interests/research?email='.$email['steve']) !!}">{!! url('api/1.0/interests/research?email='.$email['steve']) !!}</a></li>
          <li><a href="{!! url('api/1.0/interests/academic?email='.$email['steve']) !!}">{!! url('api/1.0/interests/academic?email='.$email['steve']) !!}</a></li>
        </ul>
        <h2 id="code-examples">Code Examples</h2>
        <strong>Badges</strong>
        <div class="accordion">
          <div class="card">
            <div id="jquery-header" class="card-header">
              <p class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jquery-body" aria-expanded="true" aria-controls="jquery-body">
                  JQuery
                </button>
              </p>
            </div>
            <div id="jquery-body" class="collapse" aria-labelledby="jquery-header">
              <div class="card-body">
                <pre>
                  <code class="prettyprint lang-js">
//construct a function to get url and iterate over
$(document).ready(function() {
  //generate a url
  var url = '{!! url('api/1.0/badges?email='.$email['steve']) !!}';
  //use the URL as a request
  $.ajax({
    url: url
  }).done(function(data) {
    // save the degree list
    var badgeList = data.badges;
    //iterate over the degree list
    $(badgeList).each(function(index, badge) {
      //append each degree and institute
      $('#badge-results').append('<strong>'+ badge.name + '</strong><br>by: ' + badge.issuer + '<br>');
      });
    });
});
                  </code>
                </pre>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="php-header" class="card-header">
                <p class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#php-body" aria-expanded="true" aria-controls="php-body">
                    PHP
                  </button>
                </p>
            </div>
            <div id="php-body" class="collapse" aria-labelledby="php-header">
              <div class="card-body">
              <pre>
                <code class="prettyprint lang-php">
//generate a url
$url = '{!! url('/api/1.0/badges?email='.$email['steve']) !!}';

//add extra necessary options
$arrContextOptions = [
    "ssl" => [
        "verify_peer"=>false,
        "verify_peer_name"=>false
    ]
];

//perform the query
$data = file_get_contents($url, false, stream_context_create($arrContextOptions));

//decode the json
$data = json_decode($data, true);

//iterate over the list of data and print
foreach($data['badges'] as $badge){
	echo = $badge['name'] . '<br>by: ' . $badge['issuer'].'<br>';
}
                </code>
              </pre>
            </div>
            </div>
          </div>
          <div class="card">
            <div id="python-header" class="card-header">
              <p class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#python-body" aria-expanded="true" aria-controls="python-body">
                  Python
                </button>
              </p>
            </div>
            <div id="python-body" class="collapse" aria-labelledby="python-header">
              <div class="card-body">
              <pre>
                <code class="prettyprint language-py">
#python
import urllib2
import json

#generate a url
url = u'{!! url('/api/1.0/badges?email='.$email['steve']) !!}'

#open the url
try:
  u = urllib2.urlopen(url)
  data = u.read()
except Exception as e:
  data = {}

#load data with json object
data = json.loads(data)

#iterate over the json object and print
for badge in data['badges']:
  print badge['name'] + '\nby: ' + badge['issuer']
                </code>
              </pre>
            </div>
            </div>
            <div id="ruby-header" class="card-header">
              <p class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#ruby-body" aria-expanded="true" aria-controls="ruby-body">
                  Ruby
                </button>
              </p>
            </div>
            <div id="ruby-body" class="collapse" aria-labelledby="ruby-header">
              <div class="card-body">
              <pre>
                <code class="prettyprint lang-rb">
require 'net/http'
require 'json'

#generate a url
source = '{!! url('/api/1.0/badges?email='.$email['steve']) !!}'

#prepare the uri
uri = URI.parse(source)

#request the data
response = Net::HTTP.get(uri)

#parse the json
badges = JSON.parse(response)

#print the json
badges['badges'].each do |badge|
  puts "#{badge['name']}\nby: #{badge['issuer']}"
                </code>
              </pre>
            </div>
            </div>
          </div>
        </div>
@endsection
