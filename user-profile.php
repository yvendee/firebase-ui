<?php
///dynamic_chart.php
include('includes/header.php');
include('includes/navbar.php');
include('includes/topbar.php');

////Include necessary files and initialize Firebase
require_once 'dbcon.php'; // Include your Firebase configuration file

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            background-color: blue;
        }

        .user-profile-container {
            width: 90%;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            /*padding: 20px;*/
            /*box-sizing: border-box;*/
        }

       
        .box {
          flex: 1; 
          /*border: 1px solid #000;*/
          margin: 1px;
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
            background-color: gray;
            width: 200px;  
            padding: 8px; 
            border-radius: 10px;
            border: 1px solid gray; 
        }

        .input-container input[type="password"] {
            background-color: gray;
            width: 200px;  
            padding: 8px; 
            border-radius: 10px;
            border: 1px solid gray; 
        }


        input[type="text"] {
          flex: 1;
          padding: 10px;
          height: 40px; 
          box-sizing: border-box; 
          border-radius: 10px;
        }

        input[type="password"] {
          flex: 1;
          padding: 10px;
          height: 40px; 
          box-sizing: border-box; 
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

        .text-box-title-user-profile {
          /*background-color: #74C365;*/
          width: 170px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: left;
          /*margin: 0 auto;*/
          padding-left: 10px;
          font-size: 20px;
          color: blue;
          font-weight: bold;
        /*border: 2px solid #333; */
        }

        .text-box-title-add-user {
          /*background-color: #74C365;*/
          width: 170px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: left;
          /*margin: 0 auto;*/
          padding-left: 10px;
          font-size: 20px;
          color: black;
          font-weight: bold;
        /*border: 2px solid #333; */
        }

        .text-box-table-header {
          /*background-color: #74C365;*/
          width: 100px; /* Set width of the box */
          height:30px; /* Set height of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: black;
          font-weight: bold;
        /*border: 2px solid #333; */
        }

        .text-box-table-data {
          /*background-color: #74C365;*/
          width: 100px; /* Set width of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: black;
          word-wrap: break-word;
        /*border: 2px solid #333; */
        }

        .text-box-table-edit-button {
          background-color: gray;
          width: 100px; /* Set width of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          font-weight: bold;
          word-wrap: break-word;
        /*border: 2px solid #333; */
        }

        .text-box-table-archive-button {
          background-color: #EED202;;
          width: 100px; /* Set width of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          font-weight: bold;
          word-wrap: break-word;
        /*border: 2px solid #333; */
        }

        .text-box-add-user-button {
          background-color: blue;
          width: 170px; /* Set width of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          font-weight: bold;
          word-wrap: break-word;
          border-radius: 10px;
        /*border: 2px solid #333; */
        }

        .text-box-save-button {
          background-color: blue;
          width: 100px; /* Set width of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          font-weight: bold;
          word-wrap: break-word;
          border-radius: 10px;
        /*border: 2px solid #333; */
        }

        .text-box-close-button {
          background-color: gray;
          width: 100px; /* Set width of the box */
          line-height: 30px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
          font-weight: bold;
          word-wrap: break-word;
          border-radius: 10px;
        /*border: 2px solid #333; */
        }


        .text-box-modal-label {

          text-align: left;
          font-size: 15px;
          padding-left: 1px;
          font-weight: bold;

        /*border: 2px solid #333; */
        }


      .immodal {
        display: none;
        position: fixed;
        z-index: 1;
        width: 500px; /* Set width of the modal */
        height: 500px; /* Set height of the modal */
        background-color: #fefefe;
        border: 1px solid #888;
      }


      /* Modal content */
      .immodal-content {
        position: relative;
        background-color: #fefefe;
        margin: 1px;
        /*margin: 15% auto;*/
        /*padding: 20px;*/
        /*border: 1px solid #888;*/
        /*width: 80%;*/
        /*position: relative;*/
      }

      /* Close button */
      .close {
        position: absolute;
        top: 0;
        right: 0;
        font-size: 20px;
        margin-right: 10px;
        cursor: pointer;
      }

      .solid-line {
        border: 1px solid gray;
        margin: 10px 0; /* Add some spacing */
      }

      #roleSelect {
        width: 200px; 
        height: 40px;
        background-color: gray; /* Set background color for the dropdown menu */
        color: black; /* Set text color for the dropdown menu */
        border: none; /* Remove border */
        border-radius: 5px; /* Add border radius */
        /*padding: 8px;*/
      }

      /* Style for the dropdown menu options */
      #roleSelect option {
        width: 200px; 
        height: 40px;
        background-color: gray; /* Set background color for options */
        color: black; /* Set text color for options */
      }



    </style>


</head>
    <body>

        <div id="immyModal" class="immodal" style="top: 30px; left: 350px;">
          <div class="immodal-content">
            <span class="close" onclick="hideModal()">&times;</span> <!-- Close button "x" -->
              
              <div class="box" style="flex-direction: row;">
                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                        <div class="text-box-title-add-user">Add User Data </div>
                  </div>
                  <div class="nested-box">
                        <div class="text-box-space">&nbsp;</div>
                  </div> 

                </div>
              </div>

              <hr class="solid-line">

              <div class="box" style="flex-direction: column;">
                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Employee ID </div>
                      <div class="input-container">
                          <input type="text">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Last Name </div>
                      <div class="input-container">
                          <input type="text">
                      </div>
                  </div> 
                </div>
                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Middle Name </div>
                      <div class="input-container">
                          <input type="text">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-modal-label"> First Name </div>
                      <div class="input-container">
                          <input type="text">
                      </div>
                  </div> 
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Role </div>
                      <div class="input-container">
                        <select id="roleSelect">
                            <option value="Area Coordinator">Area Coordinator</option>
                            <option value="Program Head">Program Head</option>
                        </select>
                      </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Password </div>
                      <div class="input-container">
                          <input type="password">
                      </div>
                  </div> 
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Area </div>
                      <div class="input-container">
                        <select id="roleSelect">
                            <option value="Area 1">Area 1</option>
                            <option value="Area 2">Area 2</option>
                            <option value="Area 3">Area 3</option>
                            <option value="Area 10">Area 10</option>
                        </select>
                      </div>
                  </div>
                  <div class="nested-box">
                    <div class="text-box-space" style= "width: 230px;">&nbsp;</div>
                  </div> 
                </div>

              </div>

              <hr class="solid-line">

              <div class="box" style="flex-direction: row;">
                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                        <div class="text-box-space">&nbsp;</div>
                  </div>
                  <div class="nested-box">
                        <div class="text-box-space">&nbsp;</div>
                  </div> 
                  <div class="nested-box">
                        <div class="text-box-close-button" id="adduserclose" onClick="AddUserClose()" >Close</div>
                  </div>
                  <div class="nested-box">
                        <div class="text-box-save-button" id="addusersave" onClick="AddUserSave()">Save</div>
                  </div>

                </div>
              </div>

            <!-- Button to close the modal -->
            <!-- <button onclick="hideModal()">Close</button> -->
          </div>
        </div>


        <div class="user-profile-container">

          <div class="nested-box">
                <div class="text-box-space">&nbsp;</div>
          </div> 

          <div class="box" style="flex-direction: row;">
            <div class="nested-box">
                  <div class="text-box-title-user-profile">User Profile</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-space">&nbsp;</div>
            </div> 

            <div class="nested-box">
                  <div class="text-box-add-user-button" id="adduser" onClick="AddUser()">+ Add</div>
            </div> 

          </div>

          <div class="nested-box">
                <div class="text-box-space">&nbsp;</div>
          </div>

          <div class="nested-box">
                <div class="text-box-space">&nbsp;</div>
          </div>

          <div class="box" style="flex-direction: row; ">
            <div class="nested-box" style="width: 10px;">
                  <div class="text-box-table-header" style="width: 10px;">ID</div>
            </div>

            <div class="nested-box" >
                  <div class="text-box-table-header" style="width: 170px;">Full&nbsp;Name</div>
            </div> 

            <div class="nested-box">
                  <div class="text-box-table-header">Email</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-table-header">Roles</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-table-header">Department</div>
            </div> 

            <div class="nested-box">
                  <div class="text-box-table-header">Edit</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-table-header">Archive</div>
            </div> 

<!--             <div class="nested-box">
                  <div style="width: 10px;">&nbsp;</div>
            </div>  -->
          </div>

          <div class="box" style="flex-direction: row;">
            <div class="nested-box" style="width: 10px;">
                  <div class="text-box-table-data" style="width: 10px;">1</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-table-data" style="width: 170px;">juanito&nbps;DelaCurz&nbsp;Example&nbsp;juanito&nbps;DelaCurz&nbsp;Exampl</div>
            </div> 

            <div class="nested-box">
                  <div class="text-box-table-data">test.test.test.test@test.test.tes.test..com</div>
            </div>


            <div class="nested-box">
                  <div class="text-box-table-data">Roles</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-table-data">Department</div>
            </div> 

            <div class="nested-box">
                  <div class="text-box-table-edit-button" id="edit1" onClick="RunEdit()">Edit</div>
            </div>

            <div class="nested-box">
                  <div class="text-box-table-archive-button" id="archive1" onClick="RunArchive()">Archive</div>
            </div> 

<!--             <div class="nested-box">
                  <div style="width: 10px;">&nbsp;</div>
            </div> -->
          </div> 

        </div>

      <script>

          // Function to show the modal
          function showModal() {
            document.getElementById('immyModal').style.display = "block";
          }

          // Function to hide the modal
          function hideModal() {
            document.getElementById('immyModal').style.display = "none";
          }


        function AddUserClose(){

        

          var addusercloseID = document.getElementById('adduserclose');
          addusercloseID.style.backgroundColor = 'red';

          setTimeout(function() {
            addusercloseID.style.backgroundColor = 'gray';
          }, 200); 
        }

        function AddUserSave(){

      

          var addusercloseID = document.getElementById('addusersave');
          addusercloseID.style.backgroundColor = 'red';

          setTimeout(function() {
            addusercloseID.style.backgroundColor = 'blue';
          }, 200); 
        }


        function AddUser(){

          showModal();

          var adduserID = document.getElementById('adduser');
          adduserID.style.backgroundColor = 'red';

          setTimeout(function() {
            adduserID.style.backgroundColor = 'blue';
          }, 200); 
        }


        function RunEdit(){

          var element = document.getElementById('edit1');
          element.style.backgroundColor = 'red';

          setTimeout(function() {
            element.style.backgroundColor = 'gray';
          }, 200); 
        }

        function RunArchive(){

          var element = document.getElementById('archive1');
          element.style.backgroundColor = 'red';

          setTimeout(function() {
            element.style.backgroundColor = '#EED202';
          }, 200); 
        }

        function EPtogglenativedropdown() {
          var nativedropdown = document.querySelector('.nativedropdown');
          nativedropdown.classList.toggle('active');
        }

        function selectOptionForDropDown(option) {
          var selectedOptionForDropDownElement = document.getElementById('selectedOptionForDropDown');
          selectedOptionForDropDownElement.textContent = option;
          // localStorage.setItem("month_year", "March 2024");
          // localStorage.setItem("month_year", option);
          EPtogglenativedropdown(); // Close the nativedropdown after selection
          // window.location.replace('graph.html');
          //
        }


        function UserInfo(){
            var userinfoID = document.getElementById('userinfo');
            userinfoID.classList.add("text-underline");

            var editinfoID = document.getElementById('editinfo');
            editinfoID.classList.remove("text-underline");

            var dynamicinput1ID = document.getElementById('dynamic-input1');
            dynamicinput1ID.innerHTML = "Role As";

            var dynamicinput2ID = document.getElementById('dynamic-input2');
            dynamicinput2ID.innerHTML = "Department";

            // Set placeholder dynamically for roleAsInput
            var roleAsPlaceholder = document.getElementById('dynamic-input1').textContent.trim();
            document.getElementById('roleAsInput').setAttribute('placeholder', roleAsPlaceholder);

            // Set placeholder dynamically for departmentInput
            var departmentPlaceholder = document.getElementById('dynamic-input2').textContent.trim();
            document.getElementById('departmentInput').setAttribute('placeholder', departmentPlaceholder);


        }

        function EditInfo(){

            var userinfoID = document.getElementById('userinfo');
            userinfoID.classList.remove("text-underline");

            var editinfoID = document.getElementById('editinfo');
            editinfoID.classList.add("text-underline");

            var dynamicinput1ID = document.getElementById('dynamic-input1');
            dynamicinput1ID.innerHTML = "Password";

            var dynamicinput2ID = document.getElementById('dynamic-input2');
            dynamicinput2ID.innerHTML = "Confirm Password";

            // Set placeholder dynamically for roleAsInput
            var roleAsPlaceholder = document.getElementById('dynamic-input1').textContent.trim();
            document.getElementById('roleAsInput').setAttribute('placeholder', roleAsPlaceholder);

            // Set placeholder dynamically for departmentInput
            var departmentPlaceholder = document.getElementById('dynamic-input2').textContent.trim();
            document.getElementById('departmentInput').setAttribute('placeholder', departmentPlaceholder);

            // var dynamicinput2ID = document.getElementById('dynamic-input2');
            // dynamicinput2ID.textContent("Confirm Password");

          // alert("editinfo");
        }

      </script>


    </body>
</html>
