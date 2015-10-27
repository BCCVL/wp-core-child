var map, osmLayer, projLayer;
var lastSubmittedLSID = null;
function init(){
    jQuery("#demoSDM").on("click", ".import-dataset-btn", sdmbtnClickHandler);
    // 
    map = new ol.Map({
        layers: [
            new ol.layer.Tile({
                source: new ol.source.MapQuest({layer: 'sat'})
            })
        ],
        controls: ol.control.defaults({
            attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                collapsible: true
            })
        }),
        target: 'map',
        view: new ol.View({
            center: ol.proj.transform([112, -29], 'EPSG:4326', 'EPSG:3857'),
            zoom: 4,
            minZoom: 4,
            maxZoom: 11
        }),
        projection: 'EPSG:3857'
    });
}
function sdmbtnClickHandler(event){
    var btn = jQuery(event.currentTarget);
    event.preventDefault();
    checkNectar(btn.attr("data-lsid"));
}
function checkNectar(lsid){
    var ret = jQuery.get(ajaxurl, {action: 'swift_fetch', lsid: lsid});
    ret.fail(function() {
        console.log("JSON not found");
        waitForComplete(lsid, null);
    });
    ret.done(function(data) {
        console.log("JSON is there");
        console.log(data);
        waitForComplete(lsid, data);
    });
}
function waitForComplete(lsid, data){
    if(data){
        if(data.status == "FAILED"){
            // If the experiment has failed, re-run it incase the datamover failed
            submitDemoSDM(lsid);
            // TODO: Need to catch a runaway loop here!
        }
        else if(data.status == "COMPLETE"){
            renderLayer(lsid);
        }
        else{
            setTimeout(function(){
                    checkNectar(lsid);
                }, 5000);
        }
    }
    else{
        // Assuming experiment hasn't been run in the past
        if (lastSubmittedLSID == lsid){
             console.log('Already submitted, waiting...');
             setTimeout(function(){
                    checkNectar(lsid);
                }, 15000);
        }
        else{
             submitDemoSDM(lsid);
        }
    }
}
function submitDemoSDM(lsid){
    // Do an AJAX call to submit the experiment
    var submitRet = jQuery.post(ajaxurl, {action: 'submit_demo_sdm', lsid: lsid});
    submitRet.fail(function(a,b,c) {
        console.log('Job submission failed!');
                console.log(a,b,c);
    });
    submitRet.done(function(data) {
        console.log('Job submitted!');
                console.log(data);
        lastSubmittedLSID = lsid;
        setTimeout(function(){
                    checkNectar(lsid);
                }, 10000);
    });
}
function renderLayer(lsid){
    var layers = new ol.layer.Image({
            source: new ol.source.ImageStatic({
                url: "https://swift.rc.nectar.org.au:8888/v1/AUTH_0bc40c2c2ff94a0b9404e6f960ae5677/demosdm/" + lsid + "/projection.png",
                projection: 'EPSG:3857',
                imageExtent: ol.proj.transformExtent([111.975,-44.575, 156.275,-9.975], 'EPSG:4326', 'EPSG:3857')
            })
        });
    map.addLayer(layers);
}