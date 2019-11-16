const tables = require('./tables')

//Recupere la table et renvoie l'objet correspondant
module.exports.table = function (table) {
    switch (table) {
        case "personnes":
            return tables.User
        case "roles":
            return tables.Role
        case "produits":
            return tables.Products
        case "activites":
            return tables.Activities
        case "inscrires":
            return tables.Inscription
    }
}