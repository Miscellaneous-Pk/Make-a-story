require('./config/config');

const express = require('express');
const bodyParser = require('body-parser');
const hbs = require('hbs');
const _ = require('lodash');


var app = express();
var port = process.env.PORT;
app.use(express.static(__dirname+'/static'));
app.use(bodyParser.json());
hbs.registerPartials(__dirname + '/views/partials');
app.set('view engine','hbs');

app.get('/',(req,res) => {
  res.render('index.hbs');
})

// serverRunning();

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})
