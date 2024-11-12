<select id="encodingTypeSelect">
    <option value="wav">Waveform Audio (.wav)</option>
    <option value="mp3">MP3 (MPEG-1 Audio Layer III) (.mp3)</option>
    <option value="ogg">Ogg Vorbis (.ogg)</option>
</select>

<button id="recordButton">Record</button>
<button id="stopButton" disabled>Stop</button>

<h3>Log</h3>
<pre id="log"></pre>

<h3>Recordings</h3>
<ol id="recordingsList"></ol>
<script src="{{asset('assets/js/vendors.min.js')}}"></script>

  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{asset('assets/vendors/chartjs/chart.min.js')}}"></script>
  {{-- <script src="{{asset('assets/vendors/chartist-js/chartist.min.js')}}"></script>
  <script src="{{asset('assets/vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
  <script src="{{asset('assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script> --}}
  <script src="{{asset('assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('assets/vendors/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('assets/vendors/sweetalert/sweetalert.min.js')}}"></script>

<!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
<script src="{{asset('assets/js/audio/WebAudioRecorder.min.js')}}"></script>
{{-- <script src="js/app.js"></script> --}}
<script src="{{ asset('assets/js/audio/app.js') }}"></script>
{{--  --}}
