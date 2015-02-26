
// Find a suitable media source for this browser.
var videoSource = (function() {

  var v = document.createElement( "video" ),
    sources = [
      {
        type: "media/webm",
        file: "../../test/trailer.webm"
      },
      {
        type: "media/mp4",
        file: "../../test/trailer.mp4"
      },
      {
        type: "media/ogg",
        file: "../../test/trailer.ogv"
      }
    ],
    source,
    sourcesLength = sources.length;

  while( sourcesLength-- ) {
    source = sources[ sourcesLength ];
    if( v.canPlayType( source.type ) !== "" ) {
      return source;
    }
  }

  throw "No Supported Media Types found for this browser.";

}());


var testData = {

  videoSrc: videoSource.file,
  videoType: videoSource.type,
  expectedDuration: 64.544,

  createMedia: function( id ) {
    return Popcorn.HTMLVideoElement( id );
  }

};
