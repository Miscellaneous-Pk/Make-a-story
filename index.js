require('./config/config');

const express = require('express');
const bodyParser = require('body-parser');
const hbs = require('hbs');
const _ = require('lodash');

const {mongoose} = require('./db/mongoose');
const {Users} = require('./models/users');

var app = express();
var port = process.env.PORT;
app.use(express.static(__dirname+'/static'));
app.use(bodyParser.json());
hbs.registerPartials(__dirname + '/views/partials');
app.set('view engine','hbs');


app.get('/',(req,res) => {
  res.render('index.hbs');
});

app.post('/data',(req,res) => {

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
})

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})
