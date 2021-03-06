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
  }],
  phoneCode: {
    type: String,
  },
  wrongAttempts: {
    type: Number,
    default: 0,
  },
  attemptedTime: {
    type: Number,
    default: 0,
  },
  pictures: [{
    status: {
      type: String,
    },
    image: {
      type: String,
    },
    thumbnail: {
      type: String,
    },
    data: {
      type: String,
    },
    title: {
      type: String,
    },
    ctr: {
      type: String,
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

UsersSchema.methods.addPicture = function (picture) {
  var user = this;
  return user.updateOne({
    $push: {
      pictures: {
        _id: picture._id,
        status : picture.status,
        image: picture.image,
      }
    }
  },{new: true});
};

UsersSchema.methods.deletePicture = function (id) {
  var user = this;

  return user.updateOne({
    $pull: {
      pictures: {
        _id: id,
      }
    }
  });
};

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

  user.tokens = {access, token};

  return user.save().then(() => {
    return user;
  });
};

UsersSchema.statics.findByToken = function (token) {
  var User = this;
  var decoded;

  try {
    decoded = jwt.verify(token, process.env.JWT_SECRET);
  } catch (e) {
    return Promise.reject(e);
  }

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
