const mongoose = require('mongoose')
const {Schema} = mongoose


const dailyIntakeSchema = new Schema({
  totalCalories: String,
  items: [{ type: String }],
  date: String

})



module.exports = mongoose.model('dailyIntake', dailyIntakeSchema) //model class
