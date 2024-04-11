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
    <title>Messaging</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">

      function setReceipt(contactname) {

        var receiptHandle = document.getElementById("receiptid");
        receiptHandle.textContent = "To: " + contactname;

      }

      function renderContacts(data) {
          if (data.contacts && data.contacts.length > 0) {
              data.contacts.forEach(contact => {
                  console.log(contact.name);
              });
          } else {
              console.log("No contacts found.");
          }

          let contactsContainer = $('#contacts-container');

          // Clear existing content
          contactsContainer.empty();


          // const contact = data.contacts[0];

          // let nfbox1 = $('<div>').addClass('nested-box hover-contact-list').css({
          //     'margin': '5px'
          // });
          // let nsbox1 = $('<div>').addClass('text-box-contact-list hover-contact-list').text(contact.name.toString()).attr('id', 'contact'+ (0)).on('click', function() {RunContact('contact' + (0))});

          // nfbox1.append(nsbox1);
          // contactsContainer.append(nfbox1); // Append contact element to contacts container


          // data.contacts.forEach((contact, index) => { // Iterate over contacts
          for (let index = 0; index < data.contacts.length; index++) {
              const contact = data.contacts[index];

              let nfbox1 = $('<div>').addClass('nested-box hover-contact-list').css({
                  'margin': '5px'
              });
              let nsbox1 = $('<div>').addClass('text-box-contact-list hover-contact-list').text(contact.name.toString()).attr('id', 'contact'+ (index)).on('click', function() {RunContact('contact' + (index))});

              nfbox1.append(nsbox1);
              contactsContainer.append(nfbox1); // Append contact element to contacts container
              
          };
        // });

          fetchMessages(data.contacts[0].name);

          setReceipt(data.contacts[0].name);
      }

      function fetchContacts() {
          fetch("+mockup/messaging-contacts.php")
            .then(response => {
              if (!response.ok) {
                throw new Error("Network response was not ok");
              }
              return response.json();
            })
            .then(data => {
              renderContacts(data);
              if (data.contacts && data.contacts.length > 0) {
                data.contacts.forEach(contact => {
                  console.log(contact.name);
                });
              } else {
                console.log("No contacts found.");
              }
            })
            .catch(error => {
              console.error("There was a problem fetching the contacts:", error);
            });
        }

      function renderConversation(data) {

        let conversationContainer = $('#conversation-container');

        // Clear existing content
        conversationContainer.empty();

        Object.keys(data).forEach(key => {
            if (key.includes("you")) {
                console.log("you: " + data[key]);

                let Box1 = $('<div>').addClass('box').css('flex-direction', 'row');

                let nfbox1 = $('<div>').addClass('nested-box');
                let divbox1 = $('<div>').addClass('text-box-from-chat-bubble-small').html("&nbsp;");
                nfbox1.append(divbox1);

                let nfbox2 = $('<div>').addClass('nested-box');
                let divbox2 = $('<div>').addClass('empty-box-msg1').html("&nbsp;");
                nfbox2.append(divbox2);

                let nfbox3 = $('<div>').addClass('nested-box');
                let divbox3 = $('<div>').addClass('text-box-from-chat-bubble').text(data[key]);
                nfbox3.append(divbox3);



                Box1.append(nfbox1, nfbox2, nfbox3);

                conversationContainer.append(Box1);


            } else if (key.includes("other")) {
                console.log("other: " + data[key]);

                let Box1 = $('<div>').addClass('box').css('flex-direction', 'row');

                let nfbox1 = $('<div>').addClass('nested-box');
                let divbox1 = $('<div>').addClass('text-box-from-chat-bubble-gray').text(data[key]);
                nfbox1.append(divbox1);

                let nfbox2 = $('<div>').addClass('nested-box');
                let divbox2 = $('<div>').addClass('empty-box-msg1').html("&nbsp;");
                nfbox2.append(divbox2);

                let nfbox3 = $('<div>').addClass('nested-box');
                let divbox3 = $('<div>').addClass('text-box-from-chat-bubble-small').html("&nbsp;");
                nfbox3.append(divbox3);

                Box1.append(nfbox1, nfbox2, nfbox3);

                conversationContainer.append(Box1);
            }
        });

        // Scroll down to the bottom after rendering conversation
        const container = document.getElementById("message-chat");
        container.scrollTop = container.scrollHeight;

      }


      function fetchMessages(other) {
          // URL of the messaging.php file with the conversationId parameter
          const url = '+mockup/messaging.php?conversationId=123456';


          // Make the GET request using fetch API
          fetch(url)
              .then(response => response.json()) // Parse JSON response
              .then(data => {
                  // Filter messages from Alice to you and from you to Alice
                  const messages = data.messages.filter(message => {
                      return (message.from === other && message.to === 'You') ||
                             (message.from === 'You' && message.to === other);
                  });

              // Initialize the JSON object
              const messagesObject = {};

              // Loop through the messages and append them to the JSON object
              messages.forEach((message, index) => {
                  if (message.from === 'You' && message.to === other) {
                      // Message from you to Alice
                      messagesObject["you" + index] = message.message;
                  } else if (message.from === other && message.to === 'You') {
                      // Message from Alice to you
                      messagesObject["other" + index] = message.message;
                  }
              });

              renderConversation(messagesObject);

              })
              .catch(error => {
                  console.error('Error fetching messages:', error);
              });
      }

      fetchContacts();

      // Wait for the DOM content to be fully loaded
      document.addEventListener("DOMContentLoaded", function() {
          // Get the message chat container
          var container = document.getElementById("message-chat");
          // Auto scroll to the bottom
          container.scrollTop = container.scrollHeight;
      });


      function SendMsg() {
        var sendmsgID = document.getElementById('sendmsg');
        sendmsgID.style.backgroundColor = 'red';
        sendmsgID.style.borderRadius = '20px';
        sendmsgID.style.border = '1px solid #318CE7';

        setTimeout(function() {
          sendmsgID.style.backgroundColor = 'green';
        }, 200);

        

        var messageinput = document.getElementById("message-input");
        message = messageinput.value;
        console.log("your-message:", message);
        alert("your-message:  "+message);
        messageinput.value = "";

        
        fetchContacts();


      }

      function AddContact() {
        alert("Add contact");

        var searchcontact = document.getElementById("search-contact");
        inputcontact = searchcontact.value;
        console.log("input-contact:  ", inputcontact);
        alert("input-contact::  "+inputcontact);
        searchcontact.value = "";
      }

      function RunContact(buttonId){

    
        var element = document.getElementById(buttonId);
        let contactText = $('#'+buttonId).text();
        // element.style.backgroundColor = 'red';

        setTimeout(function() {
          // element.style.backgroundColor = '#EED202';
        }, 200); 

        alert(buttonId.toString() + " +--> " + contactText);
        fetchMessages(contactText);
        setReceipt(contactText);

        

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

        .messaging-container {
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
            background-color: #318CE7;
            width: 250px;  
            padding: 8px; 
            border-radius: 10px;
            border: 1px solid #318CE7;
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
            border: 1px solid #318CE7;
        }

        .image_container {
            width: 60px; 
            height: auto; /* Maintain aspect ratio */
        }

        .image_container img {
            width: 100%; 
            height: auto; /* Maintain aspect ratio */
        }


        .empty-box-below-contactlist {
          /*background-color: #74C365;*/
          width: 50px; /* Set width of the box */
          height:100px; /* Set height of the box */
          line-height: 10px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
        /*border: 2px solid #333; */
        }

        .empty-box-msg {
          /*background-color: #74C365;*/
          width: 50px; /* Set width of the box */
          height:100px; /* Set height of the box */
          line-height: 10px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
        /*border: 2px solid #333; */
        }

        .empty-box-msg1 {
          /*background-color: #74C365;*/
          width: 50px; /* Set width of the box */
          height:50px; /* Set height of the box */
          line-height: 10px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
        /*border: 2px solid #333; */
        }

        .empty-box-msg2 {
          /*background-color: #74C365;*/
          width: 50px; /* Set width of the box */
          height:50px; /* Set height of the box */
          line-height: 10px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
        /*border: 2px solid #333; */
        }

        .text-box-null {
          /*background-color: #74C365;*/
          width: 50px; /* Set width of the box */
          height:10px; /* Set height of the box */
          line-height: 10px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
        /*border: 2px solid #333; */
        }

        .text-box-contact-list {
          /*background-color: #74C365;*/
          width: 300px; /* Set width of the box */
          height:40px; /* Set height of the box */
          line-height: 40px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: black;
          border: 2px solid #333; 
          border-radius: 20px;
        }

        .text-box-from-people {
            background-color: red;
            width: 410px; /* Set width of the box */
            height:30px; /* Set height of the box */
            line-height: 30px;
            text-align: left;
            /*margin: 10px;*/
            font-size: 15px;
            color: black;
            padding-left: 10px; 
        /*border: 2px solid #333; */
        }

        .text-box-message-content {
            background-color: #82EEFD;
            width: 410px; /* Set width of the box */
            height:30px; /* Set height of the box */
            line-height: 30px;
            text-align: left;
            /*margin: 10px;*/
            font-size: 15px;
            color: black;
        /*border: 2px solid #333; */
        }

        .hover-contact-list:hover {
            background-color: #318CE7; /* Change background color on hover */
            cursor: pointer;
            color: white; 
            border-radius: 20px;
        }

        .hover-contact-list-active {
            background-color: #318CE7; /* Change background color on hover */
            cursor: pointer;
            color: white; 
            border-radius: 20px;
        }

        .text-box-from-chat-bubble {
          background-color: #318CE7;
          width: 210px; /* Set width of the box */
          /*height:40px; */
          /*line-height: 40px;*/
          text-align: center;
          /*margin: 0 auto;*/
          font-size: 15px;
          color: black;
          padding-left: 10px;
          padding-right: 10px;
          padding-top: 10px;
          padding-bottom: 10px;
          /*word-wrap: break-word;*/
          overflow-wrap: break-word;
          border-radius: 20px;
        }

        .text-box-from-chat-bubble-gray {
          background-color: gray;
          width: 210px; /* Set width of the box */
          /*height:40px; */
          /*line-height: 40px;*/
          text-align: center;
          /*margin: 0 auto;*/
          font-size: 15px;
          color: black;
          padding-left: 10px;
          padding-right: 10px;
          padding-top: 10px;
          padding-bottom: 10px;
          /*word-wrap: break-word;*/
          overflow-wrap: break-word;
          border-radius: 20px;
        }

        .text-box-from-chat-bubble-small {
          /*background-color: #74C365;*/
          width: 40px; /* Set width of the box */
          /*height:40px; */
          line-height: 40px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: black;
          /*word-wrap: break-word;*/
          overflow-wrap: break-word;
        }

        .text-box-send {
          /*background-color: #74C365;*/
          width: 100px; /* Set width of the box */
          height:50px; /* Set height of the box */
          line-height: 50px;
          text-align: center;
          margin: 0 auto;
          font-size: 15px;
          color: white;
        /*border: 2px solid #333; */
        }


    </style>


</head>
    <body>
        <div class="messaging-container">

            <div class="box" style="flex-direction: row;" >
                <div class="box" style="flex-direction: column;  border: 1px solid #000; border-radius: 10px;" >
                    <div class="nested-box">
                        <div class="box" style="flex-direction: column;">
                            <div class="nested-box">
                                <div class="box" style="flex-direction: row;">
                                    <div class="nested-box">          
                                      <div class="input-container">
                                        <input type="text" placeholder="Search" id="search-contact">
                                      </div>
                                    </div>
                                    <div class="nested-box">
                                        <div class="text-box">&nbsp;</div>
                                    </div>
                                    <div class="nested-box">
                                        <div class="image_container" onClick="AddContact()">
                                            <img src="new_images/add-button.png" alt="Add Button">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nested-box">
                                <div class="text-box">&nbsp;</div>
                            </div>
                            <div class="nested-box">
                                <div class="box" style="flex-direction: column; ">
                                    <div id="contacts-container"> </div>
<!--                                     <div class="nested-box hover-contact-list" style="margin: 5px;">
                                        <div class="text-box-contact-list hover-contact-list">name1</div>
                                    </div>
                                    <div class="nested-box hover-contact-list" style="margin: 5px;">
                                        <div class="text-box-contact-list hover-contact-list">name2</div>
                                    </div>
                                    <div class="nested-box hover-contact-list" style="margin: 5px;">
                                        <div class="text-box-contact-list hover-contact-list">name3</div>
                                    </div>
                                    <div class="nested-box hover-contact-list" style="margin: 5px;">
                                        <div class="text-box-contact-list hover-contact-list">name3</div>
                                    </div>
                                    <div class="nested-box hover-contact-list" style="margin: 5px;">
                                        <div class="text-box-contact-list hover-contact-list">name3</div>
                                    </div>
                                    <div class="nested-box hover-contact-list" style="margin: 5px;">
                                        <div class="text-box-contact-list hover-contact-list">name3</div>
                                    </div>    -->                                                                                                  
                                </div>
                            </div>
                        </div>
                    </div>


<!--                     <div class="nested-box">
                        <div class="empty-box-below-contactlist">&nbsp;</div>
                    </div> -->
            </div>

            <div class="box" style="flex-direction: column; border: 1px solid #000; border-radius: 10px;">
                    <div class="nested-box text-box-from-people" style="background-color: #318CE7; margin: 0px;" id="receiptid">
                        To:
                    </div>
                    <div class="box text-box-message-content" id="message-chat" style="flex-direction: column; margin: 0px; max-height: 400px; overflow-y: auto; ">
                        
                        <div class="nested-box">
                            <div class="text-box">msg-time</div>
                        </div>
                        
                        <div class="box" style="flex-direction: column; ">

                           <div id="conversation-container"> </div>

                        </div>

                    </div>
                        

                    <div class="box" style="flex-direction: row;">
                        <div class="nested-box">
                            <div class="input-container2">
                                <input type="text" placeholder="Message" id="message-input">
                            </div>
                        </div>
<!--                         <div class="nested-box">
                            <div class="empty-box-msg2">&nbsp;</div>
                        </div> -->
                        <div class="nested-box" style="border-radius: 20px; background-color: green;">
                            <div class="text-box-send" id="sendmsg" onClick="SendMsg()">send</div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
