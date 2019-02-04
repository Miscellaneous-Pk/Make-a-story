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
})

app.post('/data',(req,res) => {

  if (req.body.query === 'Register') {
    var user = new Users(
      _.pick(req.body,['name','email','password']),
    );
    user.save().then((returned) => {
      res.status(200).send('well recieved the payload: ' + req.body.name);
      return console.log('saved', returned.name);
    }).catch((e) => {
      if (e.code === 11000) return res.status(400).send('You are already registered with this email');
      console.log('Error here', e);
      return res.status(400).send('Server - Bad Request');
    });
  }

  if (req.body.query === 'Login') {
    var user = _.pick(req.body,['email','password']);
    Users.find(user).then((returned) => {
      var size = Object.keys(returned).length;
      if (!size) return res.status(404).send('User and password do not match.');
      return res.status(200).send(returned[0].name);
    });
  };

  

})

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})
