const connection = require('./config.js')
const table = require('./enumTable')
const Sequelize = require('sequelize')

//Message d'authentification dans la console
connection.sequelize.authenticate()
    .then(() => {
        console.log('Connection has been established successfully   ')
    })
    .catch(err => {
        console.error('Unable to connect to the database', err)
    })

//Fonction appelée lors des requêtes SELECT
module.exports.select = function (table, query, isQuery) {
    if (!isQuery) {
        //On retourne toute la table
        return table.findAll({
        })
    } else {
        //On retourne tout ce qui correspond a notre recherche
        return table.findAll({ where: query })
    }
}

//Fonction appelée lors de la connexion
module.exports.connect = function (table, jsonData) {
    return table.findOne({ where: { adressemail: jsonData.adressemail, motdepasse: jsonData.motdepasse } })
}

//Fonction appelée lors des requêtes INSERT INTO
module.exports.add = function (table, jsonData, res) {

    //On check le nom de la table
    switch (table.name) {
        case "personnes":
            console.log("Cas personnes : ")

            //On check si l'entrée existe déjà
            table.findOne({ where: { adressemail: jsonData.adressemail } })
                .then(function (user) {
                    //Si elle existe pas, on ajoute les données
                    if (!user) {
                        table.create({ id_role_id: 1, nom: jsonData.Nom, prenom: jsonData.prenom, adressemail: jsonData.adressemail, motdepasse: jsonData.motdepasse, localisation: jsonData.localisation, campus: jsonData.campus })
                        res.json({ inscription: "Inscription reussie !" })
                    } else {
                        res.json({ inscription: "Inscription échouée !" })
                    }
                })
            break
        case "activites":
            console.log("Cas activites : ")

            //On recupere l'ID de l'utilisateur pour la requête suivante
            connection.sequelize.query('SELECT `personnes`.`id` FROM `personnes` WHERE `personnes`.`nom` = \'' + jsonData.NomUser + '\' AND `personnes`.`prenom` = \'' + jsonData.prenom + '\'')
                .then(response => {
                    var { id } = response[0][0]
                    table.findOne({ where: { id_personne_id: id, description: jsonData.description, nom: jsonData.nom, image: jsonData.image/*, date: jsonData.date*/, recurrence: jsonData.recurrence, cout: jsonData.cout, valide: jsonData.valide } })
                        .then(activité => {
                            if (!activité) {
                                table.create({ id_personne_id: id, description: jsonData.description, nom: jsonData.nom, image: jsonData.image, date: jsonData.date, recurrence: jsonData.recurrence, cout: jsonData.cout, valide: jsonData.valide })
                                res.json({ added: true })
                            } else {
                                res.json({ added: false })
                            }
                        })
                })
            break
        case "produits":
            console.log("Cas produits : ")
            //connection.sequelize.query('SELECT `categories`.`id` FROM `categories` WHERE `categories`.`categorie` = \'' + jsonData.categorie + '\'')
            table.findOne({ where: { id_categorie_id: jsonData.categorie, nom: jsonData.nom, description: jsonData.description, prix: jsonData.prix, image: jsonData.image } })
                .then(produit => {
                    if (!produit) {
                        //var { id } = response[0][0]
                        table.create({ id_categorie_id: jsonData.categorie, nom: jsonData.nom, description: jsonData.description, prix: jsonData.prix, image: jsonData.image })
                        res.json({ added: true })
                    } else {
                        res.json({ added: false })
                    }
                })
            break
        case "inscrires":
            console.log("Cas inscrires : ")

            //On recupere l'ID de l'utilisateur pour la requête suivante
            connection.sequelize.query('SELECT `personnes`.`id` FROM `personnes` WHERE `personnes`.`nom` = \'' + jsonData.Nom + '\' AND `personnes`.`prenom` = \'' + jsonData.prenom + '\'')
                .then(response => {
                    var { id } = response[0][0]
                    table.findOne({ where: { id_personne_id: id, id_activite_id: jsonData.activite_id } })
                        .then(inscription => {
                            if (!inscription) {
                                table.create({ id_personne_id: id, id_activite_id: jsonData.activite_id })
                                res.json({ added: true })
                            } else {
                                res.json({ added: false })
                            }
                        })
                })
            break
    }
}

//Fonction appelée lors des requêtes UPDATE
module.exports.modify = function (table, jsonData) {
    //On modifie les données de l'entrée correspondant a l'ID fournit
    table.findOne({ WHERE: { id: jsonData.id } })
        .then(function (user) {
            for (var i = 1; i < key.length; i++) {
                user[key[i]] = jsonData[key[i]]
            }
            user.save()
                .then(() => {
                })
        })

}

//Fonction appelée lors des requêtes DELETE
module.exports.delete = function (table, jsonData) {

    //On supprime l'entrée correspondant a l'id fournit
    table.destroy({ where: { id: jsonData.id } })
}

module.exports.verifRole = function (mail) {
    return connection.sequelize.query('SELECT `roles`.`role`, `personnes`.`prenom`, `personnes`.`nom` FROM `personnes` INNER JOIN `roles` ON `personnes`.`id_role_id` = `roles`.`id` WHERE `personnes`.`adressemail` = "' + mail + '" LIMIT 1')
}