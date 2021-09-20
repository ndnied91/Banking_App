
const express = require("express");
const app = express();
const bodyParser = require('body-parser');

const moment = require('moment-timezone');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));





const mongoose = require("mongoose");
const keys = require('./config/keys')
mongoose.connect(keys.mongoURI , ()=> console.log('connected'))


const DailyIntake = require('./models/DailyCalorieIntake.js')


var d = new Date();

let month = d.getMonth()+1
let year = d.getFullYear()
let day = d.getDate()

let date = `${month}-${day}-${year}`





app.post('/api/data' , async (req, res) => {
  console.log(req.body) // gets item

  //take this data and save it into the database

  //check if user exists

  // check if date already exists
  
  //if exists add to totalCalories and push to item array


  const dailyCalorieIntake = new DailyIntake({

            totalCalories: req.body.calorie ,
            items: req.body.item ,
            date : date
          })


      console.log(dailyCalorieIntake)


      try{
            await dailyCalorieIntake.save()
            res.sendStatus(200)

        } catch(err){
            res.sendStatus(422).send(err)
        }
})







const PORT = process.env.PORT || 5000
app.listen(PORT , ()=> console.log('starting server on port 5000'))
