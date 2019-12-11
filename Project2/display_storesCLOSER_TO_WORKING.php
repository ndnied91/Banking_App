

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <style type="text/css">.gm-control-active>img{box-sizing:content-box;display:none;left:50%;pointer-events:none;position:absolute;top:50%;transform:translate(-50%,-50%)}.gm-control-active>img:nth-child(1){display:block}.gm-control-active:hover>img:nth-child(1),.gm-control-active:active>img:nth-child(1){display:none}.gm-control-active:hover>img:nth-child(2),.gm-control-active:active>img:nth-child(3){display:block}
  </style>

  <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Google+Sans">
  <style type="text/css">.gm-ui-hover-effect{opacity:.6}.gm-ui-hover-effect:hover{opacity:1} </style>
  <style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px;box-sizing:border-box} </style>
  <style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style>

  <style type="text/css">.dismissButton{background-color:#fff;border:1px solid #dadce0;color:#1a73e8;border-radius:4px;font-family:Roboto,sans-serif;font-size:14px;height:36px;cursor:pointer;padding:0 24px}.dismissButton:hover{background-color:rgba(66,133,244,0.04);border:1px solid #d2e3fc}.dismissButton:focus{background-color:rgba(66,133,244,0.12);border:1px solid #d2e3fc;outline:0}.dismissButton:hover:focus{background-color:rgba(66,133,244,0.16);border:1px solid #d2e2fd}.dismissButton:active{background-color:rgba(66,133,244,0.16);border:1px solid #d2e2fd;box-shadow:0 1px 2px 0 rgba(60,64,67,0.3),0 1px 3px 1px rgba(60,64,67,0.15)}.dismissButton:disabled{background-color:#fff;border:1px solid #f1f3f4;color:#3c4043}
 </style>

 <style type="text/css">.gm-style-pbc{transition:opacity ease-in-out;background-color:rgba(0,0,0,0.45);text-align:center}.gm-style-pbt{font-size:22px;color:white;font-family:Roboto,Arial,sans-serif;position:relative;margin:0;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)} </style>

  <meta charset="utf-8">

    <style>

    .root{
    margin: auto;
    width: 720px;
    }

    #title{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    }
    </style>


    <title> View all stores</title>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <style>
        #map-canvas {
          height: 600px;
          margin: 0px;
          padding: 0px
        }
      </style>


      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/common.js"></script>
      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/util.js"></script>
      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/map.js"></script>
      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/marker.js"></script>
      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/controls.js"></script>
      <style type="text/css">.gm-style {
              font: 400 11px Roboto, Arial, sans-serif;
              text-decoration: none;
            }
            .gm-style img { max-width: none; }</style>

      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/onion.js"></script>
      <script type="text/javascript" charset="UTF-8" src="http://maps.google.com/maps-api-v3/api/js/36/7a/infowindow.js"></script>



</head>
  <body>

<div style="margin:auto;  width: 720px; ">
<!-- ^^SETS THE ACTUAL POSITION OF THE MAP -->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


 <p id = "title"> The following stores are in the database </p>

<div class="root" >



<?php



    define("IN_CODE", 1);
    include "dbconfig.php";

    $connect=mysqli_connect($server, $login, $password, $dbname);

    if (!$connect) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }

    $addressQuery = "SELECT * from CPS3740.Stores where address IS NOT NULL";
    $res=mysqli_query($connect, $addressQuery); //makes inital query

$i =0 ;



//https://www.webmaster-source.com/2009/08/20/php-stdclass-storing-data-object-instead-array/

$ids = array();
$names = array();
$zipcodes = array();
$states = array();
$cities = array();
$addresses = array();
$locations = array(); //

$lat = array();
$long = array();

$place = new stdClass;
$places = array();





         if($res){


     echo "<TABLE border=1>\n";

     echo "<TR>
     <TD> <strong>ID </strong>
     <TD> <strong> Name </strong>
     <TD> <strong> Zipcode </strong>
     <TD> <strong> State </strong>
     <TD> <strong> city </strong>
     <TD> <strong> Address </strong>
     <TD> <strong> Location(Latitude,Lognitude) </strong>
      \n";

           while($row = mysqli_fetch_array($res)){




               $id = $row['sid'];
               $Name = $row['Name'];
               $Zipcode = $row['Zipcode'];
               $State = $row['State'];
               $City = $row['city'];
               $Address = $row['address'];
               $latitude = $row['latitude'];
               $longitude = $row['longitude'];

              $location = "$latitude ,  $longitude"; //save as object

         $places[] = (object) array( 'Id' =>  $id ,
                                    'Name' => $Name,
                                    'Zipcode' => $Zipcode,
                                    'State' => $State,
                                    'City' => $City,
                                    'Address'=> $Address,
                                    'Latitude'=>$latitude,
                                    'Longitude'=> $longitude
                                  );
                    //creates an object out of each entry, cleans up alot of


           echo "<TR>
           <TD>$id
            <TD>$Name
            <TD>$Zipcode
            <TD>$State
            <TD>$City
            <TD>$Address
            <TD>$location
          \n";



            $i++;

           }// while loop
           echo "</TABLE>\n";

         }//if results query

?>
    </div>
<!-- end of root div  -->



<script>

// var i=0;
var js_data = '<?php echo json_encode($places); ?>';

// document.write(`OBJECT INFO:  ${js_data}`);
var OBJdata = JSON.parse(js_data);
var arrayLen = OBJdata.length;

console.log(OBJdata);
document.write(`Length of array : ${arrayLen}<BR>`);


for(var i=0; i< arrayLen ; i++){
document.write(`${OBJdata[i].Id} , ${OBJdata[i].Name} , ${OBJdata[i].Latitude} , ${OBJdata[i].Longitude}, ${OBJdata[i].Address}
  ${OBJdata[i].City},${OBJdata[i].State} , ${OBJdata[i].Zipcode} <BR>`);
}




// for(var i=0; i< arrayLen ; i++){
// console.log(OBJdata[i].Id);
// }

// console.log([OBJdata[i].Id , OBJdata[i].Name , OBJdata[i].Latitude , OBJdata[i].Longitude , OBJdata[i].Address , OBJdata[i].City ,OBJdata[i].State , OBJdata[i].Zipcode]),

// var j=0;
// while(j < 5){
//   console.log('J Print' + j);
//   j++;
// }

    // var x = 1;

    function initialize() {


        var mapOptions = {
                zoom: 4,

                //center: new google.maps.LatLng(39.521741, -96.848224),
                center: new google.maps.LatLng(41.3182726,-94.728285),
                mapTypeId: google.maps.MapTypeId.ROADMAP
       };

       var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

       var infowindow = new google.maps.InfoWindow();


	var markerIcon = {
  		scaledSize: new google.maps.Size(80, 80),
		  origin: new google.maps.Point(0, 0),
		  anchor: new google.maps.Point(32,65),
		  labelOrigin: new google.maps.Point(40,33)
	};

        var location;
        var mySymbol;
        var marker, m;

var x = 0;
  // while(x < 5){
  //   console.log(x);
  //   x++;
  // }

        var MarkerLocations=[
          ////////////



// console.log([OBJdata[i].Id , OBJdata[i].Name , OBJdata[i].Latitude , OBJdata[i].Longitude , OBJdata[i].Address , OBJdata[i].City ,OBJdata[i].State , OBJdata[i].Zipcode]),
// }



[OBJdata[x].Id , OBJdata[x].Name , OBJdata[x].Latitude , OBJdata[x].Longitude , OBJdata[x].Address , OBJdata[x].City ,OBJdata[x].State , OBJdata[x].Zipcode],
[OBJdata[1].Id , OBJdata[1].Name , OBJdata[1].Latitude , OBJdata[1].Longitude , OBJdata[1].Address , OBJdata[1].City ,OBJdata[1].State , OBJdata[1].Zipcode],
[OBJdata[2].Id , OBJdata[2].Name , OBJdata[2].Latitude , OBJdata[2].Longitude , OBJdata[2].Address , OBJdata[2].City ,OBJdata[2].State , OBJdata[2].Zipcode],
[OBJdata[3].Id , OBJdata[3].Name , OBJdata[3].Latitude , OBJdata[3].Longitude , OBJdata[3].Address , OBJdata[3].City ,OBJdata[3].State , OBJdata[3].Zipcode],
[OBJdata[4].Id , OBJdata[4].Name , OBJdata[4].Latitude , OBJdata[4].Longitude , OBJdata[4].Address , OBJdata[4].City ,OBJdata[4].State , OBJdata[4].Zipcode]

// ['1003','Store1',40.68121200,-74.23543200,'1000 Morris Ave.','Union','NJ','07083' ] ,
// ['1008','Store2',41.88437000,-87.76554000,'210 N Central Ave.','Chicago','IL','60644' ] ,
// ['1009','Store3',34.04425300,-118.23933300,'6 S Central Ave.','Los Angeles','IL','90013' ] ,
// ['1010','Store4',47.60898300,-122.33930600,'111 Pike St.','Seattle','WA','98101' ] ,
// ['1011','Store5',42.37254500, -71.06181400,'9 Main St.','Boston','MA','02129' ],

    ];









for (m = 0; m < MarkerLocations.length; m++) {

        location = new google.maps.LatLng(MarkerLocations[m][2], MarkerLocations[m][3]),
        marker = new google.maps.Marker({
	    map: map,
	    position: location,
	    icon: markerIcon,
	    label: {
	   	text: MarkerLocations[m][0] ,
		color: "black",
    		fontSize: "16px",
    		fontWeight: "bold"
	    }
	});

      google.maps.event.addListener(marker, 'click', (function(marker, m) {
        return function() {
          infowindow.setContent("Store Name: " + MarkerLocations[m][1] + "<br>" + MarkerLocations[m][4] + ", " + MarkerLocations[m][5] + ", " + MarkerLocations[m][6] + " " + MarkerLocations[m][7]);
          infowindow.open(map, marker);
        }
      })(marker, m));
 }
}
  google.maps.event.addDomListener(window, 'load', initialize);;

  </script>






  <br>
  <div id="map-canvas" style="height: 400px; width: 720px; position: relative; overflow: hidden;">
    <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
    <div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
    <div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;">
    <div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
    <div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
    <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
    <div style="position: absolute; z-index: 996; transform: matrix(1, 0, 0, 1, -202, -251);">
    <div style="position: absolute; left: 256px; top: 256px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;">
  </div>


  </div>

  <div style="position: absolute; left: 0px; top: 256px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;">
  </div>


  </div>
    <div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;"> </div>
  </div>

  <div style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;"> </div>
  </div>

  <div style="position: absolute; left: 512px; top: 0px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;"> </div>
  </div>



  <div style="position: absolute; left: 512px; top: 256px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;"></div>
    </div>


  <div style="position: absolute; left: -256px; top: 256px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;"> </div>
  </div>

  <div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px;">
    <div style="width: 256px; height: 256px;"> </div>
  </div>
  </div>
  </div>
  </div>


  <div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"> </div>
  <div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"> </div>
  <div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">

  <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: 219px; top: -34px; z-index: 9;">
      <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>


  <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: 65px; top: -52px; z-index: -9;">
    <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>

  <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: -281px; top: 62px; z-index: 105;">
    <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>

  <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: -328px; top: -144px; z-index: -101;">
    <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>

  <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: 255px; top: -59px; z-index: -16;">
    <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>

  <div style="position: absolute; left: 233px; top: -19px; z-index: 9;">
    <div style="height: 100px; margin-top: -50px; margin-left: -50%; display: table; border-spacing: 0px;">
      <div style="display: table-cell; vertical-align: middle; white-space: nowrap; text-align: center;">
        <div style="color: black; font-size: 16px; font-weight: bold; font-family: Roboto, Arial, sans-serif;">1003</div>

      </div>
    </div>
  </div>

  <div style="position: absolute; left: 79px; top: -37px; z-index: -9;">
    <div style="height: 100px; margin-top: -50px; margin-left: -50%; display: table; border-spacing: 0px;">
      <div style="display: table-cell; vertical-align: middle; white-space: nowrap; text-align: center;">
        <div style="color: black; font-size: 16px; font-weight: bold; font-family: Roboto, Arial, sans-serif;">1008</div>
      </div>
    </div>
  </div>

  <div style="position: absolute; left: -267px; top: 77px; z-index: 105;">
    <div style="height: 100px; margin-top: -50px; margin-left: -50%; display: table; border-spacing: 0px;">
      <div style="display: table-cell; vertical-align: middle; white-space: nowrap; text-align: center;">
        <div style="color: black; font-size: 16px; font-weight: bold; font-family: Roboto, Arial, sans-serif;">1009</div>
      </div>
    </div>
  </div>

  <div style="position: absolute; left: -314px; top: -129px; z-index: -101;">
    <div style="height: 100px; margin-top: -50px; margin-left: -50%; display: table; border-spacing: 0px;">
      <div style="display: table-cell; vertical-align: middle; white-space: nowrap; text-align: center;">
        <div style="color: black; font-size: 16px; font-weight: bold; font-family: Roboto, Arial, sans-serif;">1010</div>
      </div>
    </div>
  </div>

  <div style="position: absolute; left: 269px; top: -44px; z-index: -16;">
    <div style="height: 100px; margin-top: -50px; margin-left: -50%; display: table; border-spacing: 0px;">
      <div style="display: table-cell; vertical-align: middle; white-space: nowrap; text-align: center;">
        <div style="color: black; font-size: 16px; font-weight: bold; font-family: Roboto, Arial, sans-serif;">1011</div>
      </div>
    </div>
  </div>

  <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
    <div style="position: absolute; z-index: 996; transform: matrix(1, 0, 0, 1, -202, -251);">
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: 256px;">
      </div>

      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 256px;"> </div>
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;"> </div>
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: 0px;">   </div>
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: 0px;">  </div>
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: 256px;"> </div>
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 256px;">  </div>
      <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 0px;">  </div>
    </div>
  </div>
  </div>



  <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
    <div style="position: absolute; z-index: 996; transform: matrix(1, 0, 0, 1, -202, -251);">
      <div style="position: absolute; left: 256px; top: 256px; width: 256px; height: 256px; transition: opacity 200ms linear;">
        <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i4!3i6!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=103073" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
      </div>

      <div style="position: absolute; left: 512px; top: 256px; width: 256px; height: 256px; transition: opacity 200ms linear;">
        <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i5!3i6!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=122313" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
      </div>

      <div style="position: absolute; left: 512px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear;">
        <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i5!3i5!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=43214" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
      </div>

      <div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear;">
        <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i3!3i5!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=4734" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
      </div>

      <div style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear;">
        <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i4!3i5!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=23974" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
      </div>

  <div style="position: absolute; left: -256px; top: 256px; width: 256px; height: 256px; transition: opacity 200ms linear;">
    <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i2!3i6!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=64593" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>

  <div style="position: absolute; left: 0px; top: 256px; width: 256px; height: 256px; transition: opacity 200ms linear;">
    <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i3!3i6!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=83833" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>

  <div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear;">
    <img draggable="false" alt="" role="presentation" src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i4!2i2!3i5!4i256!2m3!1e0!2sm!3i460168920!2m3!1e2!6m1!3e5!3m14!2sen-US!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0&amp;token=116565" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
  </div>
  </div>
  </div>
  </div>


  <div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; transition-duration: 0ms; opacity: 0;">
    <p class="gm-style-pbt"></p>
    </div>

  <div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;">
    <div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
      <div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"> </div>


      <div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>

      <div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;">
        <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; left: 219px; top: -34px; z-index: 9;">
          <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" usemap="#gmimap0" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
          <map name="gmimap0" id="gmimap0"><area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer;"></map>
        </div>

        <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; left: 65px; top: -52px; z-index: -9;">
          <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" usemap="#gmimap1" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
          <map name="gmimap1" id="gmimap1"><area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer;"></map>
        </div>

        <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; left: -281px; top: 62px; z-index: 105;">
          <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" usemap="#gmimap2" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
          <map name="gmimap2" id="gmimap2"><area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer;"> </map>
        </div>

        <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; left: -328px; top: -144px; z-index: -101;">
          <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" usemap="#gmimap3" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
          <map name="gmimap3" id="gmimap3">
            <area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer;">
          </map>
        </div>

        <div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; left: 255px; top: -59px; z-index: -16;">
          <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi-dotless2.png" draggable="false" usemap="#gmimap4" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
          <map name="gmimap4" id="gmimap4">
            <area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer;">
          </map>
        </div>
      </div>

        <div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;">  </div>
      </div>
     </div>
    </div>

  <iframe aria-hidden="true" frameborder="0" src="about:blank" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;"> </iframe>

  <div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
    <a target="_blank" rel="noopener" href="https://maps.google.com/maps?ll=41.318273,-94.728285&amp;z=4&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Open this area in Google Maps (opens a new window)" style="position: static; overflow: visible; float: none; display: inline;">
      <div style="width: 66px; height: 26px; cursor: pointer;">
        <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;">
      </div>
    </a>
   </div>

  <div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-sizing: border-box; -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 300px; height: 180px; position: absolute; left: 210px; top: 110px;">
    <div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
    <div style="font-size: 13px;">Map data ©2019 Google, INEGI</div>
    <button draggable="false" title="Close" aria-label="Close" type="button" class="gm-ui-hover-effect" style="background-image: none; display: block; border: 0px; margin: 0px; padding: 0px; position: absolute; cursor: pointer; -webkit-user-select: none; top: 0px; right: 0px; width: 37px; height: 37px; background-position: initial initial; background-repeat: initial initial;">
      <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%206.41L17.59%205%2012%2010.59%206.41%205%205%206.41%2010.59%2012%205%2017.59%206.41%2019%2012%2013.41%2017.59%2019%2019%2017.59%2013.41%2012z%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="pointer-events: none; display: block; width: 13px; height: 13px; margin: 12px;">

    </button>
  </div>

  <div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 71px; bottom: 0px; width: 151px;">
    <div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; height: 14px; line-height: 14px;">
      <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
        <div style="width: 1px;"> </div>

        <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"> </div>
      </div>

      <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
        <a style="text-decoration: none; cursor: pointer; display: none;">Map Data</a>
        <span>Map data ©2019 Google, INEGI</span>
      </div>
    </div>
  </div>

  <div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;">
    <div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2019 Google, INEGI</div>
  </div>

  <div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; -webkit-user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;">
    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
      <div style="width: 1px;">
      </div>
      <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;">
      </div>
    </div>

    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
      <a href="https://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" rel="noopener" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a>
    </div>
  </div>

  <button draggable="false" title="Toggle fullscreen view" aria-label="Toggle fullscreen view" type="button" class="gm-control-active gm-fullscreen-control" style="background-image: none; background-color: rgb(255, 255, 255); border: 0px; margin: 10px; padding: 0px; position: absolute; cursor: pointer; -webkit-user-select: none; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; height: 40px; width: 40px; -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; overflow: hidden; top: 0px; right: 0px; background-position: initial initial; background-repeat: initial initial;">

    <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%20018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
    <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
    <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
  </button>
  <div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; height: 14px; line-height: 14px; display: none; position: absolute; right: 0px; bottom: 0px;">
    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
      <div style="width: 1px;"></div>
      <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;">
      </div>
    </div>

    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
      <a target="_blank" rel="noopener" title="Report errors in the road map or imagery to Google" href="https://www.google.com/maps/@41.3182726,-94.728285,4z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a>
    </div>
  </div>

  <div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="40" controlheight="113" style="margin: 10px; -webkit-user-select: none; position: absolute; bottom: 127px; right: 40px;">
    <div class="gmnoprint" controlwidth="40" controlheight="81" style="position: absolute; left: 0px; top: 32px;">
      <div draggable="false" style="-webkit-user-select: none; -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255); width: 40px; height: 81px;"><button draggable="false" title="Zoom in" aria-label="Zoom in" type="button" class="gm-control-active" style="background-image: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; -webkit-user-select: none; overflow: hidden; width: 40px; height: 40px; top: 0px; left: 0px; background-position: initial initial; background-repeat: initial initial;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23666%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23333%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23111%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
        </button>

    <div style="position: relative; overflow: hidden; width: 30px; height: 1px; margin: 0px 5px; background-color: rgb(230, 230, 230); top: 0px;"> </div>

        <button draggable="false" title="Zoom out" aria-label="Zoom out" type="button" class="gm-control-active" style="background-image: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; -webkit-user-select: none; overflow: hidden; width: 40px; height: 40px; top: 0px; left: 0px; background-position: initial initial; background-repeat: initial initial;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
        </button>
      </div>
    </div>

    <div style="position: absolute; left: 20px; top: 0px;"> </div>

    <div class="gmnoprint" controlwidth="40" controlheight="40" style="display: none; position: absolute;">
      <div style="width: 40px; height: 40px;">
        <button draggable="false" title="Rotate map 90 degrees" aria-label="Rotate map 90 degrees" type="button" class="gm-control-active" style="background-image: none; background-color: rgb(255, 255, 255); display: none; border: 0px; margin: 0px 0px 32px; padding: 0px; position: relative; cursor: pointer; -webkit-user-select: none; width: 40px; height: 40px; top: 0px; left: 0px; overflow: hidden; -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; background-position: initial initial; background-repeat: initial initial;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
          <img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;">
        </button>

        <button draggable="false" title="Tilt map" aria-label="Tilt map" type="button" class="gm-tilt gm-control-active" style="background-image: none; background-color: rgb(255, 255, 255); display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; -webkit-user-select: none; width: 40px; height: 40px; top: 0px; left: 0px; overflow: hidden; -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; background-position: initial initial; background-repeat: initial initial;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px;">
        </button>
      </div>
     </div>
    </div>
   </div>
  </div>

  <div style="background-color: white; font-weight: 500; font-family: Roboto, sans-serif; padding: 15px 25px; box-sizing: border-box; top: 5px; border: 1px solid rgba(0, 0, 0, 0.117647); border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; left: 50%; max-width: 375px; position: absolute; transform: translateX(-50%); width: calc(100% - 10px); z-index: 1;">

    <div>

      <img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google_gray.svg" draggable="false" style="padding: 0px; margin: 0px; border: 0px; height: 17px; vertical-align: middle; width: 52px; -webkit-user-select: none;"></div>

      <div style="line-height: 20px; margin: 15px 0px;"><span style="color: rgba(0, 0, 0, 0.870588); font-size: 14px;">This page can't load Google Maps correctly.</span>
      </div>
      <table style="width: 100%;">
        <tr>
          <td style="line-height: 16px; vertical-align: middle;">
            <a href="https://developers.google.com/maps/documentation/javascript/error-messages?utm_source=maps_js&amp;utm_medium=degraded&amp;utm_campaign=keyless#api-key-and-billing-errors" target="_blank" rel="noopener" style="color: rgba(0, 0, 0, 0.541176); font-size: 12px;">Do you own this website?</a>
          </td>
          <td style="text-align: right;">
            <button class="dismissButton">OK</button>
          </td>
        </tr>
  </table>
  </div>

  </div>
  </div>


<!-- END OF FILE PRETTY MUCH -->

  </body>
</html>
