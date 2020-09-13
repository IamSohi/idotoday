


// alert(localStorage.loggedIn+"  "+localStorage.place+"   "+localStorage.locationExpireDate);
// alert('geo'+sessionStorage.gotPlace);


$(document).ready(function() {
    if(!sessionStorage.gotPlace){
        sessionStorage.gotPlace=false;
    }
    // alert(localStorage.loggedIn+"  "+localStorage.place+"   "+localStorage.locationExpireDate);
    

    if(localStorage.loggedIn && localStorage.locationExpireDate < new Date()){
        // alert('logged'+localStorage.locationExpireDate);
        
        initGetLocation();

    }

if(localStorage.loggedIn && sessionStorage.gotPlace=='false'){
    
    initGetLocation();
}

});

function initGetLocation(){
    if (navigator.geolocation){
        // alert('geo');

        navigator.geolocation.getCurrentPosition(checkForSameLocation);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}





function checkForSameLocation(position){

    $.ajax({
        type:"POST",
        url:"/idoo/index.php/home/checkforsamelocation",
        data:{lat:position.coords.latitude,log:position.coords.longitude},
        success:function(result){
            var myObj=JSON.parse(result);
                                // alert(myObj.result);

            if(myObj.result=="success"){
                // sessionStorage.place=myObj.place;
                // sessionStorage.postal_code=myObj.postal_code;
                // sessionStorage.locality=myObj.locality;
                someday=new Date();
                someday.setDate(someday.getDate()+1);

                localStorage.locationExpireDate=someday;
                sessionStorage.gotPlace=true;

                
                localStorage.place=myObj.place;
                localStorage.postal_code=myObj.postal_code;
                localStorage.locality=myObj.locality;



            }else{

                find_address(position);

            }

        },
        error:function(error){
            alert("Something went wrong:  "+error);

        }
        
    });
}





function find_address(position){
    // alert("hrner"+position.coords.latitude+","+position.coords.longitude);
    $.ajax({
            url:"https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude+","+position.coords.longitude+"&key=",
            // url:"https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=",
            success:function(result){
                var l=result.results[0].address_components.length;
                var address_components=result.results[0].address_components;
                var address="";
                var political=null;
                var postal_code,country,administrative_area_level_1,political,latlog,locality,place_id;
                latlog=position.coords.latitude+","+position.coords.longitude;
                place_id=result.results[0].place_id;
                for(i=0;i<l;i++){
                    if(address_components[i].types.includes("political") && political==null){
                        political=address_components[i].long_name;

                        address+="  "+address_components[i].long_name;
                        // alert(address+" political");
                        political=address_components[i].long_name;
                    };
                    if(address_components[i].types.includes("administrative_area_level_1")){
                        address+="  "+address_components[i].long_name;
                        // alert(address+" administrative_area_level_1");
                        administrative_area_level_1=address_components[i].long_name;

                    };
                    if(address_components[i].types.includes("locality") || address_components[i].types.includes("sublocality")){
                        address+="  "+address_components[i].long_name;
                        // alert(address+" locality");
                        locality=address_components[i].long_name;

                    };
                    if(address_components[i].types.includes("country")){
                        address+="  "+address_components[i].long_name;
                        // alert(address+" country");
                        country=address_components[i].long_name;

                    };
                    if(address_components[i].types.includes("postal_code")){
                        address+="  "+address_components[i].long_name;
                        // alert(address+" postal_code");
                        postal_code=address_components[i].long_name;

                    }

                };

                sendLocationData(postal_code,place_id,locality,country,administrative_area_level_1,political,latlog);


            },
            error:function(error){
                alert('Something went wrong: '+error);

            }
        });

}

function sendLocationData(postal_code,place_id,locality,country,administrative_area_level_1,political,latlog){

    
        
                // sessionStorage.place=political;
                // sessionStorage.postal_code=postal_code;
                // sessionStorage.locality=locality;
                

        $.ajax({
            type:"POST",
            url:"/idoo/index.php/home/storecurrentLocation",
            data:{pincode:postal_code,country:country,place_id:place_id,locality:locality,level:administrative_area_level_1,political:political,latlog:latlog},
            success:function(result){
                someday=new Date();
                someday.setDate(someday.getDate()+1);
                localStorage.locationExpireDate=someday;

                
                localStorage.place=political;
                localStorage.postal_code=postal_code;
                localStorage.locality=locality;
                // alert('suuccess');
                sessionStorage.gotPlace=true;
                


            },
            error:function(error){
                alert('Something went wrong: '+error);

            }
        });


}
    

