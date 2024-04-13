<?php
// // dynamic_chart.php
// include("includes/header.php");
// include("includes/navbar.php");
// include("includes/topbar.php");

// //Include necessary files and initialize Firebase
// require_once "dbcon.php"; // Include your Firebase configuration file

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script type="text/javascript">

  function renderYearlist(data) {
      let yearlistContainer = $('#yearlist-container');

  
    yearlistContainer.empty();
    data.forEach((item, index) => {
      console.log(item);
    
        let nfbox1 = $('<a>').attr('href', '#').text(item).on('click', function() {
            selectOptionForDropDown(item);
        });
        yearlistContainer.append(nfbox1);
    });

  }

   function fetchYearList() {
        fetch('+mockup/edit-profile-year.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                renderYearlist(data);
                setDefaultYear(data[0]);
            })
            .catch(error => console.error('Error fetching year list:', error));
    }

    // Call the fetchYearList function when the page loads
    fetchYearList();

    function setDefaultYear(year){
      var selectedOptionForDropDownElement = document.getElementById('selectedOptionForDropDown');
          selectedOptionForDropDownElement.textContent = year;
    }
    
  var userinfo = true;

    // Function to handle file selection
    function handleFileSelect(event) {
        const file = event.target.files[0];
        uploadImage(file);
    }

    // Function to upload the selected image
    function uploadImage(file) {
        if (!file) {
            console.log('No file selected.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);

        fetch('+mockup/edit-profile-upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log('Image uploaded successfully:', data);
        })
        .catch(error => {
            console.error('Error uploading image:', error);
        });
    }

    // DOMContentLoaded event listener
    document.addEventListener("DOMContentLoaded", function() {
        // Get the upload button element
        const uploadButton = document.getElementById('uploadButton');
        // Add event listener to the upload button
        uploadButton.addEventListener('click', function() {
            // Trigger click event on the file input element
            document.getElementById('fileInput').click();
        });

        // Add event listener to the file input element for handling file selection
        const fileInput = document.getElementById('fileInput');
        fileInput.addEventListener('change', handleFileSelect);
    });

  function UploadButton() {
      var element = document.getElementById("uploadbutton");
      element.style.backgroundColor = "red";
      setTimeout(function() {
          element.style.backgroundColor = "#EED202";
      }, 200);
  }

  function SaveButton() {
      var element = document.getElementById("savebutton");
      element.style.backgroundColor = "red";
      setTimeout(function() {
          element.style.backgroundColor = "#EED202";
      }, 200);
      alert("save button click");
  }

  function SetButton() {
      var element = document.getElementById("setbutton");
      element.style.backgroundColor = "red";
      setTimeout(function() {
          element.style.backgroundColor = "#EED202";
      }, 200);

      var selectedOptionForDropDownElement = document.getElementById('selectedOptionForDropDown');
      var selected_year = selectedOptionForDropDownElement.textContent;
      alert("selected year is " + selected_year);
  }

  function UpdateButton() {
      var element = document.getElementById("updatebutton");
      element.style.backgroundColor = "red";
      setTimeout(function() {
          element.style.backgroundColor = "#EED202";
      }, 200);

      var data = {}; // Create an empty object to store the user data

      if (userinfo) {
          // If user info is available
          data.userinfo = true;
          data.lastname = document.getElementById("lastname").value;
          data.middlename = document.getElementById("middlename").value;
          data.firstname = document.getElementById("firstname").value;
          data.suffix = document.getElementById("suffix").value;
          data.extension = document.getElementById("extension").value;
          data.email = document.getElementById("email").value;
          data.role = document.getElementById("roleAsInput").value;
          data.department = document.getElementById("departmentInput").value;
      } else {
          // If user info is not available, you can still gather the data
          data.userinfo = false;
          data.lastname = document.getElementById("lastname").value;
          data.middlename = document.getElementById("middlename").value;
          data.firstname = document.getElementById("firstname").value;
          data.suffix = document.getElementById("suffix").value;
          data.extension = document.getElementById("extension").value;
          data.email = document.getElementById("email").value;
          data.password = document.getElementById("roleAsInput").value;
          data.confirmpassword = document.getElementById("departmentInput").value;
      }

      // Convert the data object to JSON format
      var jsonData = JSON.stringify(data);

      // Log the JSON data to the console
      console.log(jsonData);
      alert(jsonData);
  }

  function EPtogglenativedropdown() {
      var nativedropdown = document.querySelector(".nativedropdown");
      nativedropdown.classList.toggle("active");
  }

  function selectOptionForDropDown(option) {
      var selectedOptionForDropDownElement = document.getElementById("selectedOptionForDropDown");
      selectedOptionForDropDownElement.textContent = option;
      EPtogglenativedropdown(); // Close the nativedropdown after selection
  }

  function UserInfo() {
      userinfo = true;
      var userinfoID = document.getElementById("userinfo");
      userinfoID.classList.add("text-underline");

      var editinfoID = document.getElementById("editinfo");
      editinfoID.classList.remove("text-underline");

      var dynamicinput1ID = document.getElementById("dynamic-input1");
      dynamicinput1ID.textContent = "Role As";

      var dynamicinput2ID = document.getElementById("dynamic-input2");
      dynamicinput2ID.textContent = "Department";

      // Set placeholder dynamically for roleAsInput
      var roleAsPlaceholder = document.getElementById("dynamic-input1").textContent.trim();
      document.getElementById("roleAsInput").setAttribute("placeholder", roleAsPlaceholder);

      // Set placeholder dynamically for departmentInput
      var departmentPlaceholder = document.getElementById("dynamic-input2").textContent.trim();
      document.getElementById("departmentInput").setAttribute("placeholder", departmentPlaceholder);
  }

  function EditInfo() {
      userinfo = false;

      var userinfoID = document.getElementById("userinfo");
      userinfoID.classList.remove("text-underline");

      var editinfoID = document.getElementById("editinfo");
      editinfoID.classList.add("text-underline");

      var dynamicinput1ID = document.getElementById("dynamic-input1");
      dynamicinput1ID.textContent = "Password";

      var dynamicinput2ID = document.getElementById("dynamic-input2");
      dynamicinput2ID.textContent = "Confirm Password";

      // Set placeholder dynamically for roleAsInput
      var roleAsPlaceholder = document.getElementById("dynamic-input1").textContent.trim();
      document.getElementById("roleAsInput").setAttribute("placeholder", roleAsPlaceholder);

      // Set placeholder dynamically for departmentInput
      var departmentPlaceholder = document.getElementById("dynamic-input2").textContent.trim();
      document.getElementById("departmentInput").setAttribute("placeholder", departmentPlaceholder);
  }

</script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            background-color: blue;
        }

        .edit-profile-container {
            width: 90%;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /*margin-top: 20px;*/
            /*padding: 20px;*/
            /*box-sizing: border-box;*/
        }

       
        .box {
          flex: 1; 
          /*border: 1px solid #000;*/
          /*margin: 10px;*/
          display: flex;
          align-items: center; 
          justify-content: center; 
          flex-direction: column; 

        }

        
        .nested-box {
          flex: 1;
          /*border: 1px solid #000; */
          margin: 5px;
        }

        .input-container {
            display: inline-flex;
            margin: 15px;

        }


        .input-container input[type="text"] {
            background-color: #318CE7;
            width: 200px;  
            padding: 8px; 
            border-radius: 10px;
        }


        input[type="text"] {
          flex: 1;
          padding: 10px;
          height: 40px; 
          box-sizing: border-box; 
          border-radius: 10px;
        }

        .input-container2 input[type="text"] {
            background-color: #318CE7;
            width: 300px;  
            padding: 8px; 
            border-radius: 10px;
        }

        .input-container3 input[type="text"] {
            width: 200px;  
            padding: 8px; 
            border-radius: 10px;
        }

        .image_container {
            width: 100px; 
            height: auto; /* Maintain aspect ratio */
        }

        .image_container img {
            width: 100%; 
            height: auto; /* Maintain aspect ratio */
        }

        .text-box-user-status {
          /*background-color: #74C365;*/
          width: 300px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          font-weight: bold;
          color: black;
        /*border: 2px solid #333; */
        }

        .text-box-upload-profile {
          background-color: #EED202;
          width: 170px; /* Set width of the box */
          height:45px; /* Set height of the box */
          line-height: 45px;
          text-align: center;
          letter-spacing: 2px;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          border-radius: 10px;
          /*border: 2px solid #333; */
        }

        .text-box-add-year {
          width: 170px; /* Set width of the box */
          height: 30px; /* Set height of the box */
          line-height: 30px;
          text-align: left;
          font-weight: bold;
/*          letter-spacing: 2px;*/
          margin: 0 auto;
          font-size: 15px;
          color: black;
        }

        .text-box-save-btn {
          background-color: #EED202;
          width: 100px; /* Set width of the box */
          height: 30px; /* Set height of the box */
          line-height: 30px;
          text-align: center;
          font-weight: bold;
/*          letter-spacing: 2px;*/
          margin: 0 auto;
          font-size: 15px;
          color: white;
          border-radius: 10px
        }

          .text-box-update-button {
          background-color: #EED202;
          width: 100px; /* Set width of the box */
          height: 40px; /* Set height of the box */
          line-height: 40px;
          text-align: center;
          font-weight: bold;
/*          letter-spacing: 2px;*/
          margin: 0 auto;
          font-size: 15px;
          color: white;
          border-radius: 10px
        }

        .nativedropdown-box-add-year {
          width: 170px; /* Set width of the box */
          height: 30px; /* Set height of the box */
          line-height: 30px;
          text-align: left;
          font-weight: bold;
/*          letter-spacing: 2px;*/
          margin: 0 auto;
          font-size: 15px;
          color: black;
        }

        /* Style the nativedropdown button */
        .nativedropdown {
          background-color: #f1f1f1;
          color: #333;
          padding: 10px;
          font-size: 16px;
          border: none;
          cursor: pointer;
          position: relative;
          display: inline-block;
          width: 150px; /* Adjust the width as needed */
        }

        /* Style the down arrow */
        .nativedropdown::after {
          content: "\25BC"; /* Unicode character for down arrow */
          font-size: 14px;
          position: absolute;
          right: 10px;
          top: 50%;
          transform: translateY(-50%);
        }

        /* Style the nativedropdown content (initially hidden) */
        .nativedropdown-content {
          display: none;
          position: absolute;
          background-color: #fff;
          box-shadow: 0 8px 16px rgba(0,0,0,0.2);
          z-index: 1;
          right: 0;
          width: 100%; /* Adjust the width as needed */
          max-height: 150px; /* Set the maximum height */
          overflow-y: auto; /* Enable vertical scrolling if needed */
        }

        /* Style the nativedropdown links */
        .nativedropdown-content a {
          color: #333;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          width: 100%; /* Adjust the width as needed */
        }

        /* Change color on hover */
        .nativedropdown-content a:hover {
          background-color: #EED202;
        }

        /* Show the nativedropdown menu on click */
        .nativedropdown.active .nativedropdown-content {
          display: block;
        }

        .text-box-edit-profile {
          /*background-color: #74C365;*/
          width: 300px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: left;
          margin: 0 auto;
          font-size: 15px;
          font-weight: bold;
          color: black;
        /*border: 2px solid #333; */
        }

        .text-box-tab {
          /*background-color: #74C365;*/
          width: 100px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          font-weight: bold;
          color: black;
        /*border: 2px solid #333; */
        }

        .text-box-edit-profile-null {
          /*background-color: #74C365;*/
          width: 100px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: left;
          margin: 0 auto;
          font-size: 15px;
          font-weight: bold;
          color: black;
        /*border: 2px solid #333; */
        }

        .text-underline {
          text-decoration: underline;
        }

        .text-box-upload-profile {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        /* Hide the default file input */
        #fileInput {
            display: none;
        }

    </style>





</head>
    <body>
        <div class="edit-profile-container">

            <div class="box" style="flex-direction: row;">

              <div class="box" style="flex-direction: column;">

                <div class="nested-box">
                    <div class="image_container">
                        <img src="new_images/user-avatar.png" alt="Add Button">
                    </div>
                </div>

                <div class="nested-box">
                    <div class="text-box-user-status">Area Coordinator</div>
                </div>

<!--                 <div class="nested-box">
                    <div class="text-box-upload-profile" id="uploadbutton" onClick="UploadButton()">Upload Profile</div>
                </div> -->

<div class="nested-box">
    <!-- Hidden file input element -->
    <input type="file" id="fileInput" style="display: none;">
    <!-- Upload button -->
    <div class="text-box-upload-profile" id="uploadButton">Upload</div>
</div>

                <div class="nested-box">
                    <div class="text-box">&nbsp;</div>
                </div>

                <div class="nested-box">
                    <div class="text-box">&nbsp;</div>
                </div>

                <div class="nested-box">
                    <div class="text-box-add-year">Add&nbsp;Year</div>
                </div>                

                <div class="nested-box">
                    <div class="text-box-save-btn" id="savebutton" onClick="SaveButton()">Save</div>
                </div>

                <div class="nested-box">
                    <div class="nativedropdown" onclick="EPtogglenativedropdown()">
                        <span id="selectedOptionForDropDown" id="default-option"></span>
                        <div class="nativedropdown-content">
                          <div id="yearlist-container"> </div>

                        </div>
                    </div>
                </div> 
            

                <div class="nested-box">
                    <div class="text-box-save-btn" id="setbutton" onClick="SetButton()">Set</div>
                </div> 


              </div>

              <div class="box" style="flex-direction: column;">

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-edit-profile" style="font-size: 20px;">Edit Profile</div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-edit-profile-null" style="width: 100px;">&nbsp;</div>
                  </div>
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="box" style="flex-direction: row;">
                    <div class="nested-box">
                        <div class="text-box-tab text-underline" id="userinfo" onClick="UserInfo()">User Info</div>
                    </div>
                    <div class="nested-box">
                        <div class="text-box-tab" id="editinfo" onClick="EditInfo()">Edit Info</div>
                    </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-edit-profile-null" style="width: 160px;">&nbsp;</div>
                  </div>
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div> Last Name </div>
                      <div class="input-container3">
                          <input type="text" placeholder="Lastname" id="lastname">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div> Middle Name </div>
                      <div class="input-container3">
                          <input type="text" placeholder="Middlename" id="middlename">
                      </div>
                  </div>
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div> First Name </div>
                      <div class="input-container3">
                          <input type="text" placeholder="Firstname" id="firstname">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div> Suffix </div>
                      <div class="input-container3">
                          <input type="text" placeholder="Suffix" id="suffix">
                      </div>
                  </div>
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div> Extension </div>
                      <div class="input-container3">
                          <input type="text" placeholder="Extension" id="extension">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div> Email Address </div>
                      <div class="input-container3">
                          <input type="text" placeholder="Email Address" id="email">
                      </div>
                  </div>
                </div>

                <div class="box" style="flex-direction: row;">
                    <div class="nested-box">
                        <div id="dynamic-input1">Role As</div>
                        <div class="input-container3">
                            <input type="text" id="roleAsInput" placeholder="Role As">
                        </div>
                    </div>
                    <div class="nested-box">
                        <div id="dynamic-input2">Department</div>
                        <div class="input-container3">
                            <input type="text" id="departmentInput" placeholder="Department">
                        </div>
                    </div>
                </div>

                <div class="box" style="flex-direction: row;">
                    <div class="nested-box">
                        <div class="text-box-update-button" id="updatebutton" onClick="UpdateButton()">Update</div>
                    </div>
                    <div class="nested-box">
                        <div style="width: 250px;" >&nbsp;</div>
                    </div>
                </div>

              </div>

              <div class="nested-box">
                    <div class="text-box-space">&nbsp;</div>
              </div> 

            </div>




    </body>
</html>
