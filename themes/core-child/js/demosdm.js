jQuery(init);
var map, SDMlayer;
var lastSubmittedLSID = null;
function init(){
    jQuery("#demoSDM").on("click", ".import-dataset-btn", sdm_button_click_handler);
    // Define the base map
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
function setCompositeMode(evt){
    evt.context.globalCompositeOperation = 'lighten';
}
function renderLayer(lsid){
    if (SDMlayer) {
        map.removeLayer(SDMlayer)
    }   
    SDMlayer = new ol.layer.Image({
            source: new ol.source.ImageStatic({
                url: "https://swift.rc.nectar.org.au:8888/v1/AUTH_0bc40c2c2ff94a0b9404e6f960ae5677/demosdm/" + lsid + "/projection.png",
                projection: 'EPSG:3857',
                imageExtent: ol.proj.transformExtent([111.975,-44.575, 156.275,-9.975], 'EPSG:4326', 'EPSG:3857')
            })
        });
    SDMlayer.on('precompose', setCompositeMode);
    SDMlayer.on('postcompose', function(){
        SDMlayer.un('precompose', setCompositeMode);
    });
    map.addLayer(SDMlayer);
}
function sdm_button_click_handler(event){
    if (SDMlayer) {
        map.removeLayer(SDMlayer)
    }  
    jQuery("#species_results").hide();
    var btn = jQuery(event.currentTarget);
    event.preventDefault();
    check_job_status(btn.attr("data-lsid"));
}
function check_job_status(lsid){
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
            // If the experiment has failed, alert the user
            alert("There was a problem, we’re looking into it. Please select another species and try again!")
            // TODO: Handle this more gracefully. 
        }
        else if(data.status == "COMPLETE"){
            renderLayer(lsid);
        }
        else{
            setTimeout(function(){
                    check_job_status(lsid);
                }, 5000);
        }
    }
    else{
        // Assuming experiment hasn't been run in the past
        if (lastSubmittedLSID == lsid){
             console.log('Already submitted, waiting...');
             setTimeout(function(){
                    check_job_status(lsid);
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
                    check_job_status(lsid);
                }, 10000);
    });
}