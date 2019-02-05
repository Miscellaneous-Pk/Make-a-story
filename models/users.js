const mongoose = require('mongoose');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

var UsersSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true,
    minlength: 3
  },
  email: {
    type: String,
    required: true,
    minlength: 3,
    unique: true
  },
  password: {
    type: String,
    required: true,
  },
  tokens: [{
    access: {
      type: String,
      required: true,
    },
    token: {
      type: String,
      required: true,
    }
  }]
});

UsersSchema.pre('save', function(next) {
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
});

UsersSchema.methods.removeToken = function (token) {
  var user = this;

  return user.updateOne({
    $pull: {
      tokens: {token}
    }
  });
};

UsersSchema.methods.generateAuthToken = function () {
  var user = this;
  var access = 'auth';
  var token = jwt.sign({_id: user._id.toHexString(), access}, process.env.JWT_SECRET).toString();

  user.tokens.push({access, token});

  return user.save().then(() => {
    return user;
  });
};

UsersSchema.statics.findByToken = function (token) {
  var User = this;
  var decoded;

  console.log(token);

  try {
    decoded = jwt.verify(token, process.env.JWT_SECRET);
  } catch (e) {
    console.log(e);
    return Promise.reject('not found this user token');
  }
  console.log('token is valid..');

  return User.findOne({
    '_id': decoded._id,
    'tokens.token': token,
    'tokens.access': 'auth'
  });
};

UsersSchema.statics.findByCredentials = function (email, password) {

  var User = this;
  return User.findOne({email}).then((user) => {
    if (!user) return Promise.reject('No user found with this email and password. Please sign up.');
    return new Promise((resolve, reject) => {
        bcrypt.compare(password, user.password, (err, res) => {
          if (res) {
            resolve(user);
          } else {
            reject('Password did not match !');
          }
        });
      });
    });

  };


var Users = mongoose.model('Users', UsersSchema);

module.exports = {Users};
