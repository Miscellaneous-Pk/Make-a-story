require('./config/config');

const express = require('express');
const bodyParser = require('body-parser');
const hbs = require('hbs');
const _ = require('lodash');

const {mongoose} = require('./db/mongoose');
const {Users} = require('./models/users');
const {sendmail} = require('./js/sendmail');

var app = express();
var port = process.env.PORT || 3000;
app.use(express.static(__dirname+'/static'));
app.use(bodyParser.json());
hbs.registerPartials(__dirname + '/views/partials');
app.set('view engine','hbs');


app.get('/',(req,res) => {
  console.log('log in page opened');
  res.render('index.hbs');
});

let authenticate = (req,res,next) => {
  Users.findByToken(req.params.token).then((user) => {
    req.params.user = user;
    console.log(`user exists ${user.name}`);
    next();
  }).catch((e) => {
    console.log(e);
    return res.status(404).send('Not authorized !');
  });
};

app.get('/home/:token', authenticate, (req,res) => {
  console.log('authenticated !');
  res.render('home.hbs');
});

app.post('/data',(req,res) => {

  if (req.body.query === 'Register') {
    var user = new Users(
      _.pick(req.body,['name','email','password']),
    );
    user.generateAuthToken().then((returned) => {
      res.status(200).send(returned.tokens[0].token);
      return console.log('saved', returned.name);
    }).catch((e) => {
      console.log(e);
      if (e.code === 11000) return res.status(400).send('You are already registered with this email');
      console.log('Error here', e);
      return res.status(400).send('Server - Bad Request');
    });
  };

  if (req.body.query === 'Login') {
    var user = _.pick(req.body,['email','password']);
    Users.findByCredentials(user.email, user.password).then((returned) => {
      return res.status(200).send(returned.tokens[0].token);
    }).catch((e) => {
      console.log(e);
      res.status(404).send(`Server error - ${e}`);
    });
  };

  if (req.body.query === 'Email_Verify') {
    var phoneCode = Math.floor(100000 + Math.random() * 900000);
    sendmail(req.body.email,`Your Code is <b>${phoneCode}</b>, please enter it on webpage.`,'Make a story - Forgot Password')
    .then((msg) => {
      return Users.findOneAndUpdate({"email": req.body.email}, {$set : {"phoneCode":phoneCode}}, {new: true});
    }).then((user) => {
      res.status(200).send('Mail sent !');
    }).catch((e) => {
      res.status(404).send(e);
    });
  };

  if (req.body.query === 'Test_Code') {
    Users.findOne({
      "email": req.body.email,
      "phoneCode": req.body.code
    }).then((user) => {
      if (!user) return Promise.reject('No user found.');
      console.log('user found', user);
      return res.status(200).send('User Found');
    }).catch((e) => {
      console.log(e);
      return res.status(404).send('Not authorized');
    });
  };

});

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})
