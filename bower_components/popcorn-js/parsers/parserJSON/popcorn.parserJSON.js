// PARSER: 0.3 JSON

(function (Popcorn) {
  Popcorn.parser( "parseJSON", "JSON", function( data ) {

    // declare needed variables
    var retObj = {
          title: "",
          remote: "",
          data: []
        },
        manifestData = {}, 
        dataObj = data;
    
    
    /*
      TODO: add support for filling in source children of the media element
      
      
      remote: [
        { 
          src: "whatever.mp4", 
          type: 'media/mp4; codecs="avc1, mp4a"'
        }, 
        { 
          src: "whatever.ogv", 
          type: 'media/ogg; codecs="theora, vorbis"'
        }
      ]

    */
    
        
    Popcorn.forEach( dataObj.data, function ( obj, key ) {
      retObj.data.push( obj );
    });

    return retObj;
  });

})( Popcorn );
