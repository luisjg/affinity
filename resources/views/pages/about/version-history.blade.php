@extends('layouts.master')

@section('title')
  Version History
@endsection

@section('description')
  {{ env('APP_NAME') }} Web Service Version History
@endsection

@section('content')
  <h2 id="introduction">Version History</h2>
  <h3 class="h5 padding">{{ env('APP_NAME') }} 1.0.2 <small>Release Date: 10/23/18</small></h3>
  <strong>Improvements:</strong>
  <ol>
    <li>Update the landing pages to include the latest version of <a href="//csun-metalab.github.io/metaphorV2/">Metaphor</a>.</li>
  </ol>
  <hr class="margin">
  <h3 class="h5 padding">{{ env('APP_NAME') }} 1.0.1 <small>Release Date: 02/06/18</small></h3>
  <strong>Improvements:</strong>
  <ol>
    <li>Upgrade the underlying code base to the latest version.</li>
    <li>HTTPS is now enforced through code.</li>
  </ol>
  <hr class="margin">
  <h35 class="h5 padding">{{ env('APP_NAME') }} 1.0.0 <small>Release Date: 10/04/17</small></h35>
  <strong>New Features:</strong>
  <ol>
    <li>Ability to retrieve a person's interests: research, academic and personal.</li>
    <li>Ability to retrieve all recipients of a specific badge.</li>
    <li>Ability to check if an individual has a specific badge.</li>
  </ol>
  <strong>Improvements:</strong>
  <ol>
    <li>More meaningful error messages.</li>
  </ol>
  <hr class="margin">
  <h3 class="h5 padding">{{ env('APP_NAME') }} Beta <small>Release Date: 06/12/17</small></h3>
  Initial Release for Badges portion that is implemented in <a href="//www.csun.edu/faculty">Faculty</a>
  <br>
  <strong>New Features:</strong>
  <ol>
    <li>Ability to retrieve an individuals awarded badges.</li>
  </ol>
@endsection
