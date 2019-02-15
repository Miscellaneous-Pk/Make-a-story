var cloudinary = require('cloudinary');

cloudinary.v2.uploader.upload("dog.mp4",
  {resource_type: "video", public_id: "my_folder/my_sub_folder/my_dog",
  overwrite: true, notification_url: "http://mysite/notify_endpoint"}
  .then((msg) => {
    console.log(msg);
  }).catch((e) => {
    console.log(e);
  });
