const {mongoose} = require('../db/mongoose');

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
    minlength: 3
  },
});

var Users = mongoose.model('Users', UsersSchema);

module.exports = {Users};
