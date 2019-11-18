const fs = require('fs')
const bdd = require('./config')
const table = require('./enumTable')

var array = []
var data = ""

module.exports.fileGen = function (id_activite) {
    table.table('inscrires').findAll({ where: { id_activite_id: id_activite } })
        .then(response => {
            if (response.length) {
                for (let i = 0; i < response.length; i++) {
                    array.push(response[i].dataValues)
                }
                console.log(array)
                for (let i = 0; i < array.length; i++) {
                    table.table('personnes').findOne({ where: { id: array[i].id_personne_id } })
                        .then(user => {
                            data = data + user.dataValues.nom + ";" + user.dataValues.prenom + "\n"
                            fs.writeFile('WEBA2v2/public/activite' + id_activite + '.csv', data, function (err) {
                                console.log(data)
                                if (err) {
                                    return console.log(err);
                                }
                            })
                        })
                }
            }
        })
}