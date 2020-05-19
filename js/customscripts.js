//set the container that Masonry will be inside of in a var
    var container = document.querySelector('#portfoliowrapper, #servicesinner');
    //create empty var msnry
    var msnry;
    // initialize Masonry after all images have loaded
    imagesLoaded( container, function() {
        msnry = new Masonry( container, {
            itemSelector: '.portfolio-entry, .servicespost'
        });
    });