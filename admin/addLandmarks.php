<?php
// Set the appropriate headers to allow cross-origin requests
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin (you can specify specific origins instead of '*')
header("Access-Control-Allow-Headers", "*");
header('Access-Control-Allow-Credentials', true);
header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');


include_once('..\required/server.php');
include_once("required/head.php");
if (!isLoggedIn()) {
  header('location: ..\login.php');
}
if ($_SESSION['user']['type'] != 1) {
  header('location: ..\index.php');
}
/////////
$apiUrl = 'https://rehamalswaisi.000webhostapp.com/fetchAllHotel.php';
$apiResponse = file_get_contents($apiUrl);
// Check if the API response is valid JSON
if ($apiResponse !== false) {
  // Convert JSON response to a PHP object
  $dataFromApi = json_decode($apiResponse);
  // Check if the JSON decoding was successful
  if ($dataFromApi !== null) {
    echo count($dataFromApi) . '<br>';

    foreach ($dataFromApi as $landmark) {
      echo $landmark->landmarkName . '<br>';
    }
  } else {
    // JSON decoding failed
    echo 'Error: Unable to decode JSON data from the API.';
  }
} else {
  // Error fetching data from the API
  echo 'Error: Unable to fetch data from the API.';
}
$apiUrl2 = 'https://hotelapiproject.000webhostapp.com/fetchAllHotel.php';
$apiResponse2 = file_get_contents($apiUrl2);
// Check if the API response is valid JSON
if ($apiResponse2 !== false) {
  // Convert JSON response to a PHP object
  $dataFromApi2 = json_decode($apiResponse2);
  // Check if the JSON decoding was successful
  if ($dataFromApi2 !== null) {
    echo count($dataFromApi2) . '<br>';

    foreach ($dataFromApi2 as $landmark) {
      echo $landmark->landmarkName . '<br>';
    }
  } else {
    // JSON decoding failed
    echo 'Error: Unable to decode JSON data from the API.';
  }
} else {
  // Error fetching data from the API
  echo 'Error: Unable to fetch data from the API.';
}
?>
<style>
  #main {
    margin-top: -80px;
    padding: 20px 30px;
    transition: all 0.3s;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 24px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(16px);
    -ms-transform: translateX(16px);
    transform: translateX(16px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

  .data-source {
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #f1f1f1;
    border-radius: 5px;
  }

  /* CSS style for the select element */
  #apiSelect {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-left: 10px;
    font-size: 16px;
  }

  /* CSS style for the dropdown options */
  #apiSelect option {
    background-color: #fff;
    color: #000;
  }

  /* CSS style for the dropdown when opened */
  #apiSelect:focus {
    outline: none;
    box-shadow: 0 0 5px #2196F3;
    /* Change color when focused */
  }
</style>

<body>
  <?php
  include_once("required/header.php");
  include_once("required/sidebar.php");
  ?>
  <main id="main" class="main" dir=ltr>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <center>
                <h5 class="card-title">Add New Place</h5>
              </center>



              <div class="panel panel-default">
                <div class="panel-heading"><b>Add New Place Details:</b></div>
                <br>
                <div class="panel-body">

                  <form id="myform" enctype="multipart/form-data">

                    <div class="data-source">
                      <span id="switchLabel" class="form-group  p-2">Fetch data from API</span>
                      <label class="switch">
                        <input type="checkbox" id="toggleSwitch">
                        <span class="slider round"></span>
                      </label>
                    </div>

                    <div id="divServiceProvider" style="display: none;">
                      <div class="form-group row p-2">
                        <label class="col-sm-2 col-form-label">Service provider:</label>
                        <div class="col-sm-10">
                          <select id="serviceProvider" name="serviceProvider" class="form-select" aria-label="Default select example">
                            <option value="0">Booking</option>
                            <option value="1">Hotels</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row p-2">
                      <label for="inputNanme4" class="col-sm-2 form-label">Owner:</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="owner" name="owner">
                        </select>
                      </div>
                    </div>

                    <div id="divLandmarkName">
                      <div class="form-group row p-2">
                        <label class="col-sm-2 col-form-label">Place Name:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="landmarkName" name="landmarkName">
                        </div>
                      </div>
                    </div>

                    <div id="divSelectPlace" style="display: none;">
                      <div class="form-group row p-2">
                        <label class="col-sm-2 col-form-label">Select Place:</label>
                        <div class="col-sm-10">
                          <select id="selectPlace" name="type" class="form-select" aria-label="Default select example">
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row p-2">
                      <label class="col-sm-2 col-form-label">Place Type:</label>
                      <div class="col-sm-10">
                        <select id="type" name="type" class="form-select" aria-label="Default select example">
                        </select>
                      </div>
                    </div>
                    <div class="form-group p-2">
                      <label for="description" class="form-label">Place Description:</label>
                      <textarea name="description" id="default"></textarea>

                    </div>

                    <div class="form-group row p-2">
                      <label for="longitude" class="col-sm-2 form-label">Longitude:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="longitude" name="longitude">
                      </div>

                      <label for="longitude" class="col-sm-2 form-label">Latitude:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="latitude" name="latitude">
                      </div>

                    </div>


                    <div class="form-group row p-2">
                      <label for="haveBooking" class="col-sm-2 form-label">Booking Availability:</label>
                      <div class="col-sm-4">
                        <select id="haveBooking" name="haveBooking" class="form-select" aria-label="Default select example">
                          <option value="null" selected="true" hidden>Yes or No:</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>

                      <label for="city" class="col-sm-2 form-label">City:</label>
                      <div class="col-sm-4">
                        <select id="city" name="city" class="form-select" aria-label="Default select example">
                        </select>
                      </div>
                    </div>


                    <div class="form-group p-2 row">

                      <label for="area" class="col-sm-2 form-label">Area:</label>
                      <div class="col-sm-4">
                        <select id="area" name="area" class="form-select" aria-label="Default select example">
                          <option value="0" selected="true" hidden>Select Area:</option>

                        </select>
                      </div>


                      <label class="form-label col-sm-2">Main Image:</label>
                      <div class="col-sm-4">
                        <!-- The existing image URL will be displayed here as a clickable link -->
                        <input type="text" class="form-control" id="url_image" name="url_image">
                      </div>

                    </div>

                    <div class="form-group p-2 row">
                      <label class="form-label col-sm-2">Price per Day ($):</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="price" name="price">
                      </div>


                    </div>
                </div>

                <div class="form-group p-3">
                  <center>
                    <input type="button" onclick="save()" class="btn btn-outline-primary" name="add" value="Add Place +">
                  </center>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main>
  <!-- ======= Footer ======= -->
  <?php
  include_once("required/footer.php");
  include_once('..\toster/toster.php');
  ?>
  <script type="text/javascript">
    function getTypes() {
      $.ajax({
        type: "POST",
        datatype: 'json',
        url: "methods/landmarkTypes.php",
        success: function(data) {
          $("#type").html(data);
        },
      });
    }
    getTypes();

    function getOwnerUsers() {
      $.ajax({
        type: "POST",
        datatype: 'json',
        url: "methods/landmarkOwnerUsers.php",
        success: function(data) {
          $("#owner").html(data);
        },
      });
    }
    getOwnerUsers();

    function getCitys() {
      $.ajax({
        type: "POST",
        datatype: 'json',
        url: "methods/getCitys.php",
        success: function(data) {
          $("#city").html(data);
        },
      });
    }
    getCitys();


    $('#city').on('change', function() {
      var city = $(this).val();

      $.ajax({
        type: "GET",
        data: {
          'city': city
        },
        datatype: 'json',
        url: "methods/getAreas.php",
        success: function(data) {
          $("#area").html(data);

        },
      });

    });


    function save() {

      var owner = document.getElementById("owner").value;
      var landmarkName = document.getElementById("landmarkName").value;
      var type = document.getElementById("type").value;
      var latitude = document.getElementById("latitude").value;
      var longitude = document.getElementById("longitude").value;
      var city = document.getElementById("city").value;
      var area = document.getElementById("area").value;
      var url_image = document.getElementById("url_image").value;
      var haveBooking = document.getElementById("haveBooking").value;
      // var description =document.getElementById("default").value;
      var description = tinyMCE.get('default').getContent();
      var price = document.getElementById("price").value;
      //var files = $('#url_image')[0].files;

      if (owner == '') {
        CuteAleart('error', 'Error', 'Owner name is required');
      } else {
        if (landmarkName == '') {
          CuteAleart('error', 'Error', 'Place name is required');
        } else {

          if (type == '0') {
            CuteAleart('error', 'Error', 'Place type is required');
          } else {

            if (description == '') {
              CuteAleart('error', 'Error', 'Place description is required');
            } else {

              if (longitude == '') {
                CuteAleart('error', 'Error', 'Longitude is required');
              } else {

                if (latitude == '') {
                  CuteAleart('error', 'Error', 'Latitude is required');
                } else {
                  if (haveBooking == 'null') {
                    CuteAleart('error', 'Error', 'Booking availability is required');
                  } else {
                    if (city == '0') {
                      CuteAleart('error', 'Error', 'City is required');
                    } else {

                      if (area == '0') {
                        CuteAleart('error', 'Error', 'Area is required');
                      } else {

                        if (url_image == '') {
                          CuteAleart('error', 'Error', 'Main url_image is required');
                        } else {
                          var fd = new FormData();

                          /*var newFiles = $('#url_image')[0].files;
                          if (newFiles.length > 0) {
                            // If the user selected a new image, use the new image file
                            var newFile = newFiles[0];
                            fd.append('new_file', newFile); // Append the selected new file to the FormData object

                            // Display the new image file name next to the link
                            var ImageFileName = document.createElement('span');
                            ImageFileName.textContent = newFile.name;
                            url_image.appendChild(ImageFileName);
                          }*/

                          // ... Your existing code to append other form data ...

                          // Send the form data, including the images, to the server
                          /*$.ajax({
                            url: 'methods/addLandmark.php',
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                              Swal.fire('Info', 'Place added successfully', 'success');
                              $("#myform")[0].reset();
                              document.getElementById("url_image").innerHTML = ''; // Clear the selected new image after the form is submitted
                            }
                          });*/


                          //fd.append('file', files[0]);
                          fd.append('owner', owner);
                          fd.append('landmarkName', landmarkName);
                          fd.append('type', type);
                          fd.append('description', description);
                          fd.append('longitude', longitude);
                          fd.append('latitude', latitude);
                          fd.append('city', city);
                          fd.append('area', area);
                          fd.append('haveBooking', haveBooking);
                          fd.append('price', price);
                          fd.append('url_image', url_image);

                          $.ajax({
                            url: 'methods/addLandmark.php',
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                              Swal.fire('Info', 'Place added successfully', 'success');
                              $("#myform")[0].reset();
                            },
                            error: function(xhr, status, error) {
                              Swal.fire('Error', 'An error occurred while saving the place.', 'error');
                            }
                          });
                        }

                        // استدعاء الدالة "save" عند النقر على زر "Add Place +"
                        $(document).on('click', 'add', function() {
                          save();
                        });
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  </script>

  <script>
    //checked
    function removeOptions(selectElement) {
      var i, L = selectElement.options.length - 1;
      for (i = L; i >= 0; i--) {
        selectElement.remove(i);
      }
    }


    function clearData() {
      document.getElementById("landmarkName").value = '';
      document.getElementById("type").value = '';
      document.getElementById("latitude").value = '';
      document.getElementById("longitude").value = '';
      document.getElementById("city").value = '';
      document.getElementById("area").value = '';
      //document.getElementById("url_image").value = null;
      // Clear the url_image input field by changing its type temporarily
      document.getElementById("url_image").value = '';
      document.getElementById("haveBooking").value = '';
      tinyMCE.get('default').setContent('');
      document.getElementById("price").value = '';
      //$('#image')[0].files;
    }

    var js_data = '<?php echo json_encode($dataFromApi); ?>';
    var js_obj = JSON.parse(js_data);

    var js_data2 = '<?php echo json_encode($dataFromApi2); ?>';
    var js_obj2 = JSON.parse(js_data2);
    //console.log(js_data);
    const mySelect = document.getElementById('selectPlace');
    const mySelectServiceProvider = document.getElementById('serviceProvider');
    removeOptions(document.getElementById('selectPlace'));
    var firstItemFromApi;
    for (var i = 0; i < js_obj.length; i++) {
      if (i == 0) {
        firstItemFromApi = js_obj[0];
      }
      const newOption = document.createElement('option');
      // Create a new option element
      newOption.value = i; // Set the value for the new option
      newOption.textContent = js_obj[i]['landmarkName']; // Set the display text for the new option
      // Append the new option to the select element
      mySelect.appendChild(newOption);
      //removeOptions(document.getElementById('selectPlace'));
    }


    /*function fetchDataFromApi(apiUrl) {
        fetch(apiUrl)
          .then(response => response.json())
          .then(dataFromApi => {
            if (dataFromApi && dataFromApi.length > 0) {
              document.getElementById("landmarkName").value = dataFromApi[0]['landmarkName'];
              // تحديث باقي الحقول هنا
            } else {
              console.log('No data found from the API.');
            }
          })
          .catch(error => {
            console.error('Error fetching data from the API:', error);
          });
      }*/
    // Function to send the toggle value to the server-side PHP script
    function sendToggleValue() {
      //Fetch data from api
      // Fetch data from the API
      //autocomplete(document.getElementById("selectPlace"), customername);

      //////////////////////////////////////////
      //all box and field in page
      /////////////////////////////////////////
      // Get the toggle switch element
      const toggleSwitch = document.getElementById('toggleSwitch');
      const landmarkName = document.getElementById('divLandmarkName');
      const selectPlace = document.getElementById('divSelectPlace');
      const serviceProvider = document.getElementById('divServiceProvider');

      ////////////////////////////////////////////////////////////////////////////////

      ///////////////////////////////////////////////////////////////////////////////
      // Get the current selected state (checked or not)
      const toggleValue = toggleSwitch.checked ? 'on' : 'off';
      if (toggleValue === "off") {
        clearData();
        landmarkName.style.display = 'block';
        selectPlace.style.display = 'none';
        serviceProvider.style.display = 'none';
      } else {
        clearData();
        landmarkName.style.display = 'none';
        selectPlace.style.display = 'block';
        serviceProvider.style.display = 'block';
        // Add an event listener to the checkbox for the "change" event
        toggleSwitch.addEventListener('change', sendToggleValue);


      }
      //alert(toggleValue);
    }
    var selectedAPI = 0;
    mySelectServiceProvider.addEventListener('change', function() {
      // Get the selected value from the select element
      const selectedValue = mySelectServiceProvider.value;
      selectedAPI = selectedValue;
      clearData();
      if (selectedValue == 0) {
        removeOptions(document.getElementById('selectPlace'));
        for (var i = 0; i < js_obj.length; i++) {
          if (i == 0) {
            firstItemFromApi = js_obj[0];
          }
          const newOption = document.createElement('option');
          // Create a new option element
          newOption.value = i; // Set the value for the new option
          newOption.textContent = js_obj[i]['landmarkName']; // Set the display text for the new option
          // Append the new option to the select element
          mySelect.appendChild(newOption);
          //removeOptions(document.getElementById('selectPlace'));
        }
        ////////////////////////////////////////
        document.getElementById("landmarkName").value = firstItemFromApi['landmarkName'];
        document.getElementById("type").value = firstItemFromApi['type_name'];
        document.getElementById("latitude").value = firstItemFromApi['latitude'];
        document.getElementById("longitude").value = firstItemFromApi['longitude'];
        document.getElementById("city").value = firstItemFromApi['city'];
        var city; //= $(this).val();
        $.ajax({
          type: "GET",
          data: {
            'city': firstItemFromApi['city']
          },
          datatype: 'json',
          url: "methods/getAreas.php",
          success: function(data) {
            $("#area").html(data);
            document.getElementById("area").value = firstItemFromApi['areaID'];
          },
        });
        //document.getElementById("url_image").value = firstItemFromApi['url_image'];
        // Display the existing image URL as a clickable link
        document.getElementById('url_image').value = firstItemFromApi['url_image'];
        document.getElementById("haveBooking").value = firstItemFromApi['haveBooking'];
        tinyMCE.get('default').setContent(firstItemFromApi['description']);
        document.getElementById("price").value = firstItemFromApi['price'];
        ////////////////////////////////////////
      } else {
        removeOptions(document.getElementById('selectPlace'));
        var firstItemFromApi2;
        for (var i = 0; i < js_obj2.length; i++) {
          if (i == 0) {
            firstItemFromApi2 = js_obj2[0];
          }
          const newOption2 = document.createElement('option');
          // Create a new option element
          newOption2.value = i; // Set the value for the new option
          newOption2.textContent = js_obj2[i]['landmarkName']; // Set the display text for the new option
          // Append the new option to the select element
          mySelect.appendChild(newOption2);
          //removeOptions(document.getElementById('selectPlace'));
        }
        ////////////////////////////////////////
        document.getElementById("landmarkName").value = firstItemFromApi2['landmarkName'];
        document.getElementById("type").value = firstItemFromApi2['type_name'];
        document.getElementById("latitude").value = firstItemFromApi2['latitude'];
        document.getElementById("longitude").value = firstItemFromApi2['longitude'];
        document.getElementById("city").value = firstItemFromApi2['city'];
        var city; //= $(this).val();
        $.ajax({
          type: "GET",
          data: {
            'city': firstItemFromApi2['city']
          },
          datatype: 'json',
          url: "methods/getAreas.php",
          success: function(data) {
            $("#area").html(data);
            document.getElementById("area").value = firstItemFromApi2['areaID'];
          },
        });
        //document.getElementById("url_image").value = firstItemFromApi['url_image'];
        // Display the existing image URL as a clickable link
        document.getElementById('url_image').value = firstItemFromApi2['url_image'];
        document.getElementById("haveBooking").value = firstItemFromApi2['haveBooking'];
        tinyMCE.get('default').setContent(firstItemFromApi2['description']);
        document.getElementById("price").value = firstItemFromApi2['price'];
        ////////////////////////////////////////
      }
    });
    // Add an event listener to the select place
    mySelect.addEventListener('change', function() {
      // Get the selected value from the select element
      const selectedValue = mySelect.value;
      clearData();
      if (selectedAPI == 0) {
        //landmarkName.style.display = 'none';
        //selectPlace.style.display = 'block';
        ////////////////////////////////////////
        document.getElementById("landmarkName").value = js_obj[selectedValue]['landmarkName'];
        document.getElementById("type").value = js_obj[selectedValue]['type_name'];
        document.getElementById("latitude").value = js_obj[selectedValue]['latitude'];
        document.getElementById("longitude").value = js_obj[selectedValue]['longitude'];
        document.getElementById("city").value = js_obj[selectedValue]['city'];
        var city = $(this).val();
        $.ajax({
          type: "GET",
          data: {
            'city': js_obj[selectedValue]['city']
          },
          datatype: 'json',
          url: "methods/getAreas.php",
          success: function(data) {
            $("#area").html(data);
            document.getElementById("area").value = js_obj[selectedValue]['areaID'];
          },
        });
        //document.getElementById("url_image").value = js_obj[selectedValue]['url_image'];
        // Display the existing image URL as a clickable link
        document.getElementById('url_image').value = js_obj[selectedValue]['url_image'];
        document.getElementById("haveBooking").value = js_obj[selectedValue]['haveBooking'];
        tinyMCE.get('default').setContent(js_obj[selectedValue]['description']);
        document.getElementById("price").value = js_obj[selectedValue]['price'];
        //alert(selectedValue);
        // Show an alert with the selected value
        //alert(`You selected: ${selectedValue}`);
      } else {
        //landmarkName.style.display = 'none';
        //selectPlace.style.display = 'block';
        ////////////////////////////////////////
        document.getElementById("landmarkName").value = js_obj2[selectedValue]['landmarkName'];
        document.getElementById("type").value = js_obj2[selectedValue]['type_name'];
        document.getElementById("latitude").value = js_obj2[selectedValue]['latitude'];
        document.getElementById("longitude").value = js_obj2[selectedValue]['longitude'];
        document.getElementById("city").value = js_obj2[selectedValue]['city'];
        var city = $(this).val();
        $.ajax({
          type: "GET",
          data: {
            'city': js_obj2[selectedValue]['city']
          },
          datatype: 'json',
          url: "methods/getAreas.php",
          success: function(data) {
            $("#area").html(data);
            document.getElementById("area").value = js_obj2[selectedValue]['areaID'];
          },
        });
        //document.getElementById("url_image").value = js_obj2[selectedValue]['url_image'];
        // Display the existing image URL as a clickable link
        document.getElementById('url_image').value = js_obj2[selectedValue]['url_image'];
        document.getElementById("haveBooking").value = js_obj2[selectedValue]['haveBooking'];
        tinyMCE.get('default').setContent(js_obj2[selectedValue]['description']);
        document.getElementById("price").value = js_obj2[selectedValue]['price'];
      }
    });
    // Add an event listener to the checkbox for the "change" event
    const toggleSwitch = document.getElementById('toggleSwitch');
    toggleSwitch.addEventListener('change', function() {
      if (toggleSwitch.checked) {
        // تشغيل Switch الأول
        sendToggleValue();
        // إلغاء اشتراك Switch الثاني في حدث "change"
        //toggleSwitch2.removeEventListener('change', sendToggleValue2);
        // تحديث الصفحة تلقائيًا بعد إيقاف التبديل
        ///location.reload();
      }
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
  </script>

  <script src='../js/tinymce.min.js'></script>
  <script src="../js/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>