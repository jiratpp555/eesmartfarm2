
var AWS = require('aws-sdk');
AWS.config.update(
  {
    accessKeyId: "AKIAIFHFRXNYOP3GC45Q",
    secretAccessKey: "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",
  }
);
var s3 = new AWS.S3();
s3.getObject(
  { Bucket: "argitect-iot-demo-1", Key: "Background_3.jpg" },
  function (error, data) {
    if (error != null) {
      alert("Failed to retrieve an object: " + error);
    } else {
      alert("Loaded " + data.ContentLength + " bytes");
      // do something with data.Body
    }
  }
);