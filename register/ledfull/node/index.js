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

// con.connect(function(err) {
//     if (err) throw err;
//     console.log("Connected!");
//     con.end();
// });


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
  let device = [];
    // console.log(req.params);
    console.log(req.query);
    for (var i=1;i<=8;i++){
      device.push({
        Id: i,
        Humidity: eval('req.query.dev' + i)
      })
    }
    var sending = {
      group: req.query.groups,
      devices: device
    }
    console.log(sending)
    con.getConnection(function(err) {
      if (err) throw err;

    //SQS Send

// Create an SQS service object
var sqs = new AWS.SQS({apiVersion: '2012-11-05'});
  
var params = {
   // Remove DelaySeconds parameter and value for FIFO queues
  DelaySeconds: 0,

  MessageBody: JSON.stringify(sending),

  QueueUrl: "https://sqs.ap-southeast-1.amazonaws.com/386613505122/moisturequeue"
};

sqs.sendMessage(params, function(err, data) {
  if (err) {
    console.log("Error", err);
  } else {
    console.log("Success", data.MessageId);
  }
});
//SQS send finished




  //     con.query('USE test;', function(error, result, fields) {
  //       console.log(result);
  //       console.log(fields);
  //   });
  //   //   con.query('SHOW DATABASES;', function(error, result, fields) {
  //   //     console.log(result);
  //   // });
  //   con.query('show tables;', function(error, result, fields) {
  //     console.log(error);
  //     console.log(result);
  // });
      con.query(`INSERT INTO moisture VALUES ('${req.query.date}', '${req.query.time}', ${req.query.groups}, ${req.query.dev1}, ${req.query.dev2}, ${req.query.dev3}, ${req.query.dev4}, ${req.query.dev5}, ${req.query.dev6}, ${req.query.dev7}, ${req.query.dev8});`, function(error, result, fields) {
            // console.log(result);
            // console.log("err");
            // console.log(error);
            check = true;
        });

        con.query(`INSERT INTO temp VALUES ('${req.query.date}', ${req.query.temp});`, function(error, result, fields) {
          // console.log(result);
          // console.log("err");
          // console.log(error);
          check = true;
      });

      // con.end();
      
  
    });
  
// sqs



    if(check){
    res.status(400)
    }
    else res.status(201).json({
        text: "created"
    });
})

app.listen(3000, () => {
  console.log('Start server at port 3000.')
})




//sqs
app.get('/sqs', (req, res) => {
  var params = {
    // Remove DelaySeconds parameter and value for FIFO queues
   DelaySeconds: 0,
   MessageAttributes: {
     "photo_group": {
       DataType: "Number",
       StringValue: req.query.photo_group
     },
     "water_group": {
       DataType: "Number",
       StringValue: req.query.water_group
     },
     "water_device": {
       DataType: "Number",
       StringValue: req.query.water_device
     },
     "humidity_group": {
         DataType: "Number",
         StringValue: req.query.humidity_group
     },
     "percent": {
      DataType: "Number",
      StringValue: req.query.percent
    },
    "interval": {
      DataType: "Number",
      StringValue: req.query.interval
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