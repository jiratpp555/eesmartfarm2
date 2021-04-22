const express = require('express')
const app = express()
const bodyParser = require('body-parser')
const mysql = require('mysql');

var db_config = {
    host: "database-2.ctwjgqaa6ssa.ap-southeast-1.rds.amazonaws.com",
    user: "adminpp",
    password: "Ppiotsmartfarm",
    database: "test"
};

var con = mysql.createPool(db_config);

// step 1 : Configure Your Credentials 
var AWS = require("aws-sdk");
AWS.config.update({region: 'ap-southeast-1'});
var sqs = new AWS.SQS({apiVersion: '2012-11-05'});

AWS.config.getCredentials(function(err) {
  if (err) console.log(err.stack);
  // credentials not loaded
  else {
    console.log("Access key:", AWS.config.credentials.accessKeyId);
  }
});

console.log("Region: ", AWS.config.region);

// Load the SDK and UUID
var AWS = require('aws-sdk');
var uuid = require('uuid');




//API part
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: true }))


app.get('/test', (req, res) => {
  var check = false;
//   let device = [];
    // console.log(req.params);

    // console.log(req.query);
    // for (var i=1;i<=8;i++){
    //   device.push({
    //     Id: i,
    //     Humidity: eval('req.query.dev' + i)
    //   })
    // }

    const sending = {
      group: 8,
      devices: 5
    }

    console.log(sending);

con.getConnection(function(err) {
      if (err) throw err;
    //SQS Send

// Create an SQS service object
var sqs = new AWS.SQS({apiVersion: '2012-11-05'});
  

var params = {
   // Remove DelaySeconds parameter and value for FIFO queues
  DelaySeconds: 0,

//   MessageBody: JSON.stringify(sending),
  MessageBody: 'This is test message',

  QueueUrl: "https://sqs.ap-southeast-1.amazonaws.com/386613505122/moisturequeue"
};
console.log(MessageBody);

sqs.sendMessage(params, function(err, data) {
  if (err) {
    console.log("Error", err);
  } else {
    console.log("Success", data.MessageId);
  }
});
//SQS send finished
       
    });
  
// sqs

    if(check){
    res.status(400)
    }
    else res.status(201).json({
        text: "created"
    });
})

app.listen(5000, () => {
  console.log('Start server at port 5000.')
})





