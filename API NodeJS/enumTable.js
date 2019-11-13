const tables = require('./tables')


module.exports.table = function (table) {
    switch (table) {
        case "personnes":
            return tables.User
        // case "inscriptions":
        //     return tables.Inscription
        case "roles":
            return tables.Role
        case "produits":
            return tables.Products
        case "activites":
            return tables.Activities
    }
}