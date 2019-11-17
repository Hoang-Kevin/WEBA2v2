const fs = require('fs')

module.exports.fileGen = function(id_activite, activiteObject) {
    console.log(activiteObject[0][0])
    fs.writeFile('../../public/activite' + id_activite + '.csv', data, function (err) {

    })
}