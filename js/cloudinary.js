var cloudinary = require('cloudinary').v2;

cloudinary.config({
  cloud_name: process.env.cloudName,
  api_key: process.env.cloudAPI,
  api_secret: process.env.cloudAPISecret
});

let uploadCloudinary = (img) => {
  return cloudinary.uploader.upload(img,
      {
        resource_type: "image",
        public_id: "make-a-story/images",
        overwrite: true,
      });
};

module.exports = {uploadCloudinary};
