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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>


      function renderTableData(data) {
          // Assuming you have an element with the ID "alerts-container" to display the alerts
          let userprofileContainer = $('#user-profile-table-container');

          // Clear existing content
          userprofileContainer.empty();

          // Loop through the data and append each alert to the container

          // data.forEach(item => { // no index
          data.forEach((item, index) => {
            console.log(item.ID);

              let Box1 = $('<div>').addClass('box').css('flex-direction', 'row');
              // let nfbox1 = $('<div>').addClass('nested-box');

              let nfbox1 = $('<div>').addClass('nested-box').css({
                // 'background-color': 'red', // Example background color
                'width': '20px' // Example margin
                // 'border-radius': '5px' // Example border radius
              });
              let nsbox1 = $('<div>').addClass('text-box-table-data').css({
                // 'background-color': 'red', // Example background color
                'width': '20px' // Example margin
              }).text(item.ID.toString());
              nfbox1.append(nsbox1);
              Box1.append(nfbox1);


              let nfbox2 = $('<div>').addClass('nested-box');
              let nsbox2 = $('<div>').addClass('text-box-table-data').css({
                'width': '170px' 
              }).text(item.Fullname.toString());
              nfbox2.append(nsbox2);
              Box1.append(nfbox2);

              let nfbox3 = $('<div>').addClass('nested-box');
              let nsbox3 = $('<div>').addClass('text-box-table-data').text(item.Email.toString());
              nfbox3.append(nsbox3);
              Box1.append(nfbox3);

              let nfbox4 = $('<div>').addClass('nested-box');
              let nsbox4 = $('<div>').addClass('text-box-table-data').text(item.Roles.toString());
              nfbox4.append(nsbox4);
              Box1.append(nfbox4);

              let nfbox5 = $('<div>').addClass('nested-box');
              let nsbox5 = $('<div>').addClass('text-box-table-data').text(item.Department.toString());
              nfbox5.append(nsbox5);
              Box1.append(nfbox5);

              let nfbox6 = $('<div>').addClass('nested-box');
              // let nsbox6 = $('<div>').addClass('text-box-table-edit-button').attr('id', 'edit'+ (index + 1)).text('Edit').on('click', RunEdit);

              let nsbox6 = $('<div>').addClass('text-box-table-edit-button').attr('id', 'edit'+ (index + 1)).text('Edit').on('click', function() {RunEdit('edit' + (index + 1))});




              nfbox6.append(nsbox6);
              Box1.append(nfbox6);

              let nfbox7 = $('<div>').addClass('nested-box');
              let nsbox7 = $('<div>').addClass('text-box-table-archive-button').attr('id', 'archive'+ (index + 1)).text('Archive').on('click', function() {RunArchive('archive' + (index + 1))});
              nfbox7.append(nsbox7);
              Box1.append(nfbox7);

              userprofileContainer.append(Box1);


              // let secondContentContainer = $('<div>');


              // let firstBox = $('<div>').addClass('box').css('flex-direction', 'row');

              
              // let nfbox2 = $('<div>').addClass('nested-box');
              // let nfbox3 = $('<div>').addClass('nested-box');

              // let secondBox = $('<div>').addClass('box').css('flex-direction', 'row');
              // let nsbox1 = $('<div>').addClass('nested-box');

              // let imageContainer = $('<div>').addClass('image_container');
              // let image = $('<img>').addClass('image').attr('src', `images/${item.alert_id.toLowerCase()}-icon.png`).attr('alt', `${item.alert_id} Status`);

              // nsbox1.append(imageContainer, image);

              // let nsbox2 = $('<div>').addClass('nested-box');

              // // Create the nested box for the alert status

              // let strongStatus = $('<strong>').text(item.alert_id.toUpperCase()).addClass('alertTitle');
              // let underline = $('<div>').addClass('underline');
              // let statusText = $('<div>').text(item.message).addClass('alertMessage');

              // nsbox2.append(strongStatus, underline, statusText);


              // secondBox.append(nsbox1, nsbox2);
              // nfbox1.append(secondBox);

              // // Create the nested box for the datetime
              // let datetimeBox = $('<div>').addClass('dateInfo');
              // let formattedDatetime = new Date(item.datetime).toLocaleString();
              // // // Append the formatted datetime to the datetime box
              // datetimeBox.text(formattedDatetime);
              // nfbox3.append(datetimeBox);

              // firstBox.append(nfbox1, nfbox2, nfbox3);
              // secondContentContainer.append(firstBox);

              // alertsContainer.append(secondContentContainer);
          });
      }

    function fetchData() {
      $.ajax({
          url: '+mockup/user-profile-mock.php', // Assuming PHP file name is 'mockup_data.php'
          type: 'GET',
          dataType: 'json',
          success: function(data) {
              // Filter and print only the entries with Department 'Marketing'
              // var marketingEntries = data.filter(function(item) {
              //     return item.Department === 'Marketing';
              // });
              // console.log(marketingEntries);

              renderTableData(data);
          },
          error: function(xhr, status, error) {
              console.error('Error:', error); // Print error in console log if any
          }
      });

    }

    $(document).ready(function(){
      fetchData();
    });

    </script>

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

      #role {
        width: 200px; 
        height: 40px;
        background-color: gray; /* Set background color for the dropdown menu */
        color: black; /* Set text color for the dropdown menu */
        border: none; /* Remove border */
        border-radius: 5px; /* Add border radius */
        /*padding: 8px;*/
      }

      /* Style for the dropdown menu options */
      #role option {
        width: 200px; 
        height: 40px;
        background-color: gray; /* Set background color for options */
        color: black; /* Set text color for options */
      }

      #arearole {
        width: 200px; 
        height: 40px;
        background-color: gray; /* Set background color for the dropdown menu */
        color: black; /* Set text color for the dropdown menu */
        border: none; /* Remove border */
        border-radius: 5px; /* Add border radius */
        /*padding: 8px;*/
      }

      /* Style for the dropdown menu options */
      #arearole option {
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
                      <div class="input-container" >
                          <input type="text" id="employeeid">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-modal-label" > Last Name </div>
                      <div class="input-container" >
                          <input type="text" id="lastname">
                      </div>
                  </div> 
                </div>
                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label" > Middle Name </div>
                      <div class="input-container" >
                          <input type="text" id="middlename">
                      </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-modal-label" > First Name </div>
                      <div class="input-container" >
                          <input type="text" id="firstname">
                      </div>
                  </div> 
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Role </div>
                      <div class="input-container">
                        <select id="role">
                            <option value="Area Coordinator">Area Coordinator</option>
                            <option value="Program Head">Program Head</option>
                        </select>
                      </div>
                  </div>
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Password </div>
                      <div class="input-container">
                          <input type="password" id="password">
                      </div>
                  </div> 
                </div>

                <div class="box" style="flex-direction: row;">
                  <div class="nested-box">
                      <div class="text-box-modal-label"> Area </div>
                      <div class="input-container">
                        <select id="arearole">
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


          </div>



          <div id="user-profile-table-container"> </div>


<!--           <div class="box" style="flex-direction: row;">
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
          </div>  -->

        </div>

      <script>

        //function RunEdit(){

        //  var element = document.getElementById('edit1');
        //  element.style.backgroundColor = 'red';

        //  setTimeout(function() {
        //    element.style.backgroundColor = '#EED202';
        //  }, 200); 
        //}

       function RunArchive(buttonId){

          

          var element = document.getElementById(buttonId);
          element.style.backgroundColor = 'red';

          setTimeout(function() {
            element.style.backgroundColor = '#EED202';
          }, 200); 

          alert(buttonId.toString());
        }

        function RunEdit(buttonId) {

            var editButton = document.getElementById(buttonId);
            editButton.style.backgroundColor = 'red';

            setTimeout(function() {
                editButton.style.backgroundColor = 'gray';
            }, 200); 

            alert(buttonId.toString());
        }


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

          alert("Close");
        }

        function AddUserSave(){

          var addusercloseID = document.getElementById('addusersave');
          addusercloseID.style.backgroundColor = 'red';

          setTimeout(function() {
            addusercloseID.style.backgroundColor = 'blue';
          }, 200); 

          // alert("Save");

          var employeeid = document.getElementById("employeeid").value;
          var lastname = document.getElementById("lastname").value;
          var firstname = document.getElementById("firstname").value;
          var middlename = document.getElementById("middlename").value;
          var password = document.getElementById("password").value;
    
          // var employeeid = document.getElementById("employeeid").value;
          var role = document.getElementById("role");
          var select_role = role.options[role.selectedIndex].value;
          var areadrole = document.getElementById("arearole");
          var select_arearole = areadrole.options[areadrole.selectedIndex].value;

          // // Display the value in the console
          console.log("Employee ID:", employeeid);
          console.log("Last Name:", lastname);
          console.log("Middle Name:", middlename);
          console.log("First Name:", firstname);
          console.log("Password:", password);

          console.log("Employee ID:", employeeid);
          console.log("Role:", select_role);
          console.log("Area Role:", select_arearole);

          var employeeData = {
              "Employee ID": employeeid,
              "Last Name": lastname,
              "Middle Name": middlename,
              "First Name": firstname,
              "Password": password,
              "Role": select_role,
              "Area Role": select_arearole
          };

          // console.log(JSON.stringify(employeeData));
          alert(JSON.stringify(employeeData));

        }


        function AddUser(){

          showModal();

          var adduserID = document.getElementById('adduser');
          adduserID.style.backgroundColor = 'red';

          setTimeout(function() {
            adduserID.style.backgroundColor = 'blue';
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