$(document).ready(function () {
    // alert()
    function createAudioElement(blobUrl) {
        const downloadEl = document.createElement('a');
        downloadEl.style = 'display: block';
        downloadEl.innerHTML = 'download';
        downloadEl.download = 'audio.mp3';
        downloadEl.href = blobUrl;
        const audioEl = document.createElement('audio');
        const audioContainer = document.getElementById('audio-container')
        audioEl.controls = true;
        const sourceEl = document.createElement('source');
        sourceEl.src = blobUrl;
        sourceEl.type = 'audio/mp3';
        audioEl.appendChild(sourceEl);

        audioContainer.appendChild(audioEl);
        audioContainer.appendChild(downloadEl);
    }

    // request permission to access audio stream
    navigator.mediaDevices.getUserMedia({ audio: true }).then(stream => {
        // store streaming data chunks in array
        const chunks = [];
        // create media recorder instance to initialize recording
        const recorder = new MediaRecorder(stream);
        // function to be called when data is received
        recorder.ondataavailable = e => {
          // add stream data to chunks
          chunks.push(e.data);
          // if recorder is 'inactive' then recording has finished
          if (recorder.state == 'inactive') {
              // convert stream data chunks to a 'webm' audio format as a blob
              const blob = new Blob(chunks, { type: 'audio/webm' });
              // convert blob to URL so it can be assigned to a audio src attribute
              createAudioElement(URL.createObjectURL(blob));
          }
        };
        // start recording with 1 second time between receiving 'ondataavailable' events
        recorder.start(1000);
        // setTimeout to stop recording after 4 seconds
        setTimeout(() => {
            // this will trigger one final 'ondataavailable' event and set recorder state to 'inactive'
            recorder.stop();
        }, 4000);
      }).catch(console.error);
});
// function restore(){
//     $("#record, #live").removeClass("disabled");
//     $(".one").addClass("disabled");
//     Fr.voice.stop();
//   }
//   $(document).ready(function(){
//     $(document).on("click", "#record:not(.disabled)", function(){
//       elem = $(this);
//       Fr.voice.record($("#live").is(":checked"), function(){
//         elem.addClass("disabled");
//         $("#live").addClass("disabled");
//         $(".one").removeClass("disabled");
//       });
//     });

//     $(document).on("click", "#stop:not(.disabled)", function(){
//     //   restore();
//     Fr.voice.stop();

//     });

//     $(document).on("click", "#play:not(.disabled)", function(){
//       Fr.voice.export(function(url){
//         $("#audio").attr("src", url);
//         $("#audio")[0].play();
//       }, "URL");
//       restore();
//     });

//     $(document).on("click", "#download:not(.disabled)", function(){
//       Fr.voice.export(function(url){
//         $("<a href='"+url+"' download='MyRecording.wav'></a>")[0].click();
//       }, "URL");
//       restore();
//     });

//     $(document).on("click", "#base64:not(.disabled)", function(){
//       Fr.voice.export(function(url){
//         console.log("Here is the base64 URL : " + url);
//         alert("Check the web console for the URL");

//         $("<a href='"+ url +"' target='_blank'></a>")[0].click();
//       }, "base64");
//       restore();
//     });

//     $(document).on("click", "#mp3:not(.disabled)", function(){
//       alert("The conversion to MP3 will take some time (even 10 minutes), so please wait....");
//       Fr.voice.export(function(url){
//         console.log("Here is the MP3 URL : " + url);
//         alert("Check the web console for the URL");

//         $("<a href='"+ url +"' target='_blank'></a>")[0].click();
//       }, "mp3");
//       restore();
//     });


//   });
//webkitURL is deprecated but nevertheless
// var constraints = {
//     audio: true,
//     video: false
// }
/* We're using the standard promise based getUserMedia() https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia */
// navigator.mediaDevices.getUserMedia(constraints).then(
//     function(stream) {
//         __log("getUserMedia() success, stream created, initializing WebAudioRecorder...");
//         //assign to gumStream for later use
//         gumStream = stream;
//         /* use the stream */
//         input = audioContext.createMediaStreamSource(stream);
//         //stop the input from playing back through the speakers
//         input.connect(audioContext.destination)
//         //get the encoding
//         encodingType = encodingTypeSelect.options[encodingTypeSelect.selectedIndex].value;
//         //disable the encoding selector
//         encodingTypeSelect.disabled = true;
//         recorder = new WebAudioRecorder(input, {
//             workerDir: "js/",
//             encoding: encodingType,
//             onEncoderLoading: function(recorder, encoding) {
//                 // show "loading encoder..." display
//                 __log("Loading " + encoding + " encoder...");
//             },
//             onEncoderLoaded: function(recorder, encoding) {
//                 // hide "loading encoder..." display
//                 __log(encoding + " encoder loaded");
//             }
//         });
//         recorder.onComplete = function(recorder, blob) {
//             __log("Encoding complete");
//             createDownloadLink(blob, recorder.encoding);
//             encodingTypeSelect.disabled = false;
//         }
//         recorder.setOptions({
//             timeLimit: 120,
//             encodeAfterRecord: encodeAfterRecord,
//             ogg: {
//                 quality: 0.5
//             },
//             mp3: {
//                 bitRate: 160
//             }
//         });
//         //start the recording process
//         recorder.startRecording();
//         __log("Recording started");
//     }).catch(function(err) { //enable the record button if getUSerMedia() fails
//     recordButton.disabled = false;
//     stopButton.disabled = true;
// });
// //disable the record button
// recordButton.disabled = true;
// stopButton.disabled = false;
// function stopRecording() {
//     console.log("stopRecording() called");
//     //stop microphone access
//     gumStream.getAudioTracks(constraints)[0].stop();
//     //disable the stop button
//     stopButton.disabled = true;
//     recordButton.disabled = false;
//     //tell the recorder to finish the recording (stop recording + encode the recorded audio)
//     recorder.finishRecording();
//     __log('Recording stopped');
// }
// function createDownloadLink(blob, encoding) {
//     var url = URL.createObjectURL(blob);
//     var au = document.createElement('audio');
//     var li = document.createElement('li');
//     var link = document.createElement('a');
//     //add controls to the "audio" element
//     au.controls = true;
//     au.src = url; //link the a element to the blob
//     link.href = url;
//     link.download = new Date().toISOString() + '.' + encoding;
//     link.innerHTML = link.download;
//     //add the new audio and a elements to the li element
//     li.appendChild(au);
//     li.appendChild(link); //add the li element to the ordered list
//     recordingsList.appendChild(li);
// }
