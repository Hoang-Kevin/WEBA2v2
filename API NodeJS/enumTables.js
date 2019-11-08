const obj = require('./BDDConnect')

module.exports.table = function (table) {
    switch (table) {
        case "users":
            return obj.User
        case "cities":
            //return obj.Cities
    }
}