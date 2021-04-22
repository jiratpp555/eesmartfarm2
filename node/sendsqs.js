const express = require('express')
const app = express()
const bodyParser = require('body-parser')
const mysql = require('mysql');
const https = require('https');
const axios = require('axios');

// Load the AWS SDK for Node.js
var AWS = require('aws-sdk');
// Set the region 
AWS.config.update({region: 'ap-southeast-1'});

// Create an SQS service object
var sqs = new AWS.SQS({apiVersion: '2012-11-05'});

// axios.get('http://localhost/register/ledfull/setting_farm_confirm.php/')
//   .then(result => {
//     console.log(result.data.photo_group);
//   })
//   .catch(error => {
//     console.log(error);
//   });


app.get('/test', (req, res) => {
  var params = {
    // Remove DelaySeconds parameter and value for FIFO queues
   DelaySeconds: 0,
   MessageAttributes: {
     "photo_groups": {
       DataType: "Number",
       StringValue: "1"
     },
     "water_groups": {
       DataType: "Number",
       StringValue: "2"
     },
     "water_devices": {
       DataType: "Number",
       StringValue: "3"
     },
     "humidity": {
         DataType: "Number",
         StringValue: "6"
     }
   },
   MessageBody: "Information about iotsmartfarm commanding water and photo through website.",
   // MessageDeduplicationId: "TheWhistler",  // Required for FIFO queues
   // MessageGroupId: "Group1",  // Required for FIFO queues
   QueueUrl: "https://sqs.ap-southeast-1.amazonaws.com/386613505122/moisturequeue"
 };
 
 sqs.sendMessage(params, function(err, data) {
   if (err) {
     console.log("Error", err);
     res.status(400)
   } else {
     console.log("Success", data.MessageId);
     res.status(200)
   }
 });
 
})


app.listen(3000, () => {
  console.log('Start server at port 3000.')
})
