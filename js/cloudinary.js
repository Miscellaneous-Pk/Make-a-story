var cloudinary = require('cloudinary').v2;
const mongoose = require('mongoose');

cloudinary.config({
  cloud_name: process.env.cloudName,
  api_key: process.env.cloudAPI,
  api_secret: process.env.cloudAPISecret
});

let uploadCloudinary = (img) => {
  return cloudinary.uploader.upload(img,
      {
        resource_type: "image",
        public_id: mongoose.Types.ObjectId().toString(),
        overwrite: true,
        transformation: [
          { width: 1200, height: 800, crop: "limit" }
        ],
      });
};

module.exports = {uploadCloudinary};
