<?php
// dynamic_chart.php
include('includes/header.php');
include('includes/navbar.php');
include('includes/topbar.php');

//Include necessary files and initialize Firebase
require_once 'dbcon.php'; // Include your Firebase configuration file

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            background-color: blue;
        }

        .record-management-container {
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
          margin: 10px;
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

        .text-box-folder-name {
          /*background-color: #74C365;*/
          width: 130px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          font-weight: bold;
          color: black;
          word-wrap: break-word;
        /*border: 2px solid #333; */
        }

        .text-box-view-button {
          background-color: blue;
          width: 100px; /* Set width of the box */
          height:35px; /* Set height of the box */
          line-height: 35px;
          text-align: center;
          letter-spacing: 2px;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          border-radius: 10px;
          /*border: 2px solid #333; */
        }

        .text-box-record-management {

          width: 400px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: center;
          /*margin: 0 auto;*/
          font-size: 30px;
          font-weight: bold;
          color: black;
          word-wrap: break-word;

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

    </style>


</head>
    <body>
        <div class="record-management-container">

          <div class="box" style="flex-direction: column; ">


              <dix class="nested-box" > 
                <div class="text-box-record-management">&nbsp;</div>
              </dix>

              <dix class="nested-box" > 
                <div class="text-box-record-management"> RECORD MANAGEMENT</div>
              </dix>

              <dix class="nested-box" > 
                <div class="text-box-record-management">&nbsp;</div>
              </dix>

            <div style="max-height: 600px; overflow-y: auto;">

              <dix class="nested-box" >
                <div class="box" style="flex-direction: row;">
                  <div class="box" style="flex-direction: column;">

                    <div class="nested-box">
                        <div class="image_container">
                            <img src="new_images/modern-folder-icon.png" alt="Add Button">
                        </div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-folder-name">Alcucucao</div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                    </div>
                  </div>

                  <div class="box" style="flex-direction: column;">

                    <div class="nested-box">
                        <div class="image_container">
                            <img src="new_images/modern-folder-icon.png" alt="Add Button">
                        </div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-folder-name">Alcucucao</div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                    </div>
                  </div>

                  <div class="box" style="flex-direction: column;">

                    <div class="nested-box">
                        <div class="image_container">
                            <img src="new_images/modern-folder-icon.png" alt="Add Button">
                        </div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-folder-name">Alcucucao</div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                    </div>
                  </div>
                </div>
              </dix>


              <dix class="nested-box" >
                <div class="box" style="flex-direction: row;">
                  <div class="box" style="flex-direction: column;">

                    <div class="nested-box">
                        <div class="image_container">
                            <img src="new_images/modern-folder-icon.png" alt="Add Button">
                        </div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-folder-name">Alcucucao</div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                    </div>
                  </div>

                  <div class="box" style="flex-direction: column;">

                    <div class="nested-box">
                        <div class="image_container">
                            <img src="new_images/modern-folder-icon.png" alt="Add Button">
                        </div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-folder-name">Alcucucao</div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                    </div>
                  </div>

                  <div class="box" style="flex-direction: column;">

                    <div class="nested-box">
                        <div class="image_container">
                            <img src="new_images/modern-folder-icon.png" alt="Add Button">
                        </div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-folder-name">Alcucucao</div>
                    </div>

                    <div class="nested-box">
                        <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                    </div>
                  </div>
                </div>
              </dix>

<!--             <dix class="nested-box" >
              <div class="box" style="flex-direction: row;">
                <div class="box" style="flex-direction: column;">

                  <div class="nested-box">
                      <div class="image_container">
                          <img src="new_images/modern-folder-icon.png" alt="Add Button">
                      </div>
                  </div>

                  <div class="nested-box">
                      <div class="text-box-folder-name">Alcucucao</div>
                  </div>

                  <div class="nested-box">
                      <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                  </div>
                </div>

                <div class="box" style="flex-direction: column;">

                  <div class="nested-box">
                      <div class="image_container">
                          <img src="new_images/modern-folder-icon.png" alt="Add Button">
                      </div>
                  </div>

                  <div class="nested-box">
                      <div class="text-box-folder-name">Alcucucao</div>
                  </div>

                  <div class="nested-box">
                      <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                  </div>
                </div>

                <div class="box" style="flex-direction: column;">

                  <div class="nested-box">
                      <div class="image_container">
                          <img src="new_images/modern-folder-icon.png" alt="Add Button">
                      </div>
                  </div>

                  <div class="nested-box">
                      <div class="text-box-folder-name">Alcucucao</div>
                  </div>

                  <div class="nested-box">
                      <div class="text-box-view-button" id="viewbutton1" onClick="viewbutton1()">View</div>
                  </div>
                </div>
              </div>
            </dix> -->
            </div>

          </div>

        </div>

      <script>

        function viewbutton1() {
          var element = document.getElementById('viewbutton1');
          element.style.backgroundColor = 'red';
          setTimeout(function() {
            element.style.backgroundColor = 'blue';
          }, 200);
        }



      </script>


    </body>
</html>
