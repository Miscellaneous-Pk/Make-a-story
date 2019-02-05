require('./config/config');

const express = require('express');
const bodyParser = require('body-parser');
const hbs = require('hbs');
const _ = require('lodash');

const {mongoose} = require('./db/mongoose');
const {Users} = require('./models/users');

var app = express();
var port = process.env.PORT || 3000;
app.use(express.static(__dirname+'/static'));
app.use(bodyParser.json());
hbs.registerPartials(__dirname + '/views/partials');
app.set('view engine','hbs');


app.get('/',(req,res) => {
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

});

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})
