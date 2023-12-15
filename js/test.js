import moment from "moment"

const d1 = "14:30:00"
const d2 = "15:00:00"

const diff = moment(d1, "HH:mm:ss").diff(moment(d2, "HH:mm:ss"))
const dias = moment.duration(diff).asHours()
console.log(dias)