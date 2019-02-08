const {Users} = require('../models/users');

var serverRunning = () => {

  Users.findOne({wrongAttempts:{$gte:5}}).then((user) => {
    if (!user) return Promise.resolve('No user yet with 5 attempts');
    var date = new Date();
    var diffInMillis = date - user.attemptedTime;
    if (diffInMillis > 1000 * 30) {
      return Users.findOneAndUpdate({"email":user.email},{$set:{wrongAttempts:0}},{new:true})
    }
    return Promise.resolve(`User found with wrong attempts: ${diffInMillis/1000} seconds ago`);
  }).then((response) => {
    console.log(response);
  }).catch((e) => {
    console.log(e);
  });

  return setTimeout(() => serverRunning(),1000*5);

}

// checkDelayedRequests();
module.exports = {serverRunning};
