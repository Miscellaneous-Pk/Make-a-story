require('./config/config');

const express = require('express');
const bodyParser = require('body-parser');
const hbs = require('hbs');
const _ = require('lodash');

const {mongoose} = require('./db/mongoose');
const {Users} = require('./models/users');
const {sendmail} = require('./js/sendmail');
const {serverRunning} = require('./js/serverRunning');
const {uploadCloudinary} = require('./js/cloudinary');

var app = express();
var port = process.env.PORT || 3000;
app.use(express.static(__dirname+'/static'));
app.use(bodyParser.json({limit: '50mb'}));
app.use(bodyParser.urlencoded({limit: '50mb', extended: true}));
hbs.registerPartials(__dirname + '/views/partials');
app.set('view engine','hbs');


app.get('/',(req,res) => {
  console.log('log in page opened');
  res.render('index.hbs');
});

let authenticate = (req,res,next) => {
  let token = req.params.token || req.body.token;
  Users.findByToken(token).then((user) => {
    if (!user) return Promise.reject('No user found');
    req.params.user = user;
    next();
  }).catch((e) => {
    console.log(e.message);
    return res.status(404).render('index.hbs');
  });
};

app.get('/home/:token', authenticate, (req,res) => {

  console.log(req.params.user.name,'entered home');

  let pictures = req.params.user.pictures;
  let dates = [];
  _.forEach(pictures,(picture,n) => {
    let date = picture._id.getTimestamp().toString().split(' ');
    picture['dates'] = `${date[2]} ${date[1]} ${date[3]}`
  });

  res.render('home.hbs',{
    token: req.params.token,
    name: req.params.user.name,
    pictures: pictures,
  });
});

app.get('/logout/:token', authenticate, (req,res) => {
  console.log(req.params.user.name,'logged out');
  let user = req.params.user;
  user.removeToken(req.params.token).then((user) => {
    res.render('index.hbs');
  }).catch((e) => {
    res.status(404).render('badCall.hbs',{
      msg: 'Bad request, User do not exist',
    });
  })
})

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
      if (!returned) return Promise.reject('Invalid credentials.')
      return returned.generateAuthToken();
    }).then((user) => {
      if (!user) return Promise.reject('Failed to Sign In.');
      return res.status(200).send(user.tokens[0].token);
    }).catch((e) => {
      console.log(e);
      res.status(404).send(e);
    });
  };

  if (req.body.query === 'Email_Verify') {
    var phoneCode = Math.floor(100000 + Math.random() * 900000);
    Users.findOne({"email":req.body.email}).then((user) => {
      if (!user) return res.status(404).send('Un authorized request');
      return sendmail(req.body.email,`Your Code is <b>${phoneCode}</b>, please enter it on webpage.`,'Make a story - Forgot Password')
    }).then((msg) => {
      return Users.findOneAndUpdate({"email": req.body.email}, {$set : {"phoneCode":phoneCode}}, {new: true});
    }).then((user) => {
      res.status(200).send('Mail sent !');
    }).catch((e) => {
      console.log(e);
      res.status(404).send(e.errno);
    });
  };

  if (req.body.query === 'Test_Code') {
    Users.findOne({
      "email": req.body.email,
      "phoneCode": req.body.code
    }).then((user) => {
      if (!user) return Users.findOneAndUpdate({"email":req.body.email},{$set: {attemptedTime: new Date()}, $inc:{wrongAttempts:1}},{new:true});
      console.log('user found', user);
      return Promise.resolve('Found');
    }).then((response) => {
      if (response === 'Found') return res.status(200).send('Verified !');
      console.log(`${response}:::: Wrong attempt no: ${response.wrongAttempts} x Attempt`);
      if (response.wrongAttempts > 4) return res.status(404).send('5 wrong attempts, please try again after 2 mins.');
      return res.status(400).send('Did not match !');
    }).catch((e) => {
      console.log(e);
      return res.status(400).send(e);
    });
  };

  if (req.body.query === 'new_password') {
    Users.findOne({
      "email": req.body.email,
      "phoneCode": req.body.code,
    }).then((user) => {
      if (!user) return Promise.reject('Un authorized request.');
      user.password = req.body.password;
      return user.generateAuthToken();
    }).then((response)=> {
      console.log(response);
      res.status(200).send('Password changed, please login with new password.');
    }).catch((e) => {
      console.log(e);
      res.status(404).send(e);
    });

  };

});

app.post('/loggedin',authenticate,(req,res) => {

  if (req.body.query === 'uploadImage') {

    uploadCloudinary(req.body.img).then((msg) => {
      var user = req.params.user;
      req.body.public_id = msg.public_id;
      req.body.image = msg.url;
      var picture = {
        _id: msg.public_id,
        status: req.body.status,
        image: msg.url,
      };
      return user.addPicture(picture);
    }).then((msg) => {
      msg.public_id= req.body.public_id;
      msg.image = req.body.image;
      return res.status(200).send(msg);
    }).catch((e) => {
      console.log(e);
      res.status(400).send(e);
    });
  };

  if (req.body.query === 'uploadThumbnail') {
    var user = req.params.user;
    uploadCloudinary(req.body.img).then((msg) => {
      return Users.findOneAndUpdate({
        "_id": user._id,
        "pictures._id": req.body.public_id,
      },
      {
        $set:{"pictures.$.thumbnail": msg.url}
      }, {new: true}).then((msg) => {
        if (!msg) return Promise.reject('Image not found. Thumbnail URL saving failed.');
        res.status(200).send(msg.pictures);
      }).catch((e) => {
        console.log(e);
        res.status(400).send(e);
      })
    })
  };

  if (req.body.query === 'deleteImage') {
    var user = req.params.user;
    user.deletePicture(req.body.public_id).then((msg) => {
      if (!msg) return Promise.reject('Image can not be deleted as it doesnot exist.');
      res.status(200).send(msg);
    }).catch((e) => {
      res.status(400).send(e);
    })
  };

  if (req.body.query === 'updateImageData') {
    var user = req.params.user;
    Users.updateOne({
      _id: user._id,
      "pictures._id": req.body.public_id
    },{
      $set: {'pictures.$.data':req.body.imageData}
    },{new: true}).then((msg) => {
      if (!msg.n) return Promise.reject('Image do not exist. Data upload failed.');
      res.status(200).send(msg);
    }).catch((e) => {
      console.log(e);
      res.status(400).send(e);
    })
  };

  if (req.body.query === 'updateImageStatus') {
    var user = req.params.user;
    Users.updateOne({
      _id: user._id,
      "pictures._id": req.body.public_id
    },{
      $set: {
        'pictures.$.status':req.body.status,
        'pictures.$.title': req.body.title,
        'pictures.$.ctr': req.body.ctr,
      }
    },{new: true}).then((msg) => {
      if (!msg.n) return Promise.reject('Image do not exist. Status upload failed.');
      res.status(200).send(msg);
    }).catch((e) => {
      console.log(e);
      res.status(400).send(e);
    });
  };

});

app.get('/picture/:id',(req,res) => {
  let getId = req.params.id.split(',')[0];
  let token = req.params.id.split(',')[1] || '';
  Users.findOne({
    "pictures._id": getId,
  }).then((msg) => {
    var result = _.find(msg.pictures,{_id: mongoose.Types.ObjectId(getId)});
    console.log(msg);
    res.status(200).render('public_page.hbs',{
      image: result.image,
      comments: result.data,
      id: result.id,
      ctr: result.ctr,
      token: token,
      title: result.title,
    });
  }).catch((e) => {
    console.log(e);
  })

})

serverRunning();

app.listen(port, () => {
  console.log(`listening on port ${port}...`);
})
