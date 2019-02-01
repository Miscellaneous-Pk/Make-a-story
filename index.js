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
  console.log(req.body);
  var user = new Users();
  var user = _.pick(req.body,['name','email','password']);
  user.save().then((returned) => {
    res.status(200).send('well recieved the payload: ' + req.body.name);
    return console.log('saved', returned.name);
  }).catch((e) => {
    res.status(400).send('failed to save data');
    return console.log('there was an error',e);
  });

})

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})



// var user = new Users({
//   "name": "Qasim",
//   "email":"qasimali24@gmail.com",
//   "password":"1234"
// })
//
// user.save().then((returned) => {
//   return console.log('saved', returned.name);
// }).catch((e) => {
//   return console.log('there was an error',e);
// })
