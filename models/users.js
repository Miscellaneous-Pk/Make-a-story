<<<<<<< HEAD
const mongoose = require('mongoose');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

var usersSchema = mongoose.Schema({
  name: {
    type: String,
    required: true,
=======
const {mongoose} = require('../db/mongoose');

var UsersSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true,
    minlength: 3
>>>>>>> b8a6636fae7650b3906cce9488f06c434937f3ee
  },
  email: {
    type: String,
    required: true,
<<<<<<< HEAD
=======
    minlength: 3,
    unique: true
>>>>>>> b8a6636fae7650b3906cce9488f06c434937f3ee
  },
  password: {
    type: String,
    required: true,
<<<<<<< HEAD
  }
});

Users.pre('save', function(next) {
  var user = this;

  if (user.isModified('password')) {
    bcrypt.genSalt(10, (err, salt) => {
      bcrypt.hash(user.password, salt, (err, hash) => {
        user.password = hash;
        next();
      });
    });
  } else {
    next();
  }

module.exports = {users};
=======
    minlength: 3
  },
});

var Users = mongoose.model('Users', UsersSchema);

module.exports = {Users};
>>>>>>> b8a6636fae7650b3906cce9488f06c434937f3ee
