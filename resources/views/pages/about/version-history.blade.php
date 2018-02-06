@extends('layouts.master')


@section('content')
  <h2 id="introduction" class="type--header type--thin">Version History</h2>
  <h2>Affinity 1.0.1 <small>Release Date: 02/06/18</small></h2>
  <p>
    <strong>Improvements:</strong>
    <ol>
      <li>Upgrade the underlying code base to the latest version.</li>
      <li>HTTPS is now enforced through code.</li>
    </ol>
  </p>
  <h2>Affinity 1.0.0 <small>Release Date: 10/04/17</small></h2>
  <p>
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
  </p>
  <hr>
  <h2>Affinity Beta <small>Release Date: 06/12/17</small></h2>
  <p>
    Initial Release for Badges portion that is implemented in <a href="//www.csun.edu/faculty">Faculty</a>
    <br>
    <strong>New Features:</strong>
    <ol>
      <li>Ability to retrieve an individuals awarded badges.</li>
    </ol>
  </p>
@endsection
