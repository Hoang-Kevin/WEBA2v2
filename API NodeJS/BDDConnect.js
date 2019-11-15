const connection = require('./config.js')
const table = require('./enumTable')
const Sequelize = require('sequelize')


connection.sequelize.authenticate()
    .then(() => {
        console.log('Connection has been established successfully   ')
    })
    .catch(err => {
        console.error('Unable to connect to the database', err)
    })

module.exports.select = function (table, query, isQuery) {
    if (!isQuery) {
        return table.findAll({
        })
    } else {
        return table.findAll({ where: query })
    }
}

module.exports.connect = function (table, jsonData) {
    //console.log(jsonData.adressemail)
    return table.findOne({ where: { adressemail: jsonData.adressemail, motdepasse: jsonData.motdepasse } })
}
module.exports.add = function (table, jsonData, res) {
    switch (table.name) {
        case "personnes":
            console.log(jsonData)
            table.findOne({ where: { adressemail: jsonData.adressemail } })
                .then(function (user) {
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
            connection.sequelize.query('SELECT `personnes`.`id` FROM `personnes` WHERE `personnes`.`nom` = \'' + jsonData.NomUser + '\' AND `personnes`.`prenom` = \'' + jsonData.prenom + '\'')
                .then(response => {
                    var { id } = response[0][0]
                    table.findOne({ where: { id_personne_id: id, description: jsonData.description, nom: jsonData.nom, image: jsonData.image/*, date: jsonData.date*/, recurrence: jsonData.recurrence, cout: jsonData.cout, valide: jsonData.valide } })
                        .then(activité => {
                            console.log(activité)
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
    }
}

module.exports.modify = function (table, jsonData) {
    var obj = Object.keys(jsonData)
    console.log(obj)
    if (jsonData.id) {
        table.findOne(Sequelize.literal('WHERE id=' + jsonData.id))
            .then(function (user) {
                for (var i = 1; i < obj.length; i++) {
                    user[obj[i]] = jsonData[obj[i]]
                }
                user.save().then(function () {
                });
            });
    } else {
        connection.sequelize.query('UPDATE ' + table.name + ' SET ' + obj[0] + '="' + jsonData['changes'][obj[0]] + '" WHERE ' + obj[0] + '="' + jsonData[obj[0]] + '"')
    }
}

module.exports.delete = function (table, jsonData) {
    table.destroy({ where: { id: jsonData.id } })
}

module.exports.verifRole = function (mail) {
    return connection.sequelize.query('SELECT `roles`.`role`, `personnes`.`prenom`, `personnes`.`nom` FROM `personnes` INNER JOIN `roles` ON `personnes`.`id_role_id` = `roles`.`id` WHERE `personnes`.`adressemail` = "' + mail + '" LIMIT 1')
}